<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>

    <h2>TODO list</h2>

    <h4>Registration</h4>
    
    <form action="save_user.php" method="post">
        <p>
            <label>Your login:<br></label>
            <input name="login" type="text" size="20" maxlength="20">
        </p>
        <p>
            <label>Your password:<br></label>
            <input name="password" type="password" size="20" maxlength="20">
        </p>
        <p>
            <label>Your email:<br></label>
            <input name="email" type="email" size="20" maxlength="20">
        </p>
        <p>
            <input type="submit" name="submit" value="Register">
        </p>
    </form>

    <p>Go to <a href='index.php'>Main</a></p>

</body>
</html>