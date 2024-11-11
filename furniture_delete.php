<?php
session_start();
include 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Delete the record from the database
    $sql = "DELETE FROM furniture_orders WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect to index.php after deletion
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid order ID.";
}
?>
