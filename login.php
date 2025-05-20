<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $query = "SELECT user_id, first_name, last_name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $message = "Login successful! A confirmation message has been sent to your phone (simulated).";
            header("Location: index.php?message=" . urlencode($message));
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No user found with that email.";
    }
    header("Location: index.php?message=" . urlencode($message));
    exit();
}
?>