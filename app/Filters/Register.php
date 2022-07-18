<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Register implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         /**
         * 判斷是否存在user email這個session
         */
        if (!session()->get("permission_id") || session()->get("permission_id")!== "1" ||  session()->get("permission_name")!== "root" ) {
            return redirect()->to(base_url('/public/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}