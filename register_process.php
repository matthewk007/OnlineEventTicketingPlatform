<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and collect form data
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $nrc = filter_input(INPUT_POST, 'nrc', FILTER_SANITIZE_STRING);
    $dob = $_POST['dob'];
    $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $physical_address = filter_input(INPUT_POST, 'physical_address', FILTER_SANITIZE_STRING);
    $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $town = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
    $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $sex = $_POST['sex'];
    $client_type = $_POST['client_type'];
    $hobbies = filter_input(INPUT_POST, 'hobbies', FILTER_SANITIZE_STRING);
    $bank_name = filter_input(INPUT_POST, 'bank_name', FILTER_SANITIZE_STRING);
    $bank_account_no = filter_input(INPUT_POST, 'bank_account_no', FILTER_SANITIZE_STRING);
    $bank_branch = filter_input(INPUT_POST, 'bank_branch', FILTER_SANITIZE_STRING);
    $bank_address = filter_input(INPUT_POST, 'bank_address', FILTER_SANITIZE_STRING);
    $bank_phone = filter_input(INPUT_POST, 'bank_phone', FILTER_SANITIZE_STRING);
    $bank_email = filter_input(INPUT_POST, 'bank_email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check_query = "SELECT email FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        header("Location: register.php?error=" . urlencode("This email is already registered. Please use a different email or log in."));
        exit();
    }

    // Insert into database if email is unique
    $query = "INSERT INTO users (first_name, last_name, nrc, dob, phone_number, email, physical_address, area, street, town, province, country, sex, client_type, hobbies, bank_name, bank_account_no, bank_branch, bank_address, bank_phone, bank_email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssssssssssssss", $first_name, $last_name, $nrc, $dob, $phone_number, $email, $physical_address, $area, $street, $town, $province, $country, $sex, $client_type, $hobbies, $bank_name, $bank_account_no, $bank_branch, $bank_address, $bank_phone, $bank_email, $password);

    if ($stmt->execute()) {
        // Auto-login after registration
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        header("Location: index.php?message=" . urlencode("Registration successful!"));
        exit();
    } else {
        // Generic error for other issues (e.g., database connection)
        header("Location: register.php?error=" . urlencode("Registration failed. Please try again."));
        exit();
    }
}

$conn->close();
?>