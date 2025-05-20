<?php
session_start();
include 'includes/db_connect.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT first_name, last_name FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $welcome_message = "Welcome, " . htmlspecialchars($user['first_name'] . " " . $user['last_name']);
} else {
    $welcome_message = "Please log in or register.";
}

// Fetch featured events
$query = "SELECT * FROM events LIMIT 3";
$events_result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketly - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <nav>
        <button class="nav-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="events.php">Events</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
    <main>
    <h1><?php echo $welcome_message; ?></h1>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <section>
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div>
                    <button type="button" onclick="togglePassword()">Show Password</button>
                    <button type="submit">Login</button>
                </div>
                <p><a href="#">Forgot Password?</a> (Reset link simulation displayed on screen)</p>
                <?php if (isset($_GET['message'])): ?>
                    <p><?php echo htmlspecialchars($_GET['message']); ?></p>
                <?php endif; ?>
            </form>
        </section>
    <?php endif; ?>
    <section>
        <h2>Featured Events</h2>
        <?php while ($event = $events_result->fetch_assoc()): ?>
            <div class="event-card">
                <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                <p>Date: <?php echo htmlspecialchars($event['event_date']); ?></p>
                <p>Venue: <?php echo htmlspecialchars($event['event_venue']); ?></p>
                <p>Price: $<?php echo number_format($event['ticket_price'], 2); ?></p>
            </div>
        <?php endwhile; ?>
    </section>
</main>
    <footer>
        <p>&copy; 2025 Ticketly</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>