<?php

namespace App\Controllers;

use App\Libraries\RememberMe;
use PDO;
use PDOException;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login()
    {
        $session = session();
        if ($session->get('user_id')) {
            if ((int) $session->get('user_role') === 0) {
                return redirect()->to(base_url('admin-dashboard'));
            }
            if ((int) $session->get('user_role') === 1) {
                return redirect()->to(base_url('attendant'));
            }
            return redirect()->to(base_url('main'));
        }

        return view('login/index');
    }

    public function register()
    {
        return view('main/register');
    }

    public function registerSubmit()
    {
        $session = session();
        if (!$this->request->is('post')) {
            return view('main/registration-submit', [
                'registrationDetails' => $session->getFlashdata('registration_details'),
                'notificationSent' => $session->getFlashdata('registration_notification_sent'),
            ]);
        }

        $emailAddress = strtolower(trim((string) $this->request->getPost('email')));
        $employeeNumber = trim((string) $this->request->getPost('employee_number'));
        $password = (string) $this->request->getPost('password');
        $passwordConfirmation = (string) $this->request->getPost('password_confirmation');

        if (!preg_match('/\A[a-zA-Z0-9._%+-]+@osg\.gov\.ph\z/i', $emailAddress)) {
            $session->setFlashdata('error', 'Enter a valid OSG email address.');
            return redirect()->back()->withInput();
        }
        if (!preg_match('/\A\d{4}-\d{5}\z/', $employeeNumber)) {
            $session->setFlashdata('error', 'Employee number must use the format YYYY-NNNNN.');
            return redirect()->back()->withInput();
        }
        if (
            strlen($password) < 8
            || !preg_match('/[A-Z]/', $password)
            || !preg_match('/[a-z]/', $password)
            || !preg_match('/\d/', $password)
            || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)
        ) {
            $session->setFlashdata('error', 'Password must be at least 8 characters and include uppercase, lowercase, number, and special characters.');
            return redirect()->back()->withInput();
        }
        if (!hash_equals($password, $passwordConfirmation)) {
            $session->setFlashdata('error', 'The password confirmation does not match.');
            return redirect()->back()->withInput();
        }

        $db = \Config\Database::connect();
        $existingAccount = $db->table('users_tbl')
            ->groupStart()
            ->where('u_email', $emailAddress)
            ->orWhere('u_empno', $employeeNumber)
            ->groupEnd()
            ->countAllResults();
        if ($existingAccount > 0) {
            $session->setFlashdata('error', 'An account with that email address or employee number already exists.');
            return redirect()->back()->withInput();
        }

        $registrationDate = date('Y-m-d H:i:s');
        try {
            $inserted = $db->table('users_tbl')->insert([
                'u_email' => $emailAddress,
                'u_empno' => $employeeNumber,
                'u_password' => password_hash($password, PASSWORD_DEFAULT),
                'u_regdate' => $registrationDate,
                'u_createdate' => $registrationDate,
                'u_status' => 'Pending',
            ]);
        } catch (\Throwable $exception) {
            log_message('error', 'Registration insert failed: ' . $exception->getMessage());
            $inserted = false;
        }

        if (!$inserted) {
            $session->setFlashdata('error', 'Your registration could not be saved. Please try again.');
            return redirect()->back()->withInput();
        }

        $notificationSent = $this->sendRegistrationNotice(
            $emailAddress,
            $employeeNumber,
            $registrationDate
        );

        $session->setFlashdata('registration_details', [
            'email' => $emailAddress,
            'employee_number' => $employeeNumber,
            'registration_date' => $registrationDate,
            'reference_number' => 'REG-' . date('Ymd') . '-' . str_pad((string) $db->insertID(), 6, '0', STR_PAD_LEFT),
        ]);
        $session->setFlashdata('registration_notification_sent', $notificationSent);

        return redirect()->to(base_url('reg-status-submitted'));
    }

    private function sendRegistrationNotice(string $emailAddress, string $employeeNumber, string $registrationDate): bool
    {
        $emailConfig = config('Email');
        if ($emailConfig->SMTPUser === '' || $emailConfig->SMTPPass === '' || $emailConfig->fromEmail === '') {
            log_message('error', 'Registration notice not sent: Microsoft 365 SMTP credentials are not configured.');
            return false;
        }

        $mailer = service('email');
        try {
            $mailer->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
            $mailer->setTo('markdichoso@osg.gov.ph');
            $mailer->setSubject('Pending OSG Parking System Registration Approval');
            $mailer->setMessage(
                "A new registration is pending System Administrator approval.\n\n"
                    . "E-mail: {$emailAddress}\n"
                    . "Employee Number: {$employeeNumber}\n"
                    . 'Registration Date: ' . date('F j, Y g:i A', strtotime($registrationDate)) . "\n"
            );

            $sent = $mailer->send();
        } catch (\Throwable $exception) {
            log_message('error', 'Microsoft 365 registration notice failed: ' . $exception->getMessage());
            $mailer->clear(true);
            return false;
        }


        try {
            $mailer->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
            $mailer->setTo();
            $mailer->setSubject('Pending OSG Parking System Registration Approval');
            $mailer->setMessage(
                "Your OSG Parking System Account registration is pending System Administrator approval.\n\n"
                    . "E-mail: {$emailAddress}\n"
                    . "Employee Number: {$employeeNumber}\n"
                    . 'Registration Date: ' . date('F j, Y g:i A', strtotime($registrationDate)) . "\n"
            );

            $sent = $mailer->send();
        } catch (\Throwable $exception) {
            log_message('error', 'Microsoft 365 registration notice failed: ' . $exception->getMessage());
            $mailer->clear(true);
            return false;
        }



        if (!$sent) {
            log_message('error', 'Microsoft 365 failed to send a registration approval notice.');
            $mailer->clear(true);
            return false;
        }

        $mailer->clear(true);
        return true;
    }

    public function authenticate()
    {
        $session = session();
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $remember = $this->request->getPost('remember_me') === '1';

        if ($username === '' || $password === '') {
            $session->setFlashdata('error', 'Enter your username and password.');
            $session->setFlashdata('remember_me', $remember);
            return redirect()->to(base_url());
        }

        if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
            $host = LOC_HOST;
            $database = LOC_DB;
            $databaseUser = LOC_USER;
            $databasePassword = LOC_PASS;
        } elseif (str_contains($_SERVER['SERVER_NAME'], '192.168')) {
            $host = NET_HOST;
            $database = NET_DB;
            $databaseUser = NET_USER;
            $databasePassword = NET_PASS;
        } else {
            $host = SRV_HOST;
            $database = SRV_DB;
            $databaseUser = SRV_USER;
            $databasePassword = SRV_PASS;
        }

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $databaseUser, $databasePassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            log_message('error', 'Login database connection failed: ' . $exception->getMessage());
            $session->setFlashdata('error', 'Unable to connect to the account service. Please try again.');
            $session->setFlashdata('remember_me', $remember);
            return redirect()->to(base_url());
        }

        $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE u_email = :username LIMIT 1');
        $statement->execute(['username' => $username]);
        $userRow = $statement->fetch(PDO::FETCH_ASSOC);

        $storedPassword = (string) ($userRow['u_password'] ?? '');
        $passwordInfo = password_get_info($storedPassword);
        $passwordIsValid = $userRow && (
            !empty($passwordInfo['algo'])
            ? password_verify($password, $storedPassword)
            : hash_equals(hash('sha256', $storedPassword), hash('sha256', $password))
        );

        if (!$passwordIsValid) {
            $session->setFlashdata('error', 'Invalid username or password. Please try again.');
            $session->setFlashdata('remember_me', $remember);
            return redirect()->to(base_url());
        }

        if (strtolower((string) ($userRow['u_status'] ?? '')) !== 'active') {
            $session->setFlashdata('error', 'Your account is pending approval.');
            return redirect()->to(base_url());
        }

        $profileStatement = $pdo->prepare('SELECT * FROM userprofile_tbl WHERE up_empno = :empno LIMIT 1');
        $profileStatement->execute(['empno' => $userRow['u_empno']]);
        $profile = $profileStatement->fetch(PDO::FETCH_ASSOC) ?: [];

        $session->regenerate(true);
        $session->set([
            'user_id' => $userRow['u_empno'],
            'user_fullname' => $profile['up_fullname'] ?? '',
            'user_email' => $profile['up_email'] ?? $userRow['u_email'],
            'user_contact' => $profile['up_mobileno'] ?? '',
            'user_division' => $profile['up_division'] ?? '',
            'user_role' => $profile['up_role'] ?? null,
            'user_image' => $profile['up_image'] ?? '',
        ]);

        $role = (int) $session->get('user_role');
        $redirect = $role === 0
            ? redirect()->to(base_url('admin-dashboard'))
            : ($role === 1
                ? redirect()->to(base_url('attendant'))
                : redirect()->to(base_url('main')));

        $rememberMe = new RememberMe();
        if ($remember) {
            $rememberMe->issue((string) $userRow['u_empno'], $this->request, $redirect);
        } else {
            $rememberMe->revokeCookie($this->request);
            $rememberMe->clearCookie($redirect);
        }

        return $redirect;
    }

    public function signout()
    {
        $rememberMe = new RememberMe();
        $rememberMe->revokeCookie($this->request);
        session()->destroy();

        $redirect = redirect()->to(base_url());
        $rememberMe->clearCookie($redirect);
        return $redirect;
    }


    public function regApproval()
    {
        $session = session();

        if (!$session->get('user_id')) {
            return redirect()->to(base_url());
        } else {
            $clientProfile = Dashboard::getClientProfile($session->get('user_id'));
            $userRole = $clientProfile['up_role'] ?? null;
            $employeeNumber = $session->get('user_id');
            if ($userRole !== '1' || $userRole !== '2') {
                $session->setFlashdata('error', 'You do not have permission to access this page.');
                return redirect()->to(base_url('main'));
            } else {
                return view('main/reg-approval');
            }
        }
    }

    public function passwordReset()
    {
        return view('main/pass-reset');
    }

    public function passwordResetSubmit()
    {
        $jsonPayload = $this->request->getJSON(true) ?? [];
        $emailAddress = strtolower(trim((string) ($jsonPayload['email'] ?? $this->request->getPost('email'))));
        $plainPassword = (string) ($jsonPayload['password'] ?? $this->request->getPost('password'));

        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please provide a valid email address.',
            ]);
        }

        if (
            empty($plainPassword)
            || strlen($plainPassword) < 8
            || !preg_match('/[A-Z]/', $plainPassword)
            || !preg_match('/[a-z]/', $plainPassword)
            || !preg_match('/\d/', $plainPassword)
            || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $plainPassword)
        ) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Password must be at least 8 characters and include uppercase, lowercase, number, and special characters.',
            ]);
        }

        $db = \Config\Database::connect();
        $userRecord = $db->table('users_tbl')
            ->where('u_email', $emailAddress)
            ->get()
            ->getRowArray();

        if (!$userRecord) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No account was found for that email address.',
            ]);
        }

        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
        $updated = $db->table('users_tbl')
            ->where('u_email', $emailAddress)
            ->update(['u_password' => $hashedPassword]);

        if (!$updated) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Password could not be updated. Please try again.',
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Password updated successfully.',
        ]);
    }
}
