<?php
// order_placement.php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_SESSION['user_id'];
    $restaurantId = $_POST['restaurant_id'];
    $dishId = $_POST['dish_id'];
    $quantity = $_POST['quantity'];
    $totalPrice = $_POST['total_price'] * $quantity;

    $sql = "INSERT INTO orders (customer_id, restaurant_id, dish_id, quantity, total_price) VALUES ('$customerId', '$restaurantId', '$dishId', '$quantity', '$totalPrice')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$restaurantId = $_GET['restaurant_id'];
$sql = "SELECT * FROM dishes WHERE restaurant_id = $restaurantId";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Placement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container order-container">
        <h1>Available Dishes</h1>
        <form action="order_placement.php" method="post">
            <ul>
                <?php while($row = $result->fetch_assoc()): ?>
                <li>
                    <?php echo $row['name']; ?> - $<?php echo $row['price']; ?>
                    <input type="hidden" name="restaurant_id" value="<?php echo $restaurantId; ?>">
                    <input type="hidden" name="dish_id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="quantity" min="1" required>
                    <input type="hidden" name="total_price" value="<?php echo $row['price']; ?>">
                    <button type="submit">Order</button>
                </li>
                <?php endwhile; ?>
            </ul>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
