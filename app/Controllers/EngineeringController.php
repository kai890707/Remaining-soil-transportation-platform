<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EngineeringManagementModel;

class EngineeringController extends Controller
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

        $data = [
            "engineering_name"=>$engineering_name,
            "engineering_projectNumber" => $engineering_projectNumber
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


}
