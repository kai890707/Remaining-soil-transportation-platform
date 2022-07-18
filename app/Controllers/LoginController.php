<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ContainmentCompanyModel;
use App\Models\ContractingCompanyModel;


class LoginController extends BaseController
{
    protected $userModel;
    protected $clearingCompanyModel;
    protected $clearingDriverModel;
    protected $containmentCompanyModel;
    protected $contractingCompanyModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
        $this->clearingDriverModel = new ClearingDriverModel();
        $this->containmentCompanyModel = new ContainmentCompanyModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->db = db_connect();
        $this->session = \Config\Services::session();
    }

    public function LoginCheck()
    {
        $data = $this->request->getVar();
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));

        $loginCheck = $this->userModel->where('user_email',$email)->where('user_password',$password)->first();
        if($loginCheck){
            $permission_id = $loginCheck['permission_id'];
            if($permission_id == $this::$permissionIdByClearingDriver){
                return $this->LoginForClearingDriver($loginCheck['user_id']);
            }

        }else{
            $response=[
                'status' => 'fail',
                'message' => '帳號密碼輸入錯誤'
            ];
            return $this->response->setJSON($response);
        }


    }


    public function LoginForClearingDriver($user_id)
    {
        $getDriverData = $this->clearingDriverModel->where('user_id',$user_id)->first();
        if($getDriverData){
            $this->session->start();
            $this->session = session();
            $this->session->set('user_id',$user_id);
            $this->session->set('clearingDriver_name',$getDriverData['clearingDriver_name']);
            $this->session->set('clearingDriver_identityCard',$getDriverData['clearingDriver_identityCard']);
            $this->session->set('clearingDriver_licensePlate',$getDriverData['clearingDriver_licensePlate']);
            $this->session->set('clearingDriver_phone',$getDriverData['clearingDriver_phone']);
            $this->session->set('clearingDriver_bloodType',$getDriverData['clearingDriver_bloodType']);
            $this->session->set('clearingCompany_id',$getDriverData['clearingCompany_id']);
            $this->session->set('permission_id',$getDriverData['permission_id']);

            $response=[
                'status' => 'success',
                'message' => '登入成功'
            ];

        }else{
            $response=[
                'status' => 'fail',
                'message' => '登入失敗'
            ];
        }

        return $this->response->setJSON($response);
    }

}