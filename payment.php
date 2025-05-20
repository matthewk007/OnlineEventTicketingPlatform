<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['cart']);
    $message = "Payment successful! Your tickets have been booked.";
}

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
if (!empty($cart_items)) {
    $event_ids = implode(',', array_keys($cart_items));
    $query = "SELECT event_id, event_name, ticket_price FROM events WHERE event_id IN ($event_ids)";
    $result = $conn->query($query);
    while ($item = $result->fetch_assoc()) {
        $total += $item['ticket_price'] * $cart_items[$item['event_id']];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketly - Payment</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
        <h1>Payment</h1>
        <?php if (isset($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php elseif (!empty($cart_items)): ?>
            <p>Total: $<?php echo number_format($total, 2); ?></p>
            <form action="payment.php" method="post">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="bank">Bank Transfer</option>
                    <option value="paypal">PayPal</option>
                    <option value="mobile">Mobile Network</option>
                </select>
                <div id="payment_fields">
                    <!-- Fields populated by JavaScript based on selection -->
                </div>
                <button type="submit">Pay Now</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2025 Ticketly</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>