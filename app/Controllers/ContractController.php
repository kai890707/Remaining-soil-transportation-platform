<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ContractingCompanyModel;

class ContractController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;
    protected $contractingCompanyModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
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
        
        $companyData = $this->contractingCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 公司資訊',
            "info"  => $companyData
        ];

        return view('user_contract/companyInformation', $data);
    }

    /**
     * 個人資訊頁面
     *
     * @return view
     */
    public function personalView()
    {

        $companyData = $this->contractingCompanyModel->getCompanyData();

        $data = [
            "title" => $this->title . ' - 個人資訊',
            "info"  => $companyData
        ];
        
        return view('user_contract/personal', $data);
    }
    
    /**
     * 個人資料更新
     *
     * @return json
     */
    public function personalUpdate()
    {
     
         $contractingCompanyName = $this->request->getPostGet('contracting_companyName');
        $contractingUniformNumbers = $this->request->getPostGet('contracting_uniformNumbers');
        $contractingContractUserName = $this->request->getPostGet('contracting_contractUserName');
        $contractingContractUserPhone = $this->request->getPostGet('contracting_contractUserPhone');
        $contractingContractWatcherName = $this->request->getPostGet('contracting_contractWatcherName');
        $contractingContractWatcherPhone = $this->request->getPostGet('contracting_contractWatcherPhone');
        $contractingCompanyAddress = $this->request->getPostGet('contracting_companyAddress');

        $companyData=[
                'contracting_companyName'=> $contractingCompanyName,
                'contracting_uniformNumbers'=>$contractingUniformNumbers,
                'contracting_contractUserName' => $contractingContractUserName,
                'contracting_contractUserPhone' => $contractingContractUserPhone,
                'contracting_contractWatcherName' => $contractingContractWatcherName,
                'contracting_contractWatcherPhone' => $contractingContractWatcherPhone,
                'contracting_companyAddress' => $contractingCompanyAddress,
        ];

        $contracting_id = $this->userModel
                               ->select('ContractingCompany.contracting_id')
                               ->where('User.user_id',session()->get('user_id'))
                               ->join('ContractingCompany','User.user_id = ContractingCompany.user_id')
                               ->first();

        $result =  $this->contractingCompanyModel->update($contracting_id,$companyData);  
        
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
     * [VIEW] 聯單新增
     *
     * @param [INT] $project_id(工程ID)
     * @return view
     */
    public function documentCreateView($project_id)
    {
        
        $data = [
            "title" => $this->title . ' - 聯單新增',
            "engineering_id" => $project_id
        ];
        
        return view('user_contract/documentCreate', $data);
    }
}
