<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>

    <style>
        div {
            width: 100%;
        }
    </style>
</head>

<body>

    <form action="" method="POST">
        <div>
            <input type="text" name="fname">
            <input type="text" name="lname">
            <textarea name="address" id=""></textarea>
            <select name="select" id="">
                <option> cic</option>
                <option> auc</option>
                <option> bue</option>
            </select>
        </div>
        <div>
            <input type="radio" name="gender" id="" value="male"> Male
            <input type="radio" name="gender" id="" value="female"> female
            <input type="checkbox" name="course[]" id="" value="html"> html
            <input type="checkbox" name="course[]" id="" value="css"> php
            <input type="checkbox" name="course[]" id="" value="js"> mysql
        </div>
        <div>
            <input type="text" name="username">
            <input type="password" name="password">
        </div>
        <input type="submit" name="submit">
        <input type="text" name="readonly" value="This text cannot be edited." readonly>
    </form>




</body>

</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['submit'])) {
    echo "<h1>Username: " . htmlspecialchars($_POST['username']) . "</h1>";
    echo "<p>First Name: " . htmlspecialchars($_POST['fname']) . "</p>";
    echo "<p>Last Name: " . htmlspecialchars($_POST['lname']) . "</p>";
    echo "<p>Address: " . htmlspecialchars($_POST['address']) . "</p>";
    echo "<p>School: " . htmlspecialchars($_POST['select']) . "</p>";
    if (isset($_POST['gender'])) {
        $genderchoose = $_POST['gender'];
        echo "<p>Gender: " .($genderchoose) . "</p>";}
    
if (isset($_POST['course'])) {
    $selected_course = $_POST['course'];
    echo "Selected course: ";
    foreach ($selected_course as $course) {
        echo $course . ", ";
    }
} else {
    echo "No colors selected.";
}


    echo "<p>Password: " . htmlspecialchars($_POST['password']) . "</p>";
    echo "<p>readonly: " . htmlspecialchars($_POST['readonly']) . "</p>";
}

?>