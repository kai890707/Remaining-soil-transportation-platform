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
    public function pwa()
    {
        return view('pwa');
    }
}
