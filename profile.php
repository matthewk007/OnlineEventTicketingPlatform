<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'includes/db_connect.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketly - Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Your Profile</h1>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
        <p><strong>NRC:</strong> <?php echo htmlspecialchars($user['nrc']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['physical_address'] . ", " . $user['area'] . ", " . $user['street'] . ", " . $user['town'] . ", " . $user['province'] . ", " . $user['country']); ?></p>
        <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
        <p><strong>Client Type:</strong> <?php echo htmlspecialchars($user['client_type']); ?></p>
        <p><strong>Hobbies:</strong> <?php echo htmlspecialchars($user['hobbies'] ?: 'None'); ?></p>
        <p><strong>Bank Details:</strong> <?php echo htmlspecialchars($user['bank_name'] . ", Account: " . $user['bank_account_no'] . ", Branch: " . $user['bank_branch'] . ", " . $user['bank_address'] . ", Phone: " . $user['bank_phone'] . ", Email: " . $user['bank_email']); ?></p>
    </main>
    <footer>
        <p>&copy; 2025 Ticketly</p>
    </footer>
</body>
</html>