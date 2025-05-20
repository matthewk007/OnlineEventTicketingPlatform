<?php
session_start();
include 'includes/db_connect.php';

$query = "SELECT * FROM events";
$result = $conn->query($query);

// Display cart summary
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
if (!empty($cart_items)) {
    $event_ids = implode(',', array_keys($cart_items));
    $cart_query = "SELECT event_id, event_name, ticket_price FROM events WHERE event_id IN ($event_ids)";
    $cart_result = $conn->query($cart_query);
    while ($item = $cart_result->fetch_assoc()) {
        $total += $item['ticket_price'] * $cart_items[$item['event_id']];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketly - Events</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
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
    <h1>Events</h1>
    <section>
        <?php while ($event = $result->fetch_assoc()): ?>
            <div class="event-card">
                <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
                <p>Date: <?php echo htmlspecialchars($event['event_date']); ?></p>
                <p>Venue: <?php echo htmlspecialchars($event['event_venue']); ?></p>
                <p>Price: $<?php echo number_format($event['ticket_price'], 2); ?></p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                    <label for="quantity_<?php echo $event['event_id']; ?>">Quantity:</label>
                    <input type="number" id="quantity_<?php echo $event['event_id']; ?>" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </section>
    <?php if (!empty($cart_items)): ?>
        <section class="cart">
            <h2>Your Cart</h2>
            <?php
            $cart_result->data_seek(0);
            while ($item = $cart_result->fetch_assoc()):
            ?>
                <p><?php echo htmlspecialchars($item['event_name']); ?> - Quantity: <?php echo $cart_items[$item['event_id']]; ?> - $<?php echo number_format($item['ticket_price'] * $cart_items[$item['event_id']], 2); ?></p>
            <?php endwhile; ?>
            <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
            <a href="payment.php" class="button">Proceed to Checkout</a>
        </section>
    <?php endif; ?>
</main>
    <footer>
        <p>&copy; 2025 Ticketly</p>
    </footer>
</body>
</html>