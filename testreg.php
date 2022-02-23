<?php

session_start();

if(isset($_POST['login'])) { 
    $login = $_POST['login']; 
    if ($login == '') { 
        unset($login);
    } 
}

if(isset($_POST['password'])) { 
    $password = $_POST['password']; 
    if($password == '') {
        unset($password);
    } 
}

if(empty($login) || empty($password)) {
    exit(
        "<p>You did not enter all the information, go back and fill in all the fields!</p>
        <p>Go to <a href='index.php'>Main</a></p>"
    );
}
$login = trim(htmlspecialchars(stripslashes($login)));
$password = trim(htmlspecialchars(stripslashes($password)));

include("db.php");

$query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
$query->execute();
$myrow = $query->fetch(PDO::FETCH_ASSOC);

if(empty($myrow['password'])) {
    exit (
        "<p>Sorry, the login or password you entered is incorrect or the user does not exist</p>
        <p>Go to <a href='index.php'>Main</a></p>"
    );
} else {
    if ($myrow['password'] == $password) {

        $_SESSION["login"] = $login;
        
        exit(
            "<p>You have successfully entered the site! Now you can use our application</p>
            <p>Go to <a href='index.php'>Main</a></p>"
        );
    } else {
        exit (
            "<p>Sorry, the login or password you entered is incorrect or the user does not exist</p>
            <p>Go to <a href='index.php'>Main</a></p>"
        );
    }
}