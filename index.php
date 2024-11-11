<?php
session_start();
include 'db.php';

$isLoggedIn = isset($_SESSION['username']) || isset($_COOKIE['username']);
$username = $_SESSION['username'] ?? $_COOKIE['username'] ?? null;

$orders = [];
$sql = "SELECT * FROM furniture_orders";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    } else {
        echo "<p style='color: white;'>No orders found.</p>";
    }
} else {
    echo "<p style='color: white;'>Error fetching orders: " . $conn->error . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavy Furniture Inc.</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="create.php">Order</a></li>
                <li><a href="#history">History</a></li>
                <?php if ($isLoggedIn): ?>
                    <li class="dropdown">
                        <a href="#" class="username"><?php echo htmlspecialchars($username); ?></a>
                        <div class="dropdown-content">
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="login.html">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Background image section -->
        <div class="background-image">
            <h1>Heavy Furniture Inc.</h1>
        </div>

        <!-- About section -->
        <section id="about" class="about-section">
            <div class="about-title">
                <h2>Heavy Furniture Inc.</h2>
                <h2>has a furniture for everyone</h2>
            </div>
            <div class="about-content">
                <img src="asset/Desk.jpg" alt="Desk Image" class="about-image">
                <div class="about-text">
                    <p>We believe that everyone deserve a furniture meant solely for them. Order yours with our team of trusted builder and designer.</p>
                    <button class="order-button" onclick="window.location.href='create.php'">ORDER HERE</button>
                </div>
            </div>
        </section>
        
        <!-- History section -->
        <section id="history" class="history-section">
            <h2>Your Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Furniture Type</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['name']); ?></td>
                                <td><?php echo htmlspecialchars($order['email']); ?></td>
                                <td><?php echo htmlspecialchars($order['furniture']); ?></td>
                                <td><?php echo htmlspecialchars($order['description']); ?></td>
                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                <td>
                                    <?php if ($order['image']): ?>
                                        <img src="<?php echo htmlspecialchars($order['image']); ?>" alt="Furniture Image" width="50">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?php echo $order['id']; ?>" class="edit-button">Edit</a>
                                    <a href="furniture_delete.php?id=<?php echo $order['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No orders available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
