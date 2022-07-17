<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Permission implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         /**
         * 判斷是否存在user email這個session
         */
        if (!session()->get("user_email")) {
            return redirect()->to(base_url('/public/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}