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
            unset($_SESSION['user_id']);
            unset($_SESSION['user_fullname']);
            unset($_SESSION['user_division']);
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

    public static function getParkedCarCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '1');
        return $builder->countAllResults();
    }

    public static function getAvailableFreeParkingCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '0');
        $builder->where('p_category', '0');
        return $builder->countAllResults();
    }

    public static function getAvailablePaidParkingCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '0');
        $builder->where('p_category', '1');
        return $builder->countAllResults();
    }
}
