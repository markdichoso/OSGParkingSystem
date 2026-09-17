<?php

namespace App\Controllers;

use App\Models\UserModel;
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
        $host = 'localhost';
        $db   = 'osg_cpms_db';
        $u = 'root'; // Update if you have a specific database user
        $p = '';     // Update with your database password


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
            // IMPORTANT: Use password_verify() if passwords in the DB are hashed (recommended).
            // If your passwords are saved as plain text (not recommended), use: if ($password === $userRow['password'])
            // echo "User found: " . $userRow['u_email'] . " - - Password: " . $password . "<br><br>";

            // echo "Password1 : " . hash('sha256', $password) . "<br>";
            // echo "Password2 : " . hash('sha256', $password) . "<br><br>";

            if ($password === $userRow['u_password']) {
                // echo "Password match!<br>";
                // echo json_encode(['success' => true]);
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
