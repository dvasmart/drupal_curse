<?php 

$title = $_POST['title'];
$user = $_POST["login"];

require 'db.php';

$query = $pdo->prepare("INSERT INTO `list` (`title`, `user`) VALUES ('$title', '$user')");
$query->execute();

header('Location: index.php');