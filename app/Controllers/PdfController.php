<?php

namespace App\Controllers;

use CodeIgniter\Controller;
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
    protected $contractingCompanyModel;
    protected $engineeringManagementModel;
    protected $pdfDocumentModel;
    protected $clearingDriverModel;
    protected $clearingCompanyModel;
    protected $containmentCompanyModel;
    protected $permissionModel;
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

    }


    public function index()
    {
        return view('pdf_view');
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
        $permission_id = $this->session->get('permission_id');
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
            default:
                return $this->showPdf($pdf_id);
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

        if($contractSign == ""){

            $data = [
                "title" => $this->title . ' - 承造簽名',
                "pdf_id" =>$pdf_id,
                "pdfInfo" => $pdfDataFromPdfModel,
                'permissionName'=>$permissionName['permission_name']
            ];

            return view('sign/contractSign',$data);
        }else{
           return $this->showPdf($pdf_id);
        }
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
            $RealDataField['containmentPlaceEearthFlowNumer']=$pdfDataFromPdfModel['pdf_containmentPlaceEearthFlowNumer'];
            $RealDataField['pdf_certifiedDocumentsIssuingUnit']=$pdfDataFromPdfModel['pdf_certifiedDocumentsIssuingUnit'];
            $RealDataField['contractingSign']=$pdfDataFromPdfModel['pdf_contractingSign'];
            $RealDataField['contractingSignDate']=$pdfDataFromPdfModel['pdf_contractingSignDate'];
            $RealDataField['driverSign']=$pdfDataFromPdfModel['pdf_driverSign'];
            $RealDataField['driverSignDate']=$pdfDataFromPdfModel['pdf_driverSignDate'];
            $RealDataField['containmentPlaceSign']=$pdfDataFromPdfModel['pdf_containmentPlaceSign'];
            $RealDataField['containmentPlaceSignDate']=$pdfDataFromPdfModel['pdf_containmentPlaceSignDate'];
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
        }                                  
        


        try {
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->set_option('isRemoteEnabled', TRUE);
            $dompdf->loadHtml(view('pdf_view',$RealDataField));
            $dompdf->setPaper('A4', 'letter');
            $dompdf->render();
            $dompdf->stream('newfile',array('Attachment'=>0));

        } catch (\Exception $e) {
                print_r($e);
        }
    }

    public function uploadSign()
    {
        $signBase64 = $this->request->getPostGet('sign');
        $pdf_id = $this->request->getPostGet('pdf_id');
        $permission_id = $this->session->get('permission_id');

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
                    'status' => 'success',
                    'message' => '資料存入成功'
                ];
            }
        }else if($permission_id == $this::$permissionIdByClearingCompany){

        }else if($permission_id == $this::$permissionIdByClearingDriver){

        }else if($permission_id == $this::$permissionIdByContainmentCompany){

        }else if($permission_id == $this::$permissionIdByGovernment){

        }
        
   
        return $this->response->setJSON($response);
    }

    public function htmlToPDF($data)
    {
        try {
        // $path_to_image = "assets/images/pic1.jpg";
                $logo = "data:image/png;base64,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";
                $html = "<img src=".$logo." width='150px' height='100px'>";
                // echo $html;
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->set_option('isRemoteEnabled', TRUE);
                $dompdf->loadHtml(view('pdf_view'));
                // $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'letter');
                $dompdf->render();
                $dompdf->stream('newfile',array('Attachment'=>0));
                // $dompdf->stream();

        } catch (\Exception $e) {
                print_r($e);
        }
    }

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


    public function pdfStatusJudge()
    {
        $pdf_id = $this->request->getPostGet('pdf_id');
        $permission_id = $this->session->get('permission_id');
        $judgePdfStatus = $this->$pdfDocumentModel->where('pdf_id',$pdf_id)->first();
        if($permission_id == $this::$permissionIdByClearingDriver){
            if($judgePdfStatus && $judgePdfStatus['status_id'] == $this::$pdfStatus_contractFinsh ){ //駕駛判斷
                $result = $this->driverInsertPdfData(); //新增駕駛資訊至pdf
                if($result){
                    $data = [
                        'status_id' => $this::$pdfStatus_driverFinsh,
                    ];
                    $updatePdfStatus = $this->$pdfDocumentModel->update($pdf_id,$data);
                    if($updatePdfStatus){
                        $response=[
                            'status' => 'success',
                            'message' => '簽名完成'
                        ];
                    }else{
                        $response=[
                            'status' => 'fail',
                            'message' => '簽名失敗'
                        ];
                    }
                }
            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '承造商尚未簽名'
                ];
            }
        }else if($permission_id == $this::$permissionIdByContainmentCompany){ //收容判斷
            if($judgePdfStatus && $judgePdfStatus['status_id'] == $this::$pdfStatus_driverFinsh ){
                $result = $this->containmentCompanyInserPdfData(); //新增駕駛資訊至pdf
                if($result){
                    $data = [
                        'status_id' => $this::$pdfStatus_containmentFinsh,
                    ];
                    $updatePdfStatus = $this->$pdfDocumentModel->update($pdf_id,$data);
                    if($updatePdfStatus){
                        $response=[
                            'status' => 'success',
                            'message' => '簽名完成'
                        ];
                    }else{
                        $response=[
                            'status' => 'fail',
                            'message' => '簽名失敗'
                        ];
                    }
                }
            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '駕駛尚未簽名'
                ];
            }
        }else if($permission_id == $this::$permissionIdByContractingCompany){ //承造判斷
            if($judgePdfStatus && $judgePdfStatus['status_id'] == $this::$pdfStatus_createFinish){
                return $this->getPdfData($judgePdfStatus);
            }
        }



    }

    public function driverInsertPdfData($user_id)
    {
         return 'success';
    }

    public function containmentCompanyInserPdfData()
    {
        return 'success';
    }

    public function getPdfData($pdfData)
    {
        $data = [
            'pdf_fileNumber' => $pdfData['pdf_fileNumber'],
            'pdf_effectiveDate' => $pdfData['pdf_effectiveDate'],
            'pdf_buildingName' => $pdfData['pdf_buildingName'],

        ];
        $this->htmlToPDF($data);
    }

    public function signFileDecodeBase64($base64)
    {
        $fileName = uniqid();
        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'].'/assets/qrcode/'.$fileName.'.png',
            base64_decode(
                str_replace('data:image/png;base64,', '', $base64)
            )
        );
        echo '<img src="'.base_url("/assets/qrcode/".$fileName.".png").'" alt="QR Code" />';
    }

}
