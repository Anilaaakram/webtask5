<?php
// restaurant_list.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_delivery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM restaurants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container restaurant-container">
        <h1>Restaurants</h1>
        <ul>
            <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <a href="order_placement.php?restaurant_id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>

<?php
$conn->close();
?>
