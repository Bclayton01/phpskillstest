<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataFile = 'data.json';

    // Get POST data
    $productName = $_POST['productName'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $datetime = date('Y-m-d H:i:s');

    // Calculate total value
    $totalValue = $quantity * $price;

    // Load existing data
    $data = json_decode(file_get_contents($dataFile), true);

    // Add new record
    $data[] = [
        'productName' => $productName,
        'quantity' => $quantity,
        'price' => $price,
        'datetime' => $datetime,
        'totalValue' => $totalValue,
    ];

    // Save updated data
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

    echo json_encode($data);
    exit;
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Product Inventory Form</h1>
        <form id="productForm" class="mt-4">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity in Stock</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price per Item</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <h2 class="mt-5">Product Records</h2>
        <div id="recordsTable" class="table-responsive">
            <!-- Table dynamically updated by script.js -->
        </div>
    </div>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
