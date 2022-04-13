<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>TODO list</title>
    <!-- bootstrap cdn cs -->
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous"/>
    <link rel="shortcut icon" href="#">
    <link href="assets/css/style.css" rel="stylesheet">    
</head>
<body>

    <h2>TODO list</h2>

    <!-- If user registered -->
    <?php if(isset($_SESSION["login"])): 
        $user = $_SESSION["login"];
    ?>
        <h4>Application</h4>
        <p>Welcome <?php echo $user; ?>!</p>
        <form action="add.php" method="POST">
            <input type="text" name="title" required>
            <input type="hidden" name="login" value="<?php echo $user; ?>">
            <input type="submit" value="Add">
        </form>    
        <ul class="list_items">
            <?php
            
            require 'db.php';
                
            $query = $pdo->query("SELECT * FROM `list` WHERE user='$user' ORDER BY `done` ASC");

            while($row = $query->fetch(PDO::FETCH_OBJ)) {
                $checked = "";
                if ($row->done == 1) {
                    $checked = "checked";
                    $row->done = 0;
                } else {
                    $checked = "";
                    $row->done = 1;
                }
                echo 
                '<li class="list_item">
                    <input type="checkbox" id=' . $row->id . ' name="done" ' . $checked . '>
                    ' . $row->title . '
                    <a href="delete.php?id=' . $row->id . '" id="card-link-click">
                        <button type="button">x</button>
                    </a>
                </li>';                
            }
            ?>
        </ul>

        <p>
            <a href="logout.php" title="Logout">Logout</a>
        </p>

    <!-- If user unregistered -->
    <?php else: ?>

        <h4>Entering</h4>

        <form id="authorization">
            <p>
                <label>Your login:<br></label>
                <input name="login" id="login" type="text" size="20" maxlength="20">
            </p>
            <p>
                <label>Your password:<br></label>
                <input name="password" id="password" type="password" size="20" maxlength="20">
            </p>
            <p>
                <input type="submit" name="submit" value="Login">
            </p>
            <p>
                <a href="registration.php">Registration</a>
            </p>
        </form>

        <p>Please login or register to use application</p>

    <?php endif; ?>
   
    <!-- bootstrap cdn js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    <!-- sweetalert cdn -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js" type="text/javascript"></script>      
</body>
</html>