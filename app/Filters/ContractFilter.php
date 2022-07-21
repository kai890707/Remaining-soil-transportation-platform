<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ContractFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /**
         * 判斷是否存在user email這個session
         */
        if (!session()->has("user_email")||session()->get("permission_id")!== "2" ||  session()->get("permission_name")!== "承造廠商(公司)" ) {
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}