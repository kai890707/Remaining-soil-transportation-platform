<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ContainmentCompanyModel;
use App\Models\ContractingCompanyModel;
use App\Models\GovernmentModel;

/**
 * 註冊控制器
 * 身分別 => 已使用靜態變數定義於BaseController中
 */

class GovernmentController extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;
    protected $clearingCompanyModel;
    protected $clearingDriverModel;
    protected $containmentCompanyModel;
    protected $contractingCompanyModel;
    protected $governmentModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
        $this->clearingDriverModel = new ClearingDriverModel();
        $this->containmentCompanyModel = new ContainmentCompanyModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->governmentModel = new GovernmentModel();
        $this->db = db_connect();
        $this->session = \Config\Services::session();
    }


       /**
     * 政府單位資訊頁面
     *
     * @return view
     */
    public function governmentInfoView()
    {

        $governmentData = $this->governmentModel->getGovernmentData();

        $data = [
            "title" => $this->title . ' - 政府單位資訊',
            "info"  => $governmentData
        ];

        return view('user_government/governmentInfoView', $data);
    }


    public function governmentInfoUpdate()
    {

        $government_name = $this->request->getPostGet('government_name');
        $government_principalName = $this->request->getPostGet('government_principalName');
        $government_principalPhone = $this->request->getPostGet('government_principalPhone');
        $government_address = $this->request->getPostGet('government_address');

         $governmentData=[
                    'government_name' => $government_name,
                    'government_principalName' => $government_principalName,
                    'government_principalPhone' => $government_principalPhone,
                    'government_address' => $government_address,
        ];

        $government_id = $this->userModel
                               ->select('Government.government_id')
                               ->where('User.user_id',$this->session->get('user_id'))
                               ->join('Government','User.user_id = Government.user_id')
                               ->first();

        $result =  $this->governmentModel->update($government_id,$governmentData);

        if($result){
            $response=[
                    'status' => 'success',
                    'message' => '資料更新成功'
            ];
        }else{
            $response=[
                'status' => 'fail',
                'message' => '資料更新失敗'
            ];
        }

        return $this->response->setJSON($response);
    }

    /**
     * 政府單位個人資訊
     *
     * @return void
     */
    public function personalView()
    {
        $governmentData = $this->governmentModel->getGovernmentData();

        $data = [
            "title" => $this->title . ' - 個人資訊',
            "info"  => $governmentData
        ];
        
        return view('user_government/personal', $data);
    }
}