<?php
// login.php
header('Content-Type: application/json');


// Database configuration
$host = 'localhost';
$db   = 'osg_cpms_db';
$user = 'root'; // Update if you have a specific database user
$pass = '';     // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

// Get the JSON payload from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Credentials missing.']);
    exit;
}

// Prepare statement to prevent SQL injection.
// The project stores the password as a hash in users_tbl.u_password.
$stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE u_email = :username OR u_empno = :username LIMIT 1");
$stmt->execute(['username' => $username]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow) {
    $storedHash = (string) ($userRow['u_password'] ?? '');
    $passwordIsValid = false;

    if ($storedHash !== '') {
        $passwordInfo = password_get_info($storedHash);
        $passwordIsValid = !empty($passwordInfo['algo'])
            ? password_verify($password, $storedHash)
            : hash_equals(hash('sha256', $storedHash), hash('sha256', $password));
    }

    if ($passwordIsValid) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}
