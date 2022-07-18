<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PermissionModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ContainmentCompanyModel;
use App\Models\ContractingCompanyModel;


class LoginController extends BaseController
{
    protected $userModel;
    protected $permissionModel;
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
        $this->permissionModel = new PermissionModel();
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
            return $this->LoginAndSetSession($loginCheck['user_id'],$loginCheck['user_email'],$permission_id);

        }else{
            $response=[
                'status' => 'fail',
                'message' => '帳號密碼輸入錯誤',
            ];
            return $this->response->setJSON($response);
        }


    }


    public function LoginAndSetSession($user_id,$user_email,$permission_id)
    {

        
        $response=[
            'status' => 'success',
            'message' => '成功',
        ];
        //清運司機session set
        if($permission_id ==  $this::$permissionIdByClearingDriver){
            $getDriverData = $this->clearingDriverModel->where('user_id',$user_id)->first();
            $getDriverData['user_email'] = $user_email;
            foreach ($getDriverData as $key => $value) {
                $this->session->set($key,$value);
            }
            $permission_name = $this->permissionModel->getPermissonName($permission_id);
            $this->session->set($permission_name);

        }else if($permission_id ==  $this::$permissionIdByClearingCompany){    //清運公司session set
            $getClearCompanyData = $this->clearingCompanyModel->where('user_id',$user_id)->first();
            $getClearCompanyData['user_email'] = $user_email;
            foreach ($getClearCompanyData as $key => $value) {
                $this->session->set($key,$value);
            }
            $permission_name = $this->permissionModel->getPermissonName($permission_id);
            $this->session->set($permission_name);
        }else if($permission_id ==  $this::$permissionIdByContractingCompany){ //承造公司session set
            $getContractCompanyData = $this->contractingCompanyModel->where('user_id',$user_id)->first();
            $getContractCompanyData['user_email'] = $user_email;
            foreach ($getContractCompanyData as $key => $value) {
                $this->session->set($key,$value);
            }
            $permission_name = $this->permissionModel->getPermissonName($permission_id);
            $this->session->set($permission_name);
        }else if($permission_id ==  $this::$permissionIdByContainmentCompany){ //收容公司session set
            $getContainmentCompanyData = $this->containmentCompanyModel->where('user_id',$user_id)->first();
            $getContainmentCompanyData['user_email'] = $user_email;
            foreach ($getContainmentCompanyData as $key => $value) {
                $this->session->set($key,$value);
            }
            $permission_name = $this->permissionModel->getPermissonName($permission_id);
            $this->session->set($permission_name);
        }else if($permission_id ==  $this::$permissionIdByRoot){ //root session set
            $this->session->set('user_id',$user_id);
            $this->session->set('user_email',$user_email);
            $this->session->set('permission_id',$permission_id);
            $permission_name = $this->permissionModel->getPermissonName($permission_id);
            $this->session->set($permission_name);
        }
        else{
            $response=[
                'status' => 'fail',
                'message' => '登入失敗'
            ];
        }

        return $this->response->setJSON($response);

    }
    public function logout()
    {
        // return "213";
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}