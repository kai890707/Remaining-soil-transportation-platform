<?php

namespace App\Controllers;
use App\Models\ClearingCompanyModel;
use App\Models\UserModel;
class Home extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $clearingCompanyModel;
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
    }
 

    public function index()
    {
        if (session()->get("user_email")) {
            return redirect()->to(base_url('/lobby'));
        }
        $data = [
            "title"=> $this->title
        ];
        return view('home',$data);
    }
    public function errorPage()
    {
        $data = [
            "title"=> $this->title . '- 查無頁面'
        ];
        return view('404',$data);
    }

    public function register()
    {
        $company = $this->clearingCompanyModel->getCompanyName();
        $data = [
            "title" => $this->title.' - 司機註冊',
            "company"=>$company
        ];
        return view('register', $data); 
    }
    /**
     * 清運司機註冊
     *
     * @return json
     */
    public function clearingDriverRegister()
    {
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));
        $driverName = $this->request->getPostGet('driver_name');
        $driverIdentityCard = $this->request->getPostGet('driver_identityCard');
        $driverLicensePlate = $this->request->getPostGet('driver_licensePlate');
        $driverPhone = $this->request->getPostGet('driver_phone');
        $driverBloodType = $this->request->getPostGet('driver_bloodType');
        $clerringCompanyId = $this->request->getPostGet('clearingCompanyId');

        if($this->userModel->where('user_email',$email)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此Email已存在'
            ];
        }else{
            $data = [
                'user_email' => $email,
                'user_password' => $password,
                'permission_id' => $this::$permissionIdByClearingDriver,
            ];
            $insertUser = $this->userModel->insert($data);
            if($insertUser){
                $getUserId = $insertUser;
                $driverData=[
                    'clearingDriver_name' => $driverName,
                    'clearingDriver_identityCard' => $driverIdentityCard,
                    'clearingDriver_licensePlate' => $driverLicensePlate,
                    'clearingDriver_phone' => $driverPhone,
                    'clearingDriver_bloodType' => $driverBloodType,
                    'clearingCompany_id' => $clerringCompanyId,
                    'user_id' => $getUserId,
                    'permission_id' => $this::$permissionIdByClearingDriver,
                ];

                if($this->clearingDriverModel->insert($driverData)){
                    $response=[
                        'status' => 'success',
                        'message' => '註冊成功'
                    ];
                }else{
                    $response=[
                        'status' => 'fail',
                        'message' => '註冊失敗'
                    ];
                }
            }
        }
        return $this->response->setJSON($response);
    }

    public function lobby()
    {
        $data = [
            "title" => $this->title . ' - 大廳'
        ];
        return view('lobby', $data);
    }
    public function personal()
    {
        $data = [
            "title" => $this->title . ' - 個人資訊'
        ];
        return view('personal', $data);
    }
    public function projectList()
    {
        $data = [
            "title" => $this->title . ' - 工程列表'
        ];
        return view('projectList', $data);
    }
    public function documentUse()
    {
        $data = [
            "title" => $this->title . ' - 聯單使用(司機)'
        ];
        return view('documentUse', $data);
    }
    public function documentList()
    {
        $data = [
            "title" => $this->title . ' - 工程流量編號清單'
        ];
        return view('documentList', $data);
    }
    public function qrscan()
    {
        // $data = [
        //     "title" => $this->title . ' - 聯單使用(司機)'
        // ];
        return view('qrscan');
    }
    public function sign()
    {
        $data = [
            "title" => $this->title . ' - 簽章使用'
        ];
        return view('sign',$data);
    }
    public function signRecords()
    {
        $data = [
            "title" => $this->title . ' - 使用狀態'
        ];
        return view('signRecords', $data);
    }
    public function project()
    {
        $data = [
            "title" => $this->title . ' - 工程聯單列表'
        ];
        return view('project', $data);
    }

    /**
     * 公開路由司機註冊
     *
     * @return void
    */     
    public function registerByDriver()
    {
        # code...
    }
    public function pwa()
    {
        return view('pwa');
    }
}
