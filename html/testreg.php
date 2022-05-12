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
    if ($password == '') {
        unset($password);
    } 
}

if (empty($login) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "You did not enter all the information, fill in all the fields!",
    ]);
    exit;
}
$login = trim(htmlspecialchars(stripslashes($login)));
$password = trim(htmlspecialchars(stripslashes($password)));

include("db.php");

$query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
$query->execute();
$myrow = $query->fetch(PDO::FETCH_ASSOC);

if (empty($myrow['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Sorry, the login or password you entered is incorrect or the user does not exist",
    ]);
    exit;
} elseif ($myrow['password'] == $password) {
        $_SESSION["login"] = $login;

        echo json_encode([
            "success" => true,
            "message" => "You have successfully entered the site! Now you can use our application",
        ]);
        exit;    
} else {
        echo json_encode([
            "success" => false,
            "message" => "Sorry, the login or password you entered is incorrect or the user does not exist",
        ]);
        exit;
}