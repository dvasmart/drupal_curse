<?php

session_start();

// $errors = [];
// $json_responce = [];



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


// if (!isset($_POST['login']) || !isset($_POST['password'])) {
if (empty($login) || empty($password)) {
    // array_push($errors, "You did not enter all the information, go back and fill in all the fields!");

    // return json_encode($errors);
    // var_dump($errors);
    // echo json_encode(
    //     $errors
    // );

    echo json_encode([
        "success" => false,
        "message" => "You did not enter all the information, fill in all the fields!",
    ]);

    // echo "You did not enter all the information, fill in all the fields!";
    exit;

    // exit(
    //     "<p>You did not enter all the information, go back and fill in all the fields!</p>
    //     <p>Go to <a href='index.php'>Main</a></p>"
    // );
}
$login = trim(htmlspecialchars(stripslashes($login)));
$password = trim(htmlspecialchars(stripslashes($password)));

include("db.php");

$query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
$query->execute();
$myrow = $query->fetch(PDO::FETCH_ASSOC);

// var_dump(empty($myrow['password']));

if (empty($myrow['password'])) {
    // array_push($errors, "Sorry, the login or password you entered is incorrect or the user does not exist");

    // echo "Sorry, the login or password you entered is incorrect or the user does not exist";

    echo json_encode([
        "success" => false,
        "message" => "Sorry, the login or password you entered is incorrect or the user does not exist",
    ]);

    exit;

    // exit (
    //     "<p>Sorry, the login or password you entered is incorrect or the user does not exist</p>
    //     <p>Go to <a href='index.php'>Main</a></p>"
    // );
} elseif ($myrow['password'] == $password) {
     
        $_SESSION["login"] = $login;
        
        // array_push($errors, "You have successfully entered the site! Now you can use our application");
        // echo "You have successfully entered the site! Now you can use our application";

        echo json_encode([
            "success" => true,
            "message" => "You have successfully entered the site! Now you can use our application",
        ]);

        exit;

        // exit(
        //     "<p>You have successfully entered the site! Now you can use our application</p>
        //     <p>Go to <a href='index.php'>Main</a></p>"
        // );
    
} else {
        // array_push($errors, "Sorry, the login or password you entered is incorrect or the user does not exist");

        // echo "Sorry, the login or password you entered is incorrect or the user does not exist";

        echo json_encode([
            "success" => false,
            "message" => "Sorry, the login or password you entered is incorrect or the user does not exist",
        ]);

        exit;

        // exit (
        //     "<p>Sorry, the login or password you entered is incorrect or the user does not exist</p>
        //     <p>Go to <a href='index.php'>Main</a></p>"
        // );
}

// return json_encode($errors);