<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Your Order</title>
    <link rel="stylesheet" href="create.css">
    <script src="crud.js" defer></script> 
</head>
<body>
    <div class="image-section">
        <img src="asset/Chair.jpeg" alt="Furniture Image">
    </div>
    <div class="form-section">
        <h1>Place your order</h1>
        <form action="furniture_create.php" method="POST" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
            
            <label for="furniture">Select the type of furniture</label>
            <select id="furniture" name="furniture" required>
                <option value="">Select furniture type</option>
                <option value="Chair">Chair</option>
                <option value="Table">Table</option>
                <option value="Wardrobe">Wardrobe</option>
                <option value="Cabinet">Cabinet</option>
                <option value="Other">Other</option>
            </select>
            
            <div id="custom-furniture-container" style="display: none;">
                <label for="custom-furniture">Specify your furniture type</label>
                <input type="text" id="custom-furniture" name="custom_furniture" placeholder="Enter custom furniture type">
            </div>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="What do you want the furniture to be like"></textarea>
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required placeholder="Enter your address">
            
            <label for="image">Upload an image</label>
            <input type="file" id="image" name="image">
            
            <button type="submit">Submit Order</button>
        </form>
    </div>
</body>
</html>
