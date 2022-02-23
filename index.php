<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO list</title>

    <!-- <link href="style/style.css" rel="stylesheet"> -->
    <!-- <script src="js/script.js" type="text/javascript"></script> -->
</head>
<body>

<h2>TODO list</h2>

<?php 

if(isset($_SESSION["login"])):
    $user = $_SESSION["login"];
?>
    <h4>Application</h4>

    <p>
        Welcome <?php echo $_SESSION["login"]; ?>!
    </p>
    
    <form action="add.php" method="POST">
		<input type="text" name="title" required>
        <input type="hidden" name="login" value="<?php echo $user; ?>">
		<input type="submit" value="Add">
	</form>
	
	<ul>
        <?php

        require 'db.php';
            
        $query = $pdo->query("SELECT * FROM `list` WHERE user='$user' ORDER BY `id` DESC");
            
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo '<div><li>'. $row->title .' <a href="delete.php?id='.$row->id.'" id="card-link-click">X</a></li>' . ' </div>';
        }

        ?>
	</ul>

    <p>
        Click <a href="logout.php" title="Logout">here</a> if you want to logout
    </p>


<?php else: ?>

    <h4>Entering</h4>

    <form action="testreg.php" method="post">
        <p>
            <label>Your login:<br></label>
            <input name="login" type="text" size="20" maxlength="20">
        </p>
        <p>
            <label>Your password:<br></label>
            <input name="password" type="password" size="20" maxlength="20">
        </p>
        <p>
            <input type="submit" name="submit" value="Login">
        </p>
        <p>
            <a href="registration.php">Registration</a> 
        </p>
    </form>

    <p>
        <?php echo "Please login or register to use application"; ?>
    </p>

<?php endif; ?>
      
</body>
</html>
