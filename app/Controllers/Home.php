<?php

namespace App\Controllers;

// use App\Models\UserModel;
use PDO;
use PDOException;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login(): string
    {
        return view('login/index');
    }

    public function register(): string
    {
        return view('main/register');
    }
    public function authenticate(): string
    {
        $session = session();

        $username = $_POST['username'];
        $password = $_POST['password'];


        echo "USERNAME : " . $username . "<br><br>";

        // if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
        //     $host = LOC_HOST;
        //     $db   = LOC_DB;
        //     $u = LOC_USER; // Update if you have a specific database user
        //     $p = LOC_PASS; // Update with your database password
        // } else {
        //     $host = SRV_HOST;
        //     $db   = SRV_DB;
        //     $u = SRV_USER; // Update if you have a specific database user
        //     $p = SRV_PASS; // Update with your database password
        // }


        // try {
        //     $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $u, $p);
        //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // } catch (PDOException $e) {
        //     echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
        //     exit;
        // }

        // $stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE u_email = :username LIMIT 1");
        // $stmt->execute(['username' => $username]);
        // $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($userRow) {


        //     if (hash('sha256', $password) === hash('sha256', $userRow['u_password'])) {
        //         $session->set('user_id', $userRow['u_empno']);



        //         $stmt_profile = $pdo->prepare("SELECT * FROM userprofile_tbl WHERE up_empno = :empno LIMIT 1");
        //         $stmt_profile->execute(['empno' => $userRow['u_empno']]);
        //         $userProfileRow = $stmt_profile->fetch(PDO::FETCH_ASSOC);

        //         if ($userProfileRow) {
        //             $session->set('user_fullname', $userProfileRow['up_fullname']);
        //             $session->set('user_email', $userProfileRow['up_email']);
        //             $session->set('user_contact', $userProfileRow['up_mobileno']);
        //             $session->set('user_division', $userProfileRow['up_division']);
        //             $session->set('user_role', $userProfileRow['up_role']);
        //             $session->set('user_image', $userProfileRow['up_image']);
        //         } else {
        //             $session->set('user_fullname', ''); // Set to empty if not found
        //         }

        //         if ($session->get('user_role') === 0) {
        //             return redirect()->to(base_url('admin-dashboard'));
        //         } elseif ($session->get('user_role') === 1) {
        //             return redirect()->to(base_url('attendant'));
        //         } else {
        //             return redirect()->to(base_url('main'));
        //         }
        //     } else {
        //         $session->setFlashdata('error', 'Invalid password. Please try again.');
        //         return redirect()->to(base_url()); //->withInput();
        //     }
        // } else {
        //     $session->setFlashdata('error', 'User not found. Please check your credentials.');
        //     return redirect()->to(base_url()); //->withInput();
        // }
    }

    public function signout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
