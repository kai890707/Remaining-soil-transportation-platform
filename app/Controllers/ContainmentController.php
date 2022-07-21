<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ContainmentCompanyModel;

class ContainmentController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;
    protected $containmentCompanyModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->containmentCompanyModel = new containmentCompanyModel();
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
        
        $companyData = $this->containmentCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 公司資訊',
            "info"  => $companyData
        ];

        return view('user_shelter/companyInformation', $data);
    }

    /**
     * 個人資訊頁面
     *
     * @return view
     */
    public function personalView()
    {

        $companyData = $this->containmentCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 個人資訊',
            "info"  => $companyData
        ];
        
        return view('user_shelter/personal', $data);
    }
    
    /**
     * 個人資料更新
     *
     * @return json
     */
    public function personalUpdate()
    {
     
        $containmentCompanyPrincipalName = $this->request->getPostGet('containmentCompany_principalName');
        $containmentCompanyPrincipalPhone = $this->request->getPostGet('containmentCompany_principalPhone');
        $containmentCompanyPlaceAddress = $this->request->getPostGet('containmentCompany_placeAddress');
        $containmentCompanyAddress = $this->request->getPostGet('containmentCompany_address');

         $companyData=[
                'containmentCompany_principalName' => $containmentCompanyPrincipalName,
                'containmentCompany_principalPhone' => $containmentCompanyPrincipalPhone,
                'containmentCompany_placeAddress' => $containmentCompanyPlaceAddress,
                'containmentCompany_address' => $containmentCompanyAddress,
            ];

        $containmentCompany_id = $this->userModel
                               ->select('ContainmentCompany.containmentCompany_id')
                               ->where('User.user_id',$this->session->get('user_id'))
                               ->join('ContainmentCompany','User.user_id = ContainmentCompany.user_id')
                               ->first();

        $result =  $this->containmentCompanyModel->update($containmentCompany_id,$companyData);  
        
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
       
}
