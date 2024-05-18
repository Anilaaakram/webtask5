<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Food Delivery</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin.php">Admin</a>
                <?php elseif ($_SESSION['role'] == 'restaurant'): ?>
                    <a href="add_dish.php">Add Dish</a>
                    <a href="view_orders.php">View Orders</a>
                <?php elseif ($_SESSION['role'] == 'customer'): ?>
                    <a href="restaurant_list.php">Restaurants</a>
                    <a href="order_history.php">Order History</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.html">Login</a>
                <a href="signup.html">Signup</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">
