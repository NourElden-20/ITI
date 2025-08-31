<?php
include 'DBconnection.php';

$errors = [];
$product = null;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":id" => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found!");
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $product_category = htmlspecialchars(trim($_POST['product_category']));
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $product_price = htmlspecialchars(trim($_POST['product_price']));
    $product_description = htmlspecialchars(trim($_POST['product_description']));


    if (empty($product_category)) $errors[] = "Category is required";
    if (empty($product_name)) $errors[] = "Name is required";
    if (empty($product_price) || !is_numeric($product_price)) $errors[] = "Valid price is required";
    if (empty($product_description)) $errors[] = "Description is required";

    
    $imageName = $product['product_image'];
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowedExt)) {
            $errors[] = "Invalid image type";
        } else {
            $imageName = rand(1, 100) . "_" . $image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE products 
                SET product_category=:category, product_name=:name, product_price=:price, 
                    product_description=:description, product_image=:image
                WHERE product_id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":category" => $product_category,
            ":name" => $product_name,
            ":price" => $product_price,
            ":description" => $product_description,
            ":image" => $imageName,
            ":id" => $id
        ]);

        echo "<div class='alert alert-success'>Product updated successfully!</div>";

        $product = [
            "product_category" => $product_category,
            "product_name" => $product_name,
            "product_price" => $product_price,
            "product_description" => $product_description,
            "product_image" => $imageName
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
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

<?php if ($product): ?>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Product Category</label>
    <input type="number" value="<?= htmlspecialchars($product['product_category']) ?>" name="product_category" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Name</label>
    <input type="text" value="<?= htmlspecialchars($product['product_name']) ?>" name="product_name" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Image</label><br>
    <?php if (!empty($product['product_image'])): ?>
      <img src="assets/images/<?= htmlspecialchars($product['product_image']) ?>" width="100"><br><br>
    <?php endif; ?>
    <input type="file" name="image" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Price</label>
    <input type="text" value="<?= htmlspecialchars($product['product_price']) ?>" name="product_price" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Description</label>
    <input type="text" value="<?= htmlspecialchars($product['product_description']) ?>" name="product_description" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php endif; ?>

<script src="Bootstrab/js/bootstrap.bundle.js"></script>
</body>
</html>
