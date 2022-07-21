<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PdfDocumentModel;
use App\Models\EngineeringManagementModel;

class DocumentController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $pdfDocumentModel;
    protected $engineeringManagementModel;
    public function __construct()
    {
        $this->pdfDocumentModel = new PdfDocumentModel();
        $this->engineeringManagementModel = new EngineeringManagementModel();
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
        // $projectStatus = $this->pdfDocumentModel
        //                       ->select('count()')                   

        $data = [
            "title" => $this->title . ' - 聯單',
            "projectInfo" => $projectInfo
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
        // return $project_id.$status_id;
        $projectInfo = $this->PdfDocumentModel
                            ->where('engineering_id',$project_id)
                            ->where('pdf_status',$status_id)
                            ->paginate(10);
        
    }
       
       
}
