<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $furnitureType = $_POST['furniture'] ?? '';
    $description = $_POST['description'] ?? '';
    $address = $_POST['address'] ?? '';

    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        // If no new image uploaded, retain the old image path
        $sql = "SELECT image FROM furniture_orders WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($existingImagePath);
        $stmt->fetch();
        $stmt->close();
        $imagePath = $existingImagePath;
    }

    $sql = "UPDATE furniture_orders SET name = ?, email = ?, furniture = ?, description = ?, address = ?, image = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $name, $email, $furnitureType, $description, $address, $imagePath, $id);

        if ($stmt->execute()) {
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
