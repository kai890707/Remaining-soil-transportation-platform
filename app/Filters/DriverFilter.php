<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class DriverFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /**
         * 判斷是否存在user email這個session
         */
        if (!session()->has("user_email")||session()->get("permission_id")!== "4" ||  session()->get("permission_name")!== "清運司機" ) {
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}