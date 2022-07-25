<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ClearingDriverModel;
use App\Models\PdfDocumentModel;
use App\Models\EngineeringManagementModel;

class DriverController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;
    protected $clearingDriverModel;
    protected $pdfDocumentModel;
    protected $engineeringModel;
    protected $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingDriverModel = new ClearingDriverModel();
        $this->pdfDocumentModel = new PdfDocumentModel();
        $this->engineeringModel = new EngineeringManagementModel();
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
        
        $companyData = $this->clearingDriverModel
                            ->where('ClearingDriver.clearingCompany_id',$this->session->get('clearingCompany_id'))
                            ->join('ClearingCompany','ClearingCompany.clearingCompany_id = ClearingDriver.clearingCompany_id')
                            ->first();

        $data = [
            "title" => $this->title . ' - 公司資訊',
            "info"  => $companyData
        ];

        return view('user_driver/companyInformation', $data);
    }

    /**
     * 個人資訊頁面
     *
     * @return view
     */
    public function personalView()
    {
        $companyData = $this->clearingDriverModel
                            ->where('ClearingDriver.clearingCompany_id',$this->session->get('clearingCompany_id'))
                            ->join('ClearingCompany','ClearingCompany.clearingCompany_id = ClearingDriver.clearingCompany_id')
                            ->first();

        $driverData = $this->clearingDriverModel->getDriverData();

        $data = [
            "title" => $this->title . ' - 個人資訊',
            "company"=>$companyData,
            "info"  => $driverData
        ];
        
        return view('user_driver/personal', $data);
    }
    
    /**
     * 個人資料更新
     *
     * @return json
     */
    public function personalUpdate()
    {
     
        $driverName = $this->request->getPostGet('driver_name');
        $driverIdentityCard = $this->request->getPostGet('driver_identityCard');
        $driverLicensePlate = $this->request->getPostGet('driver_licensePlate');
        $driverPhone = $this->request->getPostGet('driver_phone');
        $driverBloodType = $this->request->getPostGet('driver_bloodType');

         $driverData=[
                    'clearingDriver_name' => $driverName,
                    'clearingDriver_identityCard' => $driverIdentityCard,
                    'clearingDriver_licensePlate' => $driverLicensePlate,
                    'clearingDriver_phone' => $driverPhone,
                    'clearingDriver_bloodType' => $driverBloodType,
        ];

        $driver_id = $this->userModel
                               ->select('ClearingDriver.clearingDriver_id')
                               ->where('User.user_id',session()->get('user_id'))
                               ->join('ClearingDriver','User.user_id = ClearingDriver.user_id')
                               ->first();

        $result =  $this->clearingDriverModel->update($driver_id,$driverData);  
        
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
     * 執行中聯單
     *
     * @return void
     */
    public function execution()
    {
        $driver_id = $this->userModel
                          ->select('ClearingDriver.clearingDriver_id')
                          ->where('User.user_id',session()->get('user_id'))
                          ->join('ClearingDriver','User.user_id = ClearingDriver.user_id')
                          ->first();

        $getExecutionDoc = $this->pdfDocumentModel
                                ->join('EngineeringManagement','EngineeringManagement.engineering_id = PdfDocument.engineering_id')
                                ->where('PdfDocument.pdf_clearingDriverId',$driver_id)
                                ->where('PdfDocument.pdf_containmentCompanyId',"")
                                ->paginate(10);
         $data = [
            "title" => $this->title . ' - 執行中聯單',
            "projects"  => $getExecutionDoc,
            'pager'=>$this->pdfDocumentModel->pager
        ];
        
        return view('user_driver/execution', $data);
    }
       
}
