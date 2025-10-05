<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];

            if (isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(16)); 
                setcookie("rememberme", $token, time() + (86400 * 7), "/", "", false, true);

                $update = $conn->prepare("UPDATE users SET remember_token=? WHERE id=?");
                $update->bind_param("si", $token, $user['id']);
                $update->execute();
            }

            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>
