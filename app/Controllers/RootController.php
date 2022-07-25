<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ClearingCompanyModel;
use App\Models\ClearingDriverModel;
use App\Models\ContainmentCompanyModel;
use App\Models\ContractingCompanyModel;

class RootController extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    protected $clearingCompanyModel;
    protected $clearingDriverModel;
    protected $containmentCompanyModel;
    protected $contractingCompanyModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clearingCompanyModel = new ClearingCompanyModel();
        $this->clearingDriverModel = new ClearingDriverModel();
        $this->containmentCompanyModel = new ContainmentCompanyModel();
        $this->contractingCompanyModel = new ContractingCompanyModel();
    }

    public function accountLobby()
    {
        $data = [
            "title" => $this->title . ' - 超級帳號'
        ];
        return view('user_root/accountLobby', $data);
    }
    public function accountCreate()
    {
         $data = [
            "title" => $this->title . ' - 超級帳號(子身分註冊)'
        ];
        return view('user_root/accountCreate', $data);
    }
    public function accountManage()
    {
        $data = [
            "title" => $this->title . ' - 超級帳號(帳號管理)',
            'users' => $this->userModel
                            ->select('User.*,Permission.permission_name')
                            ->join('Permission','User.permission_id = Permission.permission_id')
                            ->paginate(10),
            'pager' => $this->userModel->pager,
        ];
        return view('user_root/accountManage', $data);
    }
    
    /**
     * Root查看&修改user資料
     *
     * @param [INT] $user_id
     * @return view
     */
    public function updateUser($user_id)
    {   
        $getUser = $this->userModel
                        ->where('user_id',$user_id)
                        ->first();
        $getUserPermission = $getUser['permission_id'];

        $info = "";

        switch ($getUserPermission) {
            case $this::$permissionIdByRoot:
                $info = $this->userModel
                             ->where('user_id',$getUser['user_id'])
                             ->first();
                break;
            case $this::$permissionIdByContractingCompany:
                $info = $this->contractingCompanyModel
                             ->where('ContractingCompany.user_id',$getUser['user_id'])
                             ->join('User','ContractingCompany.user_id = User.user_id')
                             ->first();
                break;
            case $this::$permissionIdByClearingCompany:
                $info = $this->clearingCompanyModel
                             ->where('ClearingCompany.user_id',$getUser['user_id'])
                             ->join('User','ClearingCompany.user_id = User.user_id')
                             ->first();
                break;
            case $this::$permissionIdByClearingDriver:
                $info = $this->clearingDriverModel
                            ->where('ClearingDriver.user_id',$getUser['user_id'])
                            ->join('User','ClearingDriver.user_id = User.user_id')
                            ->join('ClearingCompany','ClearingCompany.clearingCompany_id = ClearingDriver.clearingCompany_id')
                            ->first();
                break;
            case $this::$permissionIdByContainmentCompany:
                $info = $this->containmentCompanyModel
                             ->where('ContainmentCompany.user_id',$getUser['user_id'])
                             ->join('User','ContainmentCompany.user_id = User.user_id')
                             ->first();
                break;
            case $this::$permissionIdByGovernment:
                # code...
                break;
            default:
                break;
        }

        $data = [
            "title" => $this->title . ' - 查看帳號資訊',
            "info"  => $info,
            "permission_id"=>$getUserPermission
        ];
        
        return view('user_root/accountUpdateInfo', $data);

    }

    /**
     * [POST]更新使用者資料
     *
     * @return json
     */
    public function personalUpdate()
    {
        $permission_id = $this->request->getPostGet('permission_id');
        $user_id = $this->request->getPostGet('user_id');
        if($permission_id == $this::$permissionIdByRoot){
            $user_id = $this->request->getPostGet('user_id');
            $oldPassword = $this->request->getPostGet('user_password');
            $isUser = $this->userModel->where('user_id',$user_id)
                                      ->where('user_password',sha1($oldPassword))
                                      ->first();
            if($isUser){
                $updateData = [
                    "user_password" => sha1($this->request->getPostGet('new_password'))
                ];
                $r = $this->userModel->update($user_id,$updateData);
                if($r){
                    $response=[
                        'status' => 'success',
                        'message' => '密碼修改成功'
                    ];
                }else{
                    $response=[
                        'status' => 'fail',
                        'message' => '密碼修改失敗1'
                    ];
                }
            }else{
                $response=[
                        'status' => 'fail',
                        'message' => '密碼修改失敗2'
                ];
            }
        }else if($permission_id == $this::$permissionIdByContractingCompany){
            $response = $this->contractUpdate($user_id);
        }else if($permission_id == $this::$permissionIdByClearingDriver){
            $response = $this->driverUpdate($user_id);
        }else if($permission_id == $this::$permissionIdByClearingCompany){
            $response = $this->companyUpdate($user_id);
        }else if($permission_id == $this::$permissionIdByContainmentCompany){
            $response = $this->containmentUpdate($user_id);

        }
        return $this->response->setJSON($response);
    }
    /**
     * [call] Root更新承造資料
     *
     * @param [type] $user_id
     * @return void
     */
    public function contractUpdate($user_id)
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
                               ->where('User.user_id',$user_id)
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
        return $response;
    }

    /**
     * [call] Root更新司機資料
     *
     * @param [type] $user_id
     * @return void
     */
    public function driverUpdate($user_id)
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
                               ->where('User.user_id',$user_id)
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
        return $response;
    }

    /**
     * [call] Root更新清運公司資料
     *
     * @param [type] $user_id
     * @return void
     */
    public function companyUpdate($user_id)
    {
        $clearingCompanyName = $this->request->getPostGet('clearingCompany_name');
        $clearingCompanyUniformNumbers = $this->request->getPostGet('clearingCompany_uniformNumbers');
        $clearingCompanyPrincipalName = $this->request->getPostGet('clearingCompany_principalName');
        $clearingCompanyIdentityCard = $this->request->getPostGet('clearingCompany_identityCard');
        $clearingCompanyPhone = $this->request->getPostGet('clearingCompany_phone');
        $clearingCompanyAddress = $this->request->getPostGet('clearingCompany_address');

        $companyData=[
                'clearingCompany_name'=>$clearingCompanyName,
                'clearingCompany_uniformNumbers'=>$clearingCompanyUniformNumbers,
                'clearingCompany_principalName' => $clearingCompanyPrincipalName,
                'clearingCompany_identityCard' => $clearingCompanyIdentityCard,
                'clearingCompany_phone' => $clearingCompanyPhone,
                'clearingCompany_address' => $clearingCompanyAddress,
        ];

        $clearingCompany_id = $this->userModel
                               ->select('ClearingCompany.clearingCompany_id')
                               ->where('User.user_id',$user_id)
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

        return $response;
    }

    /**
     * [call] Root更新收容資料
     *
     * @param [type] $user_id
     * @return void
     */
    public function containmentUpdate($user_id)
    {
        $containmentCompanyName = $this->request->getPostGet('containmentCompany_name');
        $containmentCompanyUniformNumbers = $this->request->getPostGet('containmentCompany_uniformNumbers');
        $containmentCompanyPrincipalName = $this->request->getPostGet('containmentCompany_principalName');
        $containmentCompanyPrincipalPhone = $this->request->getPostGet('containmentCompany_principalPhone');
        $containmentCompanyPlaceAddress = $this->request->getPostGet('containmentCompany_placeAddress');
        $containmentCompanyAddress = $this->request->getPostGet('containmentCompany_address');

         $companyData=[
                'containmentCompany_name'=>$containmentCompanyName,
                'containmentCompany_uniformNumbers'=>$containmentCompanyUniformNumbers,
                'containmentCompany_principalName' => $containmentCompanyPrincipalName,
                'containmentCompany_principalPhone' => $containmentCompanyPrincipalPhone,
                'containmentCompany_placeAddress' => $containmentCompanyPlaceAddress,
                'containmentCompany_address' => $containmentCompanyAddress,
            ];

        $containmentCompany_id = $this->userModel
                               ->select('ContainmentCompany.containmentCompany_id')
                               ->where('User.user_id',$user_id)
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
        return $response;
    }
}
