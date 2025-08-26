<?php
require_once 'login.php';
$errors=[];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    if (empty(htmlspecialchars(trim($_POST['email'])))) {
        $errors['email'] = "email is required";
    }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email']= "must enter valid email";
    }
    
     if (empty(htmlspecialchars(trim($_POST['password'])))) {
        $errors['password'] = "password is required";
    }elseif(strlen($_POST['password'])<8){
        $errors['password']= "password must be 8 character or more";
    }


}
