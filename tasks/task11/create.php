<?php
include 'DBconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // category_id
    $product_category = htmlspecialchars(trim($_POST['product_category']));
    if (empty($product_category)) {
        $errors[] = 'category_id is required';
    } elseif (!is_numeric($product_category)) {
        $errors[] = 'category_id must be number';
    }

    // product_name
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    if (empty($product_name)) {
        $errors[] = 'product_name is required';
    }

    // product_image
    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $allowedExt = ['jpg', 'jpeg', 'gif', 'png'];
        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $imageName = rand(1, 100) . "_" . $image['name'];
        if (!in_array($ext, $allowedExt)) {
            $errors[] = "not allowed ext";
        }
    }

    // product_price
    $productPrice = htmlspecialchars(trim($_POST['product_price']));
    if (empty($productPrice)) {
        $errors[] = "product price is required";
    } elseif (!is_numeric($productPrice)) {
        $errors[] = "product price must be number";
    }

    // product_description
    $product_description = htmlspecialchars(trim($_POST['product_description']));
    if (empty($product_description)) {
        $errors[] = "product description is required";
    }

    // Insert if no errors
    if (empty($errors)) {
        $sql = "INSERT INTO products (`product_category`,`product_name`,`product_image`,`product_price`,`product_description`) 
                VALUES (:product_category,:product_name,:product_image,:product_price,:product_description)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ":product_category" => $product_category,
            ":product_name" => $product_name,
            ":product_image" => $imageName,
            ":product_price" => $productPrice,
            ":product_description" => $product_description
        ]);

        if ($result && $imageName) {
            move_uploaded_file($image['tmp_name'], "assets/images/$imageName");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="Bootstrab/css/bootstrap.min.css">
</head>

<body class="p-4">

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">product_category</label>
            <input type="number" name="product_category" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">product_name</label>
            <input type="text" name="product_name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">product_image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">product_Price</label>
            <input type="text" name="product_price" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">product_description</label>
            <input type="text" name="product_description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="Bootstrab/js/bootstrap.bundle.js"></script>
</body>

</html>