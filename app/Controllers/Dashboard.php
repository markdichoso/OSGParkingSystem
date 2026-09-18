<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function main()
    {
        // session(); // Start the session

        $session = session();

        if (!$session->has('user_id') || !$session->has('user_fullname') || !$session->has('user_division')) {
            // User is not logged in, redirect to login page
            $session->setFlashdata('error', 'Please log in to access the dashboard.');
            echo "<script>
                    window.location.href = './';
                  </script>";
            exit; // Stop further execution
        }
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
