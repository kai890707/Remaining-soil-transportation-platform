<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\PdfDocumentModel;
use App\Models\EngineeringManagementModel;
use App\Controllers\QrcodeRender;
use App\Models\ContractingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ClearingCompanyModel;
use App\Models\ContainmentCompanyModel;
use App\Models\PermissionModel;
use App\Controllers\PdfController;


class DocumentController extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $pdfDocumentModel;
    protected $engineeringManagementModel;
    protected $pdfController;
    protected $clearingDriverModel ;
    protected $clearingCompanyModel;
    protected $containmentCompanyModel;
    protected $permissionModel;
    protected $contractingCompanyModel;
    protected $db;
    protected $qrcodeRender;
    public function __construct()
    {
        $this->pdfDocumentModel = new PdfDocumentModel();
        $this->engineeringManagementModel = new EngineeringManagementModel();
        $this->clearingDriverModel  = new ClearingDriverModel();
        $this->clearingCompanyModel = new  ClearingCompanyModel();
        $this->containmentCompanyModel = new  ContainmentCompanyModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->permissionModel = new PermissionModel();
        $this->qrcodeRender = new QrcodeRender();
        $this->db = db_connect();
    }

    /**
     * [VIEW] 聯單使用狀態表
     *
     * @param [INT] $project_id(工程id)
     * @return view
     */
    public function index($project_id)
    {
        $projectInfo = $this->engineeringManagementModel
                            ->where('engineering_id',$project_id)
                            ->first();

        $projectStatus = $this->pdfDocumentModel
                                ->select('status_id as status,Count(status_id) as count')
                                ->where('engineering_id',$project_id)
                                ->groupBy('status_id')
                                ->get()
                                ->getResultArray();

        $allproject = $this->pdfDocumentModel
                           ->where('engineering_id',$project_id)
                           ->countAllResults();

        $countArray = [
            "Create"=>0,
            "Contract"=>0,
            "Driver"=>0,
            "Shelter"=>0,
            "Finish"=>0,
            "All"=>0,
        ];
        foreach ($projectStatus as $key) {
            if($key['status'] == 1){
                $countArray["Create"] = $key['count'];
            }else if($key['status'] == 2){
                $countArray["Contract"] = $key['count'];
            }else if($key['status'] == 3){
                $countArray["Driver"] = $key['count'];
            }else if($key['status'] == 4){
                $countArray["Shelter"] = $key['count'];
            }else if($key['status'] == 5){
                $countArray["Finish"] = $key['count'];
            }
        }
        $countArray["All"] = $allproject;

        $data = [
            "title" => $this->title . ' - 聯單',
            "projectInfo" => $projectInfo,
            "countArray"=>$countArray
        ];
        return view('documentList', $data);
    }



    /**
     * [VIEW] 各使用狀態聯單
     *
     * @param [type] $project_id(工程id)
     * @param [type] $status_id(狀態id)
     * @return void
     */
    public function useStatus($project_id,$status_id)
    {
        $subTitle = '';
        $enSubTitle = '';
        switch ($status_id) {
            case $this::$pdfStatus_createFinish:
                $subTitle = "未使用聯單列表";
                $enSubTitle= "Unused List";
                break;

            case $this::$pdfStatus_contractFinish:
                $subTitle = "承造已使用聯單列表";
                $enSubTitle= "Contract Used List";
                break;
            case $this::$pdfStatus_driverFinish:
                $subTitle = "清運司機已使用聯單列表";
                $enSubTitle= "Driver Used List";
                break;
            case $this::$pdfStatus_containmentFinish:
                $subTitle = "已完成聯單列表";
                $enSubTitle= "Completed List";
                // $subTitle = "收容廠商已使用聯單列表";
                // $enSubTitle= "Shelter Used List";
                break;
            case $this::$pdfStatus_signFinish:
                $subTitle = "已完成聯單列表";
                $enSubTitle= "Completed List";
                break;
            default:
                $subTitle = "已完成聯單列表";
                $enSubTitle= "Completed List";
                break;
        }


        if($status_id == $this::$pdfStatus_containmentFinish){
            $projectInfo = $this->pdfDocumentModel
                            ->select('PdfDocument.*,PdfStatus.status_remark')
                            ->join('PdfStatus','PdfStatus.status_id = PdfDocument.status_id')
                            ->paginate(10);
        }else{
            $projectInfo = $this->pdfDocumentModel
                            ->select('PdfDocument.*,PdfStatus.status_remark')
                            ->join('PdfStatus','PdfStatus.status_id = PdfDocument.status_id')
                            ->where('PdfDocument.engineering_id',$project_id)
                            ->where('PdfDocument.status_id',$status_id)
                            ->paginate(10);
        }


        $data = [
            "title" => $this->title . ' - '.$subTitle,
            "subTitle"=>$subTitle,
            "enSubTitle"=>$enSubTitle,
            "info"=>$projectInfo,
            "pager" => $this->pdfDocumentModel->pager,
        ];
        return view('document/documentStatusList',$data);

    }

    /**
     * [VIEW] 顯示該工作流向清單QRCODE頁面
     *
     * @param [INT] $id (pdf ID)
     * @return view
     */
    public function showDocumentQrcode($pdf_id)
    {

        $permission_id = session()->get('permission_id');



        $qrcodeClass = new QrcodeRender();
        $qrcodeImgHtml = $qrcodeClass->generateQrcode($pdf_id);

        $projectInfo = $this->pdfDocumentModel
                            ->select('EngineeringManagement.engineering_name,EngineeringManagement.engineering_projectNumber,PdfDocument.*')
                            ->join('EngineeringManagement','EngineeringManagement.engineering_id = PdfDocument.engineering_id')
                            ->where('PdfDocument.pdf_id',$pdf_id)
                            ->first();

        $data = [
            "title" => $this->title . ' - 聯單QRCODE',
            "projectInfo" => $projectInfo,
            "qrcodeImgHtml" => $qrcodeImgHtml
        ];

        return view('document/showDocumentQrcode',$data);
    }


    /**
     * 工程結案區
     * 顯示該公司所完成之聯單
     *
     * @return view
     */
    public function documentComplete()
    {
        $contract_id = session()->get('contracting_id');
        // print_r($contract_id);
        $completeDoc = $this->pdfDocumentModel
                            ->join('EngineeringManagement','EngineeringManagement.engineering_id = PdfDocument.engineering_id')
                            ->where('PdfDocument.status_id',$this::$pdfStatus_signFinish)
                            ->where('PdfDocument.pdf_contractingCompanyId',$contract_id)
                            ->paginate(10);
        $data = [
            "title" => $this->title . ' - 工程結案區',
            "projects"=>$completeDoc,
            "pager" => $this->pdfDocumentModel->pager,
        ];
        return view('user_contract/documentComplete', $data);

    }


    /**
     * 文件表格
     *
     * @param [INT] $id (pdf_id)
     * @return void
     */
    public function documentTable($pdf_id)
    {   
        /**
         * [ARRAY]PDF欄位資料
         * 
         */
        $RealDataField = [
            "pdf_id"=>"",                           //文件ID
            "fileNumber"=>"",                       //文件序號 pdf
            "effectiveDate"=>"",                    //文件有效日期 pdf
            "buildingName"=>"",                     //建築物或拆除名稱 pdf
            "projectNumber"=>"",                    //工程餘土流向管制編號 engeer
            "constructNumber"=>"",                  //建造號碼 pdf
            "buildingAddress"=>"",                  //建築物地點 pdf
            "starterName"=>"",                      //起造人姓名 pdf
            "starterPhone"=>"",                     //起造人電話 pdf
            "contractUserName"=>"",                 //承造人姓名 contract
            "contractUserPhone"=>"",                //承造人電話 contract
            "contractWatcherName"=>"",              //監造人姓名 contract
            "contractWatcherPhone"=>"",             //監造人電話 contract
            "clearingDriverName"=>"",               //駕駛人姓名 driver
            "clearingDriverIdentityCard"=>"",       //駕駛人身分證字號 driver
            "clearingDriverLicensePlate"=>"",       //駕駛人車輛、船舶牌號 driver
            "clearingCompanyName"=>"",              //清運單位名稱 clear
            "clearingCompanyPrincipalName"=>"",     //清運單位負責人 clear
            "clearingCompanyPhone"=>"",             //清運單位電話 clear
            "transportationRoute"=>"",              //運送路線 pdf
            "shippingQuantity"=>"",                 //剩餘土石載運數量 pdf
            "shippingContents"=>"",                 //載運內容(土質) pdf
            "containmentCompanyName"=>"",           //合法收容處理場所名稱 containment
            "containmentCompanyPrincipalName"=>"",  //合法收容處理場所負責人 containment
            "containmentCompanyPrincipalPhone"=>"", //合法收容處理場所負責人電話 containment
            "containmentPlaceEearthFlowNumer"=>"",  //合法收容處理場所剩餘土石方流向 pdf
            "certifiedDocumentsIssuingUnit"=>"",    //證明文件核發單位 pdf
            "contractingSign"=>"",                  //承造公司簽名 pdf
            "contractingSignDate"=>"",              //承造公司簽名時間 pdf
            "driverSign"=>"",                       //駕駛簽名 pdf
            "driverSignDate"=>"",                   //駕駛簽名時間 pdf
            "containmentPlaceSign"=>"",             //收容場所簽名 pdf
            "containmentPlaceSignDate"=>"",         //收容場所簽名時間 pdf
            "carFront"=>"",                         //車頭照片 pdf
            "carBody"=>"",                          //車斗照片 pdf
            "docQrcode"=>"",                        //該PDF QRCODE 由Qrcode Render Controller 呼叫傳入
            "organizeImg"=>"",                      //公會證明
        ];

        /**
         * 以PDF ID 搜尋 Pdf資料表資料
         */
        $pdfDataFromPdfModel = $this->pdfDocumentModel->getPdfData($pdf_id);

        //存在該pdf資料則填入RealDataField
        if($pdfDataFromPdfModel){
            $RealDataField['pdf_id']=$pdfDataFromPdfModel['pdf_id'];
            $RealDataField['fileNumber']=$pdfDataFromPdfModel['pdf_fileNumber'];
            $RealDataField['effectiveDate']=$pdfDataFromPdfModel['pdf_effectiveDate'];
            $RealDataField['buildingName']=$pdfDataFromPdfModel['pdf_buildingName'];
            $RealDataField['constructNumber']=$pdfDataFromPdfModel['pdf_constructNumber'];
            $RealDataField['buildingAddress']=$pdfDataFromPdfModel['pdf_buildingAddress'];
            $RealDataField['starterName']=$pdfDataFromPdfModel['pdf_starterName'];
            $RealDataField['starterPhone']=$pdfDataFromPdfModel['pdf_starterPhone'];
            $RealDataField['transportationRoute']=$pdfDataFromPdfModel['pdf_transportationRoute'];
            $RealDataField['shippingQuantity']=$pdfDataFromPdfModel['pdf_shippingQuantity'];
            $RealDataField['shippingContents']=$pdfDataFromPdfModel['pdf_shippingContents'];
            $RealDataField['containmentPlaceEearthFlowNumer']=$pdfDataFromPdfModel['pdf_containmentPlaceEearthFlowNumer'];
            $RealDataField['pdf_certifiedDocumentsIssuingUnit']=$pdfDataFromPdfModel['pdf_certifiedDocumentsIssuingUnit'];
            //圖片路徑轉為圖檔
            $RealDataField['contractingSign'] = $this->signFileEncodeBase64($pdfDataFromPdfModel['pdf_contractingSign']);
            //日期切割
            $RealDataField['contractingSignDate'] = $this->dateTimeFormat($pdfDataFromPdfModel['pdf_contractingSignDate']); 
             //圖片路徑轉為圖檔
            $RealDataField['driverSign'] = $this->signFileEncodeBase64($pdfDataFromPdfModel['pdf_driverSign']);
            //日期切割
            $RealDataField['driverSignDate'] = $this->dateTimeFormat($pdfDataFromPdfModel['pdf_driverSignDate']);
             //圖片路徑轉為圖檔
            $RealDataField['containmentPlaceSign'] = $this->signFileEncodeBase64($pdfDataFromPdfModel['pdf_containmentPlaceSign']);
             //日期切割
            $RealDataField['containmentPlaceSignDate'] = $this->dateTimeFormat($pdfDataFromPdfModel['pdf_containmentPlaceSignDate']);

            $RealDataField['docQrcode']= $this->qrcodeRender->generateQrcode($pdf_id);

            $RealDataField['organizeImg']= $this->organizeFileEncodeBase64('organize.png');
        }
        /**
         * 以PDF ID 搜尋 工程資料表資料
         */
        $pdfDataFromEngeeringModel = $this->engineeringManagementModel->getDataJoinPdf($pdfDataFromPdfModel['engineering_id']);

        if($pdfDataFromEngeeringModel){
            $RealDataField['projectNumber']=$pdfDataFromEngeeringModel['engineering_projectNumber'];
        }

        /**
         * 以PDF ID 搜尋 承造廠商資料表資料
         */
        $pdfDataFromContractModel = $this->contractingCompanyModel->getDataJoinPdf($pdfDataFromPdfModel['pdf_contractingCompanyId']);

        if($pdfDataFromContractModel){
            $RealDataField['contractUserName']=$pdfDataFromContractModel['contracting_contractUserName'];
            $RealDataField['contractUserPhone']=$pdfDataFromContractModel['contracting_contractUserPhone'];
            $RealDataField['contractWatcherName']=$pdfDataFromContractModel['contracting_contractWatcherName'];
            $RealDataField['contractWatcherPhone']=$pdfDataFromContractModel['contracting_contractWatcherPhone'];
        }
                            
        /**
         * 以PDF ID 搜尋 清運司機資料表資料
         */
        $pdfDataFromDriverModel = $this->clearingDriverModel->getDataJoinPdf($pdfDataFromPdfModel['pdf_clearingDriverId']);
        
        if($pdfDataFromDriverModel){
            $RealDataField['clearingDriverName']=$pdfDataFromDriverModel['clearingDriver_name'];
            $RealDataField['clearingDriverIdentityCard']=$pdfDataFromDriverModel['clearingDriver_identityCard'];
            $RealDataField['clearingDriverLicensePlate']=$pdfDataFromDriverModel['clearingDriver_licensePlate'];
        }

        /**
         * 以PDF ID 搜尋 清運公司資料表資料
         */
        $pdfDataFromCompanyModel = $this->clearingCompanyModel->getDataJoinPdf($pdfDataFromPdfModel['pdf_clearingCompanyId']);
        
        if($pdfDataFromCompanyModel){
            $RealDataField['clearingCompanyName']=$pdfDataFromCompanyModel['clearingCompany_name'];
            $RealDataField['clearingCompanyPrincipalName']=$pdfDataFromCompanyModel['clearingCompany_principalName'];
            $RealDataField['clearingCompanyPhone']=$pdfDataFromCompanyModel['clearingCompany_phone'];
        }   

        /**
         * 以PDF ID 搜尋 收容場所資料表資料
         */
        $pdfDataFromContainmentModel = $this->containmentCompanyModel->getDataJoinPdf($pdfDataFromPdfModel['pdf_containmentCompanyId']);
        
        if($pdfDataFromContainmentModel){
            $RealDataField['containmentCompanyName']=$pdfDataFromContainmentModel['containmentCompany_name'];
            $RealDataField['containmentCompanyPrincipalName']=$pdfDataFromContainmentModel['containmentCompany_principalName'];
            $RealDataField['containmentCompanyPrincipalPhone']=$pdfDataFromContainmentModel['containmentCompany_principalPhone'];
            $RealDataField['carFront'] = $pdfDataFromPdfModel['pdf_carFront'];
            $RealDataField['carBody']=$pdfDataFromPdfModel['pdf_carBody'];
        }                                  
        
        // $completeDoc = $this->pdfDocumentModel
        //                     ->join('EngineeringManagement','EngineeringManagement.engineering_id = PdfDocument.engineering_id')
        //                     ->join('ClearingDriver','ClearingDriver.clearingDriver_id = PdfDocument.pdf_clearingDriverId')
        //                     ->join('ContainmentCompany','ContainmentCompany.containmentCompany_id = PdfDocument.pdf_containmentCompanyId')
        //                     ->join('ContractingCompany','ContractingCompany.contracting_id = PdfDocument.pdf_contractingCompanyId')
        //                     ->where('PdfDocument.status_id',$this::$pdfStatus_signFinish)
        //                     ->where('PdfDocument.pdf_id',$id)
        //                     ->first();
        // $companyInfo = $this->clearingDriverModel 
        //                     ->join('ClearingCompany','ClearingCompany.clearingCompany_id = ClearingDriver.clearingDriver_id')
        //                     ->where('ClearingCompany.clearingCompany_id',$completeDoc['clearingCompany_id'])
        //                     ->first();
        // $completeDoc['clearingCompany_name'] = $companyInfo['clearingCompany_name'];
        $data = [
            "title" => $this->title . ' - 文件表格',
            "projects"=>$RealDataField,
        ];
        return view('document/documentTable', $data);
    }

 /**
     * Base64轉圖檔
     *
     * @param [type] $base64
     * @return void
     */
    public function signFileDecodeBase64($base64)
    {
        $fileName = uniqid();
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'].'/assets/qrcode/'.$fileName.'.png',
            base64_decode(
                str_replace('data:image/png;base64,', '', $base64)
            )
        );
        return '<img src="'.base_url("/assets/qrcode/".$fileName.".png").'" alt="QR Code" />';
    }


    /**
     * 圖片轉base64
     * 因DomPdf套件圖片問題只能用base64渲染圖片
     *
     * @param [type] $image_path
     * @return void
     */
    public function signFileEncodeBase64($image_path)
    {
        $imgHtml = "";
        if($image_path == ""){
           $imgHtml = "";
        }else{
            $image=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/sign/'.$image_path);
            $imagedata=base64_encode($image);
            // return 
            $imgHtml='<img src="data:image/png;base64, '.$imagedata.'" style="max-width: 100%;height: auto;margin-right: auto!important;margin-left: auto!important;" alt="/assets/sign/'.$imagedata.'">';
            
        }
        return $imgHtml;
    }

        /**
     * 圖片轉base64
     * 因DomPdf套件圖片問題只能用base64渲染圖片
     *
     * @param [type] $image_path
     * @return void
     */
    public function organizeFileEncodeBase64($image_path)
    {
        $imgHtml = "";
        if($image_path == ""){
           $imgHtml = "";
        }else{
            $image=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/images/'.$image_path);
            $imagedata=base64_encode($image);
            // return 
            $imgHtml='<img src="data:image/png;base64, '.$imagedata.'"  style="width:150px; height:150px;max-width: 50%;height: auto;margin-right: auto!important;margin-left: auto!important;" alt="/assets/images/'.$imagedata.'">';
            
        }
        return $imgHtml;
    }
    
    /**
     * 日期格式整理
     *
     * @param [DATE] $dateTime
     * @return STRING
     * @return XXXX年XX月XX日XX時XX分
     */
    public function dateTimeFormat($dateTime)
    {   
        $str = "";
        if($dateTime == ""){
            $str = "";
        }else{
            $spaceSplit = explode(" ",$dateTime);
            $ymdSplit = explode("-",$spaceSplit[0]);
            $hsSplit = explode(":",$spaceSplit[1]);
            $str = $ymdSplit[0]."年".$ymdSplit[1]."月".$ymdSplit[2]."日".$hsSplit[0]."時".$hsSplit[1]."分";   
        }
        return $str; 
    }

}
