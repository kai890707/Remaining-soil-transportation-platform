<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;

class ClearingCompanyController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;
    protected $contractingCompanyModel;
    protected $clearingDriverModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
        $this->clearDriverModel = new ClearingDriverModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {

    }
    /**
     * 公司資訊頁面
     *
     * @return view
     */
    public function companyInfoView()
    {

        $companyData = $this->clearingCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 公司資訊',
            "info"  => $companyData
        ];

        return view('user_company/companyInformation', $data);
    }

    /**
     * 個人資訊頁面
     *
     * @return view
     */
    public function personalView()
    {

         $companyData = $this->clearingCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 個人資訊',
            "info"  => $companyData
        ];

        return view('user_company/personal', $data);
    }

    /**
     * 個人資料更新
     *
     * @return json
     */
    public function personalUpdate()
    {

        $clearingCompanyPrincipalName = $this->request->getPostGet('clearingCompany_principalName');
        $clearingCompanyIdentityCard = $this->request->getPostGet('clearingCompany_identityCard');
        $clearingCompanyPhone = $this->request->getPostGet('clearingCompany_phone');
        $clearingCompanyAddress = $this->request->getPostGet('clearingCompany_address');

        $companyData=[
                'clearingCompany_principalName' => $clearingCompanyPrincipalName,
                'clearingCompany_identityCard' => $clearingCompanyIdentityCard,
                'clearingCompany_phone' => $clearingCompanyPhone,
                'clearingCompany_address' => $clearingCompanyAddress,
        ];

        $clearingCompany_id = $this->userModel
                               ->select('ClearingCompany.clearingCompany_id')
                               ->where('User.user_id',$this->session->get('user_id'))
                               ->join('ClearingCompany','User.user_id = ClearingCompany.user_id')
                               ->first();

        $result =  $this->clearingCompanyModel->update($clearingCompany_id,$companyData);

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


    public function getDriverData()
    {
        $permission_id = $session->get('permission_id');
        if($permission_id == $this::$permissionIdByClearingCompany){
            $clearingCompanyData = $this->clearingCompanyModel->where('user_id',$session->get('user_id'))->first();
            $clearingCompany_id = $clearingCompanyData['clearingCompany_id'];

            $driverData = $this->clearDriverModel->select('ClearingDriver.*')->where('clearingCompany_id',$clearingCompany_id)->paginate(10);

            $subTitle = '駕駛資訊查詢';
            $enSubTitle= "Driver List";

            $data = [
                "title" => $this->title . ' - '.$subTitle,
                "subTitle"=>$subTitle,
                "enSubTitle"=>$enSubTitle,
                "info"=>$driverData,
                "pager" => $this->clearDriverModel->pager,
            ];
            // return view('document/documentStatusList',$data);
        }
    }
}
