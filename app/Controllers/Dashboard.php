<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function main()
    {
        return view('main/main');
    }

    public function qrcodescan()
    {
        return view('main/qrcodescan');
    }


    public function attendant()
    {
        return view('main/attendant');
    }


    public function assignParking()
    {
        return view('main/assign-parking');
    }

    public function userProfile()
    {
        return view('main/user-profile');
    }

    public function updateProfile()
    {
        return view('main/update-profile');
    }
}
