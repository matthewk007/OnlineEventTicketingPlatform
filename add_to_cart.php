<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = (int)$_POST['event_id'];
    $quantity = (int)$_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$event_id])) {
        $_SESSION['cart'][$event_id] += $quantity;
    } else {
        $_SESSION['cart'][$event_id] = $quantity;
    }

    header("Location: events.php");
    exit();
}
?>