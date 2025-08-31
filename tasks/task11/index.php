<?php
include 'DBconnection.php';
include 'nav.php';

$query = $conn->prepare("SELECT * FROM products");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket</title>
    <link rel="stylesheet" href="Bootstrab/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-center mb-5 text-primary">📦 Product List</h1>

    <div class="row g-4">
        <?php foreach ($results as $v): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <img src="assets/images/<?= htmlspecialchars($v['product_image']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($v['product_name']) ?>" 
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body text-center">
                        <h5 class="card-title text-truncate"><?= htmlspecialchars($v['product_name']) ?></h5>
                        <p class="card-text text-success fw-bold">$<?= number_format($v['product_price'], 2) ?></p>
                        
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a class="btn btn-sm btn-primary" href="edit.php?id=<?= $v['product_id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $v['product_id'] ?>">Delete</a>
                            <a class="btn btn-sm btn-success" href="show.php?id=<?= $v['product_id'] ?>">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="Bootstrab/js/bootstrap.bundle.js"></script>
</body>
</html>
