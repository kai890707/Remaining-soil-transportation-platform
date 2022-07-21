<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class DocumentController extends Controller
{
    public $title = '營建剩餘土石方憑證系統';


    public function __construct()
    {

    }

    /**
     * [VIEW] 聯單使用狀態表
     *
     * @param [INT] $doc_id
     * @return view
     */
    public function index($doc_id)
    {
        $data = [
            "title" => $this->title . ' - 聯單',
        ];
        return view('documentList', $data);
    }

  
       
       
}
