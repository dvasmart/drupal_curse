<?php 

require 'db.php';

$id = $_POST['id'];
$done = $_POST['done'];

// var_dump($_GET);

$sql = "UPDATE list SET done = ? WHERE id = ?";


$query = $pdo->prepare($sql);
// $query->execute([$id]);
$query->execute([$done, $id]);

// header('Location: index.php');