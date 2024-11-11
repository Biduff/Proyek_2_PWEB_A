<?php
session_start();
include 'db.php';

// Fetch the order data based on the ID
$id = $_GET['id'] ?? null;
$order = null;

if ($id) {
    $sql = "SELECT * FROM furniture_orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
}

if (!$order) {
    echo "Order not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="create.css">
    <script src="crud.js" defer></script> 
</head>
<body>
    <div class="image-section">
        <img src="asset/Chair.jpeg" alt="Furniture Image">
    </div>
    <div class="form-section">
        <h1>Edit your order</h1>
        <form action="furniture_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($order['id']); ?>">

            <label for="name">Name</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($order['name']); ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($order['email']); ?>">

            <label for="furniture">Select the type of furniture</label>
            <select id="furniture" name="furniture" required>
                <option value="Chair" <?php if ($order['furniture'] == 'Chair') echo 'selected'; ?>>Chair</option>
                <option value="Table" <?php if ($order['furniture'] == 'Table') echo 'selected'; ?>>Table</option>
                <option value="Wardrobe" <?php if ($order['furniture'] == 'Wardrobe') echo 'selected'; ?>>Wardrobe</option>
                <option value="Cabinet" <?php if ($order['furniture'] == 'Cabinet') echo 'selected'; ?>>Cabinet</option>
                <option value="Other" <?php if ($order['furniture'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>

            <div id="custom-furniture-container" style="display: <?php echo ($order['furniture'] == 'Other') ? 'block' : 'none'; ?>;">
                <label for="custom-furniture">Specify your furniture type</label>
                <input type="text" id="custom-furniture" name="custom_furniture" 
                    placeholder="Enter custom furniture type"
                    value="<?php echo ($order['furniture'] == 'Other') ? htmlspecialchars($order['custom_furniture']) : ''; ?>">
            </div>

            <label for="description">Description</labe>
            <textarea id="description" name="description"><?php echo htmlspecialchars($order['description']); ?></textarea>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required value="<?php echo htmlspecialchars($order['address']); ?>">

            <label for="image">Upload a new image (optional)</label>
            <input type="file" id="image" name="image">

            <button type="submit">Update Order</button>
        </form>
</div>

</body>
</html>
