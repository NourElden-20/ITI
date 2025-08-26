<?php
require_once 'register.php';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    //NAME NALIDATION
    if (empty(htmlspecialchars(trim($_POST['name'])))) {
        $errors['name'] = "name is required";
    } elseif (! is_string($_POST['name'])) {
        $errors['name'] = "name must be sring";
    }
    //EMAIL VALIDATION
    if (empty(htmlspecialchars(trim($_POST['email'])))) {
        $errors['email'] = "email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "must enter valid email";
    }
    //PHONE
    if (empty(htmlspecialchars(trim($_POST['phone'])))) {
        $errors['phone'] = "Phone is required";
    } elseif (!is_numeric($_POST['phone'])) {
        $errors['phone'] = "must enter valid phone must be number";
    }
    //select
    if (empty($_POST['select'])) {
        $errors['select'] = "select is required";
    }
    //password
    if (empty(htmlspecialchars(trim($_POST['password'])))) {
        $errors['password'] = "password is required";
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = "password must be 8 character or more";
    } elseif ($_POST['password'] != $_POST['confirmPassword']) {
        $errors['confirmPassword'] = "password not matched";
    };

    //image
    $file = $_FILES['file'];
    if (!empty($file['name'])) {
        $allowext = ['jpg', 'jpeg', 'png'];
        $imageName = rand(1, 10000) . $file['name'];
        $imageEXT = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (in_array($imageEXT, $allowext)) {
            move_uploaded_file($file['tmp_name'], "uploads/image/$imageName");

        } else {
            $errors['file'] = 'file error';
        }
    }
}
