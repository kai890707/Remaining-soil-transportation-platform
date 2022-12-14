<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\DocumentController;
use App\Controllers\QrcodeRender;
use App\Models\ContractingCompanyModel;
use App\Models\EngineeringManagementModel;
use App\Models\ClearingDriverModel;
use App\Models\ClearingCompanyModel;
use App\Models\ContainmentCompanyModel;
use App\Models\PdfDocumentModel;
use App\Models\PermissionModel;


class PdfController extends BaseController
{
    protected $session;
    protected $documentController;
    protected $contractingCompanyModel;
    protected $engineeringManagementModel;
    protected $pdfDocumentModel;
    protected $clearingDriverModel;
    protected $clearingCompanyModel;
    protected $containmentCompanyModel;
    protected $permissionModel;
    protected $qrcodeRender;
    public $title = '營建剩餘土石方憑證系統';

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = \Config\Services::session();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->engineeringManagementModel = new EngineeringManagementModel();
        $this->pdfDocumentModel = new PdfDocumentModel();
        $this->permissionModel = new PermissionModel();
        $this->clearingDriverModel = new  ClearingDriverModel();
        $this->clearingCompanyModel = new  ClearingCompanyModel();
        $this->containmentCompanyModel = new  ContainmentCompanyModel();
        $this->documentController = new DocumentController();
        $this->qrcodeRender = new QrcodeRender();

    }


    public function index()
    {
        return view('pdf_view');
    }

    /**
     * [POST]以文件序號搜尋PDF
     *
     * @param [type] $pdf_fileNumber (文件序號)
     * @return void
     */
    public function selectDocument()
    {
        $pdf_fileNumber = $this->request->getPostGet('pdf_fileNumber');
        $pdf_id = $this->pdfDocumentModel
                       ->select('pdf_id')
                       ->where('pdf_fileNumber',$pdf_fileNumber)
                       ->first();
        if($pdf_id){
            $response=[
                'status' => 'success',
                'message' => '搜尋成功!即將為您跳轉頁面',
                'p_id'=>$pdf_id['pdf_id']

            ];
        }else{
            $response=[
                'status' => 'fail',
                'message' => '搜尋失敗找不到您所搜尋的文件序號',
            ];
        }
        return $this->response->setJSON($response);
        
    }

    /**
     * Qrcode掃描第一關
     * 取得權限，判斷使用者是否為該文件簽名
     *
     * @param [INT] $pdf_id 
     * @return void
     */
    public function validSign($pdf_id)
    {
        if($this->session->get('permission_id')){
            $permission_id = $this->session->get('permission_id');
        }else{
            $permission_id = 99999;
        }
       
        switch ($permission_id) {
            case $this::$permissionIdByContractingCompany:
                return $this->RedirectToContractSign($pdf_id);
                break;
            case $this::$permissionIdByClearingCompany:
                return $this->RedirectToCompanySign($pdf_id);
                break;
            case $this::$permissionIdByClearingDriver:
                return $this->RedirectToDriverSign($pdf_id);
                break;
            case $this::$permissionIdByContainmentCompany:
                return $this->RedirectToContainmentSign($pdf_id);
                break;
            case $this::$permissionIdByGovernment:
                return $this->RedirectToGovernmentSign($pdf_id);
                break;
            default:
                return $this->documentController->documentTable($pdf_id);
                break;
        }
    
    }

    /**
     * 承造廠商PDF導向
     * 判斷承造廠商是否針對該PDF簽名
     * 是，則產出QRCODE 及 SHOW PDF
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function RedirectToContractSign($pdf_id)
    {
        $permissionName = $this->permissionModel
                               ->select('permission_name')
                               ->where('permission_id',$this->session->get('permission_id'))
                               ->first();

        $pdfDataFromPdfModel = $this->pdfDocumentModel->getPdfData($pdf_id);
        $contractSign = $pdfDataFromPdfModel['pdf_contractingSign'];
        $driverSign = $pdfDataFromPdfModel['pdf_driverSign'];
        $containmentSign = $pdfDataFromPdfModel['pdf_containmentPlaceSign'];

        if($contractSign == ""){
            $data = [
                "title" => $this->title . ' - 承造簽名',
                "pdf_id" =>$pdf_id,
                "pdfInfo" => $pdfDataFromPdfModel,
                'permissionName'=>$permissionName['permission_name']
            ];
            return view('sign/sign',$data);
        }else if($contractSign!=="" && $driverSign!=="" &&$containmentSign!==""){
            return $this->documentController->documentTable($pdf_id);
        }else{
            return $this->documentController->showDocumentQrcode($pdf_id);
        }
    }
    /**
     * 清運司機PDF導向
     * 判斷司機是否針對該PDF簽名
     * 是，則產出QRCODE 及 SHOW PDF
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function RedirectToDriverSign($pdf_id)
    {
        $permissionName = $this->permissionModel
                               ->select('permission_name')
                               ->where('permission_id',$this->session->get('permission_id'))
                               ->first();

        $pdfDataFromPdfModel = $this->pdfDocumentModel->getPdfData($pdf_id);
        $contractSign = $pdfDataFromPdfModel['pdf_contractingSign'];
        $contractSign = $pdfDataFromPdfModel['pdf_contractingSign'];
        $driverSign = $pdfDataFromPdfModel['pdf_driverSign'];
        $containmentSign = $pdfDataFromPdfModel['pdf_containmentPlaceSign'];

        if($contractSign == ""){
            return $this->documentController->showDocumentQrcode($pdf_id);
        }else if($contractSign !=="" && $driverSign == ""){
            $data = [
                "title" => $this->title . ' - 司機簽名',
                "pdf_id" =>$pdf_id,
                "pdfInfo" => $pdfDataFromPdfModel,
                'permissionName'=>$permissionName['permission_name']
            ];
            return view('sign/sign',$data);
        }else if($contractSign!=="" && $driverSign!=="" && $containmentSign!==""){
            return $this->documentController->documentTable($pdf_id);
        }else{
            return $this->documentController->showDocumentQrcode($pdf_id);
        }
    }

    /**
     * 清運司機PDF導向
     * 判斷收容是否針對該PDF簽名
     * 是，則產出QRCODE 及 SHOW PDF
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function RedirectToContainmentSign($pdf_id)
    {
        $permissionName = $this->permissionModel
                               ->select('permission_name')
                               ->where('permission_id',$this->session->get('permission_id'))
                               ->first();

        $pdfDataFromPdfModel = $this->pdfDocumentModel->getPdfData($pdf_id);
        $contractSign = $pdfDataFromPdfModel['pdf_contractingSign'];
        $driverSign = $pdfDataFromPdfModel['pdf_driverSign'];
        $containmentSign = $pdfDataFromPdfModel['pdf_containmentPlaceSign'];

        if($contractSign == "" && $driverSign == ""){

            return $this->documentController->showDocumentQrcode($pdf_id);

        }else if($contractSign !== "" && $driverSign !== "" && $containmentSign == ""){

            $data = [
                "title" => $this->title . ' - 收容場所簽名',
                "pdf_id" =>$pdf_id,
                "pdfInfo" => $pdfDataFromPdfModel,
                'permissionName'=>$permissionName['permission_name']
            ];
            return view('sign/containmentSign',$data);

        }else if($contractSign!=="" && $driverSign!=="" &&$containmentSign!==""){

            return $this->documentController->documentTable($pdf_id);

        }else{
            return $this->documentController->showDocumentQrcode($pdf_id);
        }
    }


    /**
     * 清運公司PDF導向
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function RedirectToCompanySign($pdf_id)
    {
        return $this->documentController->documentTable($pdf_id);
    }

    /**
     * 政府單位PDF導向
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function RedirectToGovernmentSign($pdf_id)
    {
        return $this->documentController->documentTable($pdf_id);
    }


    /**
     * 產出PDF
     * 依PDF ID 找尋相關資料並彙整 最終產出PDF
     *
     * @param [INT] $pdf_id
     * @return void
     */
    public function showPdf($pdf_id)
    {
        
        /**
         * [ARRAY]PDF欄位資料
         * 
         */
        $RealDataField = [
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

            $RealDataField['carFront'] = $pdfDataFromPdfModel['pdf_carFront'];
            $RealDataField['carBody']=$pdfDataFromPdfModel['pdf_carBody'];
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
            $RealDataField['containmentPlaceEearthFlowNumer'] = $pdfDataFromPdfModel['pdf_containmentPlaceEearthFlowNumer'];
        }                                  
        

        // print_r($pdfDataFromPdfModel['pdf_clearingDriverId']);
        try {
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->set_option('isRemoteEnabled', TRUE);
            
        //    return  view('pdf_view',$RealDataField);
            $dompdf->loadHtml(view('pdf_view',$RealDataField));
            $dompdf->setPaper('A4', 'letter');
            $dompdf->render();
            $dompdf->stream('newfile',array('Attachment'=>0));

        } catch (\Exception $e) {
                print_r($e);
        }
    }

    /**
     * 上傳簽名檔及根據該簽名用戶update PDF資料
     * 
     *
     * @return void
     */
    public function uploadSign()
    {
        $signBase64 = $this->request->getPostGet('sign');
        $pdf_id = $this->request->getPostGet('pdf_id');
        $permission_id = $this->session->get('permission_id');

        //簽名上傳
        $fileName = $pdf_id.uniqid().'.png';
        $signTime = date("Y:m:d H:i");; 
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'].'/assets/sign/'.$fileName,
            base64_decode(
                str_replace('data:image/png;base64,', '', $signBase64)
            )
        );
       
        if($permission_id == $this::$permissionIdByContractingCompany){
            $updateData = [
                "pdf_contractingSign"=>$fileName,
                "pdf_contractingSignDate"=>$signTime,
                "status_id"=>$this::$pdfStatus_contractFinish
            ];
            $r =  $this->pdfDocumentModel->update($pdf_id,$updateData);
            if($r){
                $response=[
                    'status' => 'success',
                    'message' => '資料存入成功'
                ];
            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '資料存入失敗'
                ];
            }
        }else if($permission_id == $this::$permissionIdByClearingCompany){
           $response=[
                'status' => 'fail',
                'message' => '您無簽署權限'
            ];
        }else if($permission_id == $this::$permissionIdByClearingDriver){

            $isSignOther = $this->pdfDocumentModel
                                ->where('pdf_clearingDriverId', $this->session->get('clearingDriver_id'))
                                ->where('status_id', $this::$pdfStatus_driverFinish)
                                ->first();
            
            if($isSignOther){
                $response = [
                    'status' => 'fail',
                    'message' => '您已簽署其他聯單，請於載運完畢後再接續簽名。'
                ];
            }else{
                $getClearingCompanyIdByDriver = $this->clearingDriverModel
                                                 ->where('clearingDriver_id',$this->session->get('clearingDriver_id'))
                                                 ->first();    
                $updateData = [
                    "pdf_driverSign"=>$fileName,
                    "pdf_driverSignDate"=>$signTime,
                    "status_id"=>$this::$pdfStatus_driverFinish,
                    "pdf_clearingDriverId"=>$this->session->get('clearingDriver_id'),
                    "pdf_clearingCompanyId"=>$getClearingCompanyIdByDriver['clearingDriver_id']
                ];

                $r =  $this->pdfDocumentModel->update($pdf_id,$updateData);

                if($r){
                    $response=[
                        'status' => 'success',
                        'message' => '資料存入成功'
                    ];
                }else{
                    $response=[
                        'status' => 'fail',
                        'message' => '資料存入失敗'
                    ];
                }
            }

            
        }else if($permission_id == $this::$permissionIdByContainmentCompany){
            
            $pdf_id = $this->request->getPostGet('pdf_id');
            $containmentPlaceEearthFlowNumer = $this->request->getPostGet('containmentPlaceEearthFlowNumer');
            $carFrontBase64 = $this->request->getPostGet('carFront');

            $carFrontBase64FileName = 'carFront'.$pdf_id.uniqid().'.png';
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'].'/assets/car/'.$carFrontBase64FileName,
                base64_decode(
                    str_replace('data:image/png;base64,', '', $carFrontBase64)
                )
            );

            $carBodyBase64 = $this->request->getPostGet('carBody');
            $carBodyBase64FileName = 'carBody'.$pdf_id.uniqid().'.png';
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'].'/assets/car/'.$carBodyBase64FileName,
                base64_decode(
                    str_replace('data:image/png;base64,', '', $carBodyBase64)
                )
            );

            $shippingQuantity = $this->request->getPostGet('shippingQuantity');
            $shippingContents = $this->request->getPostGet('shippingContents');

            $updateData = [
                "pdf_containmentPlaceSign"=>$fileName,
                "pdf_containmentPlaceSignDate"=>$signTime,
                // "status_id"=>$this::$pdfStatus_containmentFinish,
                "status_id"=>$this::$pdfStatus_signFinish,
                "pdf_containmentCompanyId"=>$this->session->get('containmentCompany_id'),
                "pdf_shippingQuantity"=>$shippingQuantity,
                "pdf_shippingContents"=>$shippingContents,
                "pdf_carFront"=>$carFrontBase64FileName,
                "pdf_carBody"=>$carBodyBase64FileName,
                "pdf_containmentPlaceEearthFlowNumer"=>$containmentPlaceEearthFlowNumer
            ];

            $r =  $this->pdfDocumentModel->update($pdf_id,$updateData);

            if($r){
                $response=[
                    'status' => 'success',
                    'message' => '資料存入成功',
                ];
            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '資料存入失敗'
                ];
            }

        }else if($permission_id == $this::$permissionIdByGovernment){
            $response=[
                'status' => 'fail',
                'message' => '您無簽署權限'
            ];
        }
        
        return $this->response->setJSON($response);
    }

    /**
     * 新增工程
     *
     * @return json
     */
    public function insertEngineeringData()
    {
        $engineering_id = $this->request->getPostGet('engineering_id');
        $engineeringData = $this->engineeringManagementModel->where('engineering_id', $engineering_id)->first();

        if($engineeringData){
            $check = $this->db->table('PdfDocument')->where('engineering_id ', $engineering_id)->countAllResults();
            $check = $check+1;
            $documentNumber = date('Y').$engineeringData['engineering_projectNumber']."TCP".$check;
            $documentEfficientDate = date('Y-m-d',strtotime('+10year'));//文件有效日期
            $buildingName = $this->request->getPostGet('building_name');//建物名稱
            $buildingNumber = $this->request->getPostGet('building_number');//建造編號
            $buildingAddress = $this->request->getPostGet('building_address');//建物地址
            $starterName = $this->request->getPostGet('starter_name');//起造人姓名
            $starterPhone = $this->request->getPostGet('starter_phone');//起造人電話
            $contracting_id = $engineeringData['contractCompany_id'];//承造廠商外來鍵
            $transportationRoute = $this->request->getPostGet('transportation_route');//運輸路線

            $status_id = $this::$pdfStatus_createFinish; //pdf狀態

            $data = [
                'pdf_fileNumber' => $documentNumber,
                'pdf_effectiveDate' => $documentEfficientDate,
                'pdf_buildingName' => $buildingName,
                'pdf_constructNumber' => $buildingNumber,
                'pdf_buildingAddress' => $buildingAddress,
                'pdf_starterName' => $starterName,
                'pdf_starterPhone' => $starterPhone,
                'pdf_contractingCompanyId' => $contracting_id,
                'pdf_transportationRoute'=>$transportationRoute,
                'status_id' => $status_id,
                'engineering_id' => $engineering_id,
            ];


            $result = $this->pdfDocumentModel->insert($data);
            if($result){
                $response=[
                    'status' => 'success',
                    'message' => '資料存入成功'
                ];
            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '資料存入失敗'
                ];
            }
        }else{
            $response=[
                'status' => 'fail',
                'message' => '資料存入失敗'
            ];
        }
        return $this->response->setJSON($response);
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
            $imgHtml='<img src="data:image/png;base64, '.$imagedata.'" style="max-width: 70%;height: auto;margin: 0 auto;" alt="/assets/images/'.$imagedata.'">';
            
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
