<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class RootController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';
    protected $userModel;

    public function index()
    {
        
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
        $this->userModel = new UserModel();
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
       
       
}
