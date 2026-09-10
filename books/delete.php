<?php 

require __DIR__ . '/../config/database.php';

// $id = $_GET['id'];
$id = $_POST['id'];

// var_dump($id);

$sql = "DELETE FROM books WHERE id=$id";
$conn->query($sql);

header("Location: /../books/index.php");
exit();

?>