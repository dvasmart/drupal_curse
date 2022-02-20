<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO list</title>

    <link href="style/style.css" rel="stylesheet">
    <script src="js/script.js" type="text/javascript"></script>
</head>
<body>

    <form action="add.php" method="POST">
		<input type="text" name="title" required>
		<input type="submit" value="Add">
	</form>
	
	<ul>
		<?php
        
        require 'db.php';
		
        $query = $pdo->query('SELECT * FROM `list` ORDER BY `id` DESC');
                
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
		        echo '<div><li>'. $row->title .' <a href="delete.php?id='.$row->id.'" id="card-link-click">X</a></li>' . ' </div>';

			}
		 ?>
	</ul>

</body>
</html>
