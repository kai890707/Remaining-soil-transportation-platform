<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ContainmentCompanyModel;
use App\Models\ContractingCompanyModel;

class RegisterController extends BaseController
{   

    protected $userModel;
    protected $clearingCompanyModel;
    protected $clearingDriverModel;
    protected $containmentCompanyModel;
    protected $contractingCompanyModel;
    protected $db;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
        $this->clearingDriverModel = new ClearingDriverModel(); 
        $this->containmentCompanyModel = new ContainmentCompanyModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->db = db_connect();
    }
    
    public function clearingDriverRegister()
    {
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));
        $driverName = $this->request->getPostGet('driver_name');
        $driverIdentityCard = $this->request->getPostGet('driver_identityCard');
        $driverLicensePlate = $this->request->getPostGet('driver_licensePlate');
        $driverPhone = $this->request->getPostGet('driver_phone');
        $driverBloodType = $this->request->getPostGet('driver_bloodType');
        $clearingCompanyUniformNumbers = $this->request->getPostGet('clearingCompany_uniformNumbers');

        if($this->userModel->where('user_email',$email)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此Email已存在'
            ];
        }else if(!$this->clearingCompanyModel->where('clearingCompany_uniformNumbers',$clearingCompanyUniformNumbers)->first()){
            $response=[
                'status' => 'fail',
                'message' => '公司統編不存在'
            ];
        }else{
            $findClearCompanyId = $this->clearingCompanyModel->where('clearingCompany_uniformNumbers',$clearingCompanyUniformNumbers)->first();
            $data = [
                'user_email' => $email,
                'user_password' => $password,
                'user_permission' => "3",
            ];
            $insertUser = $this->userModel->insert($data);
            if($insertUser){
                $getUserId = $insertUser->getInsertID();
                $driverData=[
                    'clearingDriver_name' => $driverName,
                    'clearingDriver_identityCard' => $driverIdentityCard,
                    'clearingDriver_licensePlate' => $driverLicensePlate,
                    'clearingDriver_phone' => $driverPhone,
                    'clearingDriver_bloodType' => $driverBloodType,
                    'clearingCompany_id ' => $findClearCompanyId['clearingCompany_id'],
                    'user_id' => $getUserId,
                    'permission_id' => "3",
                ];

                if($this->clearingDriverModel->save($driverData)){
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
            return $this->response->setJSON($response);
        }
    }

    public function clearingCompanyRegister()
    {
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));
        $clearingCompanyName = $this->request->getPostGet('clearingCompany_name');
        $clearingCompanyUniformNumbers = $this->request->getPostGet('clearingCompany_uniformNumbers');
        $clearingCompanyPrincipalName = $this->request->getPostGet('clearingCompany_principalName');
        $clearingCompanyIdentityCard = $this->request->getPostGet('clearingCompany_identityCard');
        $clearingCompanyPhone = $this->request->getPostGet('clearingCompany_phone');
        $clearingCompanyAddress = $this->request->getPostGet('clearingCompany_address');


        if($this->userModel->where('user_email',$email)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此Email已存在'
            ];
        }else if($this->clearingCompanyModel->where('clearingCompany_uniformNumbers',$clearingCompanyUniformNumbers)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此統編已存在'
            ];
        }else{
            $data = [
                'user_email' => $email,
                'user_password' => $password,
                'user_permission' => "2",
            ];
            $insertUser = $this->userModel->insert($data);
            if($insertUser){
                $getUserId = $insertUser->getInsertID();
            }

            $companyData=[
                'clearingCompany_name' => $clearingCompanyName,
                'clearingCompany_uniformNumbers' => $clearingCompanyUniformNumbers,
                'clearingCompany_principalName' => $clearingCompanyPrincipalName,
                'clearingCompany_identityCard' => $clearingCompanyIdentityCard,
                'clearingCompany_phone' => $clearingCompanyPhone,
                'clearingCompany_address ' => $clearingCompanyAddress,
                'user_id' => $getUserId,
                'permission_id' => "2",
            ];

            if($this->clearingCompanyModel->save($companyData)){
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
        return $this->response->setJSON($response);
    }


    public function containmentcompanyRegister()
    {
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));
        $containmentCompanyUniformNumbers = $this->request->getPostGet('containmentCompany_uniformNumbers');
        $containmentCompanyName = $this->request->getPostGet('containmentCompany_name');
        $containmentCompanyPrincipalName = $this->request->getPostGet('containmentCompany_principalName');
        $containmentCompanyPrincipalPhone = $this->request->getPostGet('containmentCompany_principalPhone');
        $containmentCompanyPlaceAddress = $this->request->getPostGet('containmentCompany_placeAddress');
        $containmentCompanyAddress = $this->request->getPostGet('containmentCompany_address');
        
        if($this->userModel->where('user_email',$email)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此Email已存在'
            ];
        }else if($this->containmentCompanyModel->where('containmentCompany_uniformNumbers',$containmentCompanyUniformNumbers)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此統編已存在'
            ];
        }else{
            $data = [
                'user_email' => $email,
                'user_password' => $password,
                'user_permission' => "4",
            ];

            $insertUser = $this->userModel->insert($data);
            if($insertUser){
                $getUserId = $insertUser->getInsertID();
            }

            $companyData=[
                'containmentCompany_uniformNumbers' => $containmentCompanyUniformNumbers,
                'containmentCompany_name' => $containmentCompanyName,
                'containmentCompany_principalName' => $containmentCompanyPrincipalName,
                'containmentCompany_principalPhone' => $containmentCompanyPrincipalPhone,
                'containmentCompany_placeAddress' => $containmentCompanyPlaceAddress,
                'containmentCompany_address ' => $containmentCompanyAddress,
                'user_id' => $getUserId,
                'permission_id' => "4",
            ];

            if($this->clearingCompanyModel->save($companyData)){
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

        return $this->response->setJSON($response);
    }


    public function contractingcompanyRegister(){
        $email = $this->request->getPostGet('user_email');
        $password = sha1($this->request->getPostGet('user_password'));
        $contractingCompanyName = $this->request->getPostGet('contracting_companyName');
        $contractingUniformNumbers = $this->request->getPostGet('contracting_uniformNumbers');
        $contractingContractUserName = $this->request->getPostGet('contracting_contractUserName');
        $contractingContractUserPhone = $this->request->getPostGet('contracting_contractUserPhone');
        $contractingContractWatcherName = $this->request->getPostGet('contracting_contractWatcherName');
        $contractingContractWatcherPhone = $this->request->getPostGet('contracting_contractWatcherPhone');
        $contractingCompanyAddress = $this->request->getPostGet('contracting_companyAddress');
        
        if($this->userModel->where('user_email',$email)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此Email已存在'
            ];
        }else if($this->contractingCompanyModel->where('contracting_uniformNumbers',$contractingUniformNumbers)->first()){
            $response=[
                'status' => 'fail',
                'message' => '此統編已存在'
            ];
        }else{
            $data = [
                'user_email' => $email,
                'user_password' => $password,
                'user_permission' => "1",
            ];

            $insertUser = $this->userModel->insert($data);
            if($insertUser){
                $getUserId = $insertUser->getInsertID();
            }

            $companyData=[
                'contracting_companyName' => $contractingCompanyName,
                'contracting_uniformNumbers' => $contractingUniformNumbers,
                'contracting_contractUserName' => $contractingContractUserName,
                'contracting_contractUserPhone' => $contractingContractUserPhone,
                'contracting_contractWatcherName' => $contractingContractWatcherName,
                'contracting_contractWatcherPhone ' => $contractingContractWatcherPhone,
                'contracting_companyAddress ' => $contractingCompanyAddress,
           
                'user_id' => $getUserId,
                'permission_id' => "1",
            ];

            if($this->contractingCompanyModel->save($companyData)){
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

        return $this->response->setJSON($response);
    }
   

}