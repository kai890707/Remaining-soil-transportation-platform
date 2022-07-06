<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            "title"=> '營建剩餘土石方憑證系統'
        ];
        return view('home',$data);
    }
    public function pwa()
    {
        return view('pwa');
    }
}
