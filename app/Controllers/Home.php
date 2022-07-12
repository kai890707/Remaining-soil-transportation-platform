<?php

namespace App\Controllers;

class Home extends BaseController
{
    public $title = '營建剩餘土石方憑證系統';
    public function index()
    {
        $data = [
            "title"=> $this->title
        ];
        return view('home',$data);
    }
    public function register()
    {
        $data = [
            "title" => $this->title.' - 司機註冊'
        ];
        return view('register', $data); 
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
    public function pwa()
    {
        return view('pwa');
    }
}
