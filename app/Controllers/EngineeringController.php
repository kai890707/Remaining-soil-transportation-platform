<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EngineeringManagementModel;

class EngineeringController extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $engineeringManagementModel;

    public function __construct()
    {
        $this->engineeringManagementModel = new EngineeringManagementModel();
    }

     public function index()
    {
        $data = [
            "title" => $this->title . ' - 工程列表',
            'projects' => $this->engineeringManagementModel->paginate(10),
            'pager' => $this->engineeringManagementModel->pager,
        ];
        return view('projectList', $data);
    }

    /**
     * [VIEW]新增工程頁面
     *
     * @return view
     */
    public function projectCreateView()
    {
        $data = [
            "title" => $this->title . ' - 工程新增',
        ];
        return view('user_contract/projectCreate', $data);
    }


    /**
     * [POST]新增工程
     *
     * @return json
     */
    public function projectCreate()
    {
        $engineering_name =  $this->request->getPostGet('engineering_name');
        $engineering_projectNumber = $this->request->getPostGet('engineering_projectNumber');
        $contracting_id = session()->get('contracting_id');

        $data = [
            "engineering_name"=>$engineering_name,
            "engineering_projectNumber" => $engineering_projectNumber,
            "contractCompany_id" => $contracting_id
        ];

        $r = $this->engineeringManagementModel->insert($data);

        if($r){
            $response=[
                'status' => 'success',
                'message' => '工程新增成功',
            ];
        }else{
            $response=[
                'status' => 'fail',
                'message' => '工程新增失敗，請重新新增',
            ];
        }
        return $this->response->setJSON($response);

    }


    /**
     * 已存在結案聯單之工程，屬於工程結案區
     *
     * @param [type] $engineering_id
     * @return void
     */
    public function doneProjectView()
    {
        $contracting_id = session()->get('contracting_id');
      
        $doneProject = $this->engineeringManagementModel
                            ->join('ContractingCompany', 'ContractingCompany.contracting_id = EngineeringManagement.contractCompany_id')
                            ->join('PdfDocument', 'EngineeringManagement.engineering_id = PdfDocument.engineering_id')
                            ->where('PdfDocument.status_id', $this::$pdfStatus_signFinish)
                            ->where('PdfDocument.pdf_contractingCompanyId', $contracting_id)
                            ->paginate(10);

        // $completeDoc = $this->pdfDocumentModel
        //     ->join('EngineeringManagement', 'EngineeringManagement.engineering_id = PdfDocument.engineering_id')
        //     ->where('PdfDocument.status_id', $this::$pdfStatus_signFinish)
        //     ->where('PdfDocument.pdf_contractingCompanyId', $contract_id)
        //     ->paginate(10);
        $data = [
            "title" => $this->title . ' - 結案聯單工程列表',
            'projects' => $doneProject,
            'pager' => $this->engineeringManagementModel->pager,
        ];
        return view('user_contract/doucmentCompleteProject', $data);

    }

}
