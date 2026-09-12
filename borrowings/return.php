<?php 

require __DIR__ . '/../config/database.php';

session_start();

$id = $_GET['id'] ?? NULL;
$return_date = DATE('Y-m-d');

$sql = "UPDATE borrowings SET status = ?, return_date = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute(['Dikembalikan', $return_date, $id]);

$book_id = "SELECT book_id FROM borrowings WHERE id = $id";
$result = $conn->query($book_id)->fetch_assoc();

$id_book = $result['book_id'];

$sql_books = "UPDATE books SET stock = stock + 1 WHERE id = $id_book";
$conn->query($sql_books);

$_SESSION ['buku-dikembalikan'] = 'Buku telah dikembalikan!';

header("Location: /../borrowings/index.php");
exit();

// var_dump($id_book);

?>