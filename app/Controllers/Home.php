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
    public function authenticate()
    {
        $session = session();

        $username = $_POST['username'];
        $password = $_POST['password'];


        // Database configuration
        $host = 'osgweb-db.mysql.database.azure.com';
        $db   = 'osg_cpms_db';
        $u = 'osgwebdbadmin@osgweb-db'; // Update if you have a specific database user
        $p = '#0SGW3bDB!';     // Update with your database password


        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $u, $p);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connection successful!<br><br>";
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE u_email = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow) {


            if (hash('sha256', $password) === hash('sha256', $userRow['u_password'])) {
                // echo "Password match!<br>";
                // echo json_encode(['success' => true]);
                $session->set('user_id', $userRow['u_empno']);
                // $session->set('user_name', $userRow['u_name']);



                $stmt_profile = $pdo->prepare("SELECT * FROM userprofile_tbl WHERE up_empno = :empno LIMIT 1");
                $stmt_profile->execute(['empno' => $userRow['u_empno']]);
                $userProfileRow = $stmt_profile->fetch(PDO::FETCH_ASSOC);

                if ($userProfileRow) {
                    $session->set('user_fullname', $userProfileRow['up_fullname']);
                    $session->set('user_email', $userProfileRow['up_email']);
                    $session->set('user_contact', $userProfileRow['up_mobileno']);
                    $session->set('user_division', $userProfileRow['up_division']);
                    $session->set('user_image', $userProfileRow['up_image']);
                } else {
                    $session->set('user_fullname', ''); // Set to empty if not found
                }

                return redirect()->to(base_url('osgparkingsystem/main'));
            } else {
                // echo "Password does not match!<br>";
                // echo json_encode(['success' => false, 'message' => 'Invalid password.']);
                $session->setFlashdata('error', 'Invalid password. Please try again.');
                return redirect()->to('./')->withInput();
            }
        } else {
            // echo json_encode(['success' => false, 'message' => 'User not found.']);
            $session->setFlashdata('error', 'User not found. Please check your credentials.');
            // return redirect()->back()->withInput();
        }
    }
}
