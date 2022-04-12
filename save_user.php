<?php

session_start();

if (isset($_POST['login'])) { 
    $login = $_POST['login']; 
    if ($login == '') { 
        unset($login);
    } 
}

if (isset($_POST['password'])) { 
    $password = $_POST['password']; 
    if ($password =='') { 
        unset($password);
    } 
}

if (isset($_POST['email'])) { 
    $email = $_POST['email']; 
    if ($email =='') { 
        $email = '';
    } 
}

if (empty($login) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "You did not enter all the information, fill in all the fields",
    ]);

    exit;

    // exit(
    //     "<p>You did not enter all the information, go back and fill in all the fields!</p>
    //     <p>Go to <a href='registration.php'>Registration</a></p>"
    // );
}

$login = trim(htmlspecialchars(stripslashes($login)));
$password = trim(htmlspecialchars(stripslashes($password)));
$email = trim(htmlspecialchars(stripslashes($email)));

require 'db.php';
    
$query = $pdo->prepare("SELECT id FROM users WHERE login='$login'");
$query->execute();
$myrow = $query->fetch(PDO::FETCH_ASSOC);

if (!empty($myrow['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Sorry, the username you entered has already been registered. Enter another login",
    ]);

    exit;

    // exit(
    //     "<p>Sorry, the username you entered has already been registered. Enter another login</p>
    //     <p>Go to <a href='registration.php'>Registration</a></p>");
}

$query = $pdo->prepare("INSERT INTO users (login, password, email) VALUES('$login','$password', '$email')");
$result2 = $query->execute();

if ($result2 == true) {

    $_SESSION["login"] = $login;

    echo json_encode([
        "success" => true,
        "message" => "You have successfully registered! Now you can use our application",
    ]);

    exit;

    // exit(
    //     "<p>You have successfully registered! Now you can use our application</p>
    //     <p>Go to <a href='index.php'>Main</a></p>"
    // );
} else {
    echo json_encode([
        "success" => false,
        "message" => "Error! You are not registred",
    ]);

    exit;


    // exit(
    //     "<p>Error! You are not registred</p>. 
    //     <p>Go to <a href='index.php'>Main</a></p>
    //     <p>Go to <a href='registration.php'>Registration</a></p>"
    // );
}