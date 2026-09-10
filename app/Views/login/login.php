<?php
// login.php
header('Content-Type: application/json');


                                setTimeout(() => {
                                    alert("Password is  and username is ";
                                }, 0);

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

// Prepare statement to prevent SQL injection
// Note: Adjust column names ('username', 'email', 'password') if yours differ
$stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE username = :username OR email = :email LIMIT 1");
$stmt->execute(['username' => $username, 'email' => $username]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow) {
    // IMPORTANT: Use password_verify() if passwords in the DB are hashed (recommended).
    // If your passwords are saved as plain text (not recommended), use: if ($password === $userRow['password'])

    if (password_verify($password, $userRow['password'])) {
        // Start session here if needed (e.g., session_start(); $_SESSION['user_id'] = $userRow['id'];)
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}
