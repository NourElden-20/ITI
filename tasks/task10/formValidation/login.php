<!DOCTYPE html>
<html lang="en">
<?Php
include 'handellogin.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Bootstrab/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center align-item-center">
    <form action="handellogin.php" method="post" class="card m-5 p-5 text-align-cenetr" novalidate>
    

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            <span style="color:red;"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <span style="color: red;"><?= $errors['password'] ?? ''?></span>
    </div>
        <button type="submit" name="submit" class="btn btn-primary m-3">Submit</button>

    </form>

    <script src="Bootstrab/js/bootstrap.bundle.js"></script>
</body>

</html>