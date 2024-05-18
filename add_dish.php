<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'restaurant') {
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

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restaurantId = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO dishes (restaurant_id, name, description, price) VALUES ('$restaurantId', '$name', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        $success = "Dish added successfully.";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<?php $title = "Add Dish"; include('header.php'); ?>

<h1>Add Dish</h1>
<?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>
<?php if ($success): ?>
    <div class="success"><?php echo $success; ?></div>
<?php endif; ?>
<form action="add_dish.php" method="post">
    <input type="text" name="name" placeholder="Dish Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <button type="submit">Add Dish</button>
</form>

<?php include('footer.php'); ?>
