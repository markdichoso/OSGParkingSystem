<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        echo "USERNAME: " . $username . "<br>";

        // Query the database using CI4 Query Builder
        $user = $userModel->where('u_email', $username)
            ->orWhere('email', $username)
            ->first();

        if ($user) {
            // NOTE: Use password_verify() if stored as hash. 
            // If stored as plain text, use: if ($password === $user['password'])
            if (password_verify($password, $user['u_password'])) {
                $session->set([
                    'user_id'   => $user['u_empno'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to('./main');
            } else {
                $session->setFlashdata('error', 'Invalid password. Please try again.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'User not found.');
            return redirect()->back()->withInput();
        }
    }
}
