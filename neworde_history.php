<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_delivery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customerId = $_SESSION['user_id'];
$sql = "SELECT orders.id, restaurants.name as restaurant_name, dishes.name as dish_name, orders.quantity, orders.total_price, orders.created_at
        FROM orders
        JOIN restaurants ON orders.restaurant_id = restaurants.id
        JOIN dishes ON orders.dish_id = dishes.id
        WHERE orders.customer_id = $customerId
        ORDER BY orders.created_at DESC";
$result = $conn->query($sql);
?>

<?php $title = "Order History"; include('header.php'); ?>

<h1>Order History</h1>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Restaurant</th>
            <th>Dish</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['restaurant_name']; ?></td>
            <td><?php echo $row['dish_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>$<?php echo $row['total_price']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include('footer.php'); ?>

<?php
$conn->close();
?>
