<?php
include 'DBconnection.php';
$id = $_GET['id'];
$query = "SELECT * FROM products WHERE product_id=:id";
$stmt = $conn->prepare($query);
$stmt->execute([":id" => $id]);
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$productData) {
    die("Product not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="Bootstrab/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-3">
                <img src="assets/images/<?= htmlspecialchars($productData['product_image']) ?>" 
                     class="card-img-top img-fluid rounded-top" 
                     alt="<?= htmlspecialchars($productData['product_name']) ?>" 
                     style="max-height: 300px; object-fit: cover;">

                <div class="card-body text-center">
                    <h3 class="card-title mb-3 text-primary"><?= htmlspecialchars($productData['product_name']) ?></h3>
                    <h4 class="text-success mb-3">$<?= number_format($productData['product_price'], 2) ?></h4>
                    <p class="card-text text-muted"><?= htmlspecialchars($productData['product_description']) ?></p>
                    
                    <a href="edit.php?id=<?= $productData['product_id'] ?>" class="btn btn-warning px-4">Edit</a>
                    <a href="index.php" class="btn btn-secondary px-4">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="Bootstrab/js/bootstrap.bundle.js"></script>
</body>
</html>
