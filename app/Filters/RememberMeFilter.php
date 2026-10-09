<?php

namespace App\Filters;

use App\Libraries\RememberMe;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RememberMeFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        (new RememberMe())->restore($request, service('response'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
