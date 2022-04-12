<?php 

require 'db.php';

$id = $_POST['id'];
$done = $_POST['done'];

$sql = "UPDATE list SET done = ? WHERE id = ?";

$query = $pdo->prepare($sql);
$query->execute([$done, $id]);