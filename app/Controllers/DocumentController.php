<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\PdfDocumentModel;
use App\Models\EngineeringManagementModel;
use App\Controllers\QrcodeRender;

class DocumentController extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $pdfDocumentModel;
    protected $engineeringManagementModel;
    protected $pdfController;
    protected $db;
    public function __construct()
    {
        $this->pdfDocumentModel = new PdfDocumentModel();
        $this->engineeringManagementModel = new EngineeringManagementModel();
       
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
                                ->groupBy('status_id')
                                ->get()
                                ->getResultArray();

        $allproject = $this->pdfDocumentModel
                           ->countAll();

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
    
 

   

       
}
