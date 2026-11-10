<?php

require __DIR__ . '/../config/database.php';

session_start();

// $id = $_GET['id'];
$id = $_POST['id'];

$sql_check = "SELECT COUNT(*) AS 'Jumlah' FROM borrowings WHERE book_id = $id AND status = 'Dipinjam'";
$result = $conn->query($sql_check)->fetch_assoc();

$jumlah = $result['Jumlah'];

// var_dump($result);

if ($jumlah == 0) {
    $sql = "DELETE FROM books WHERE id=$id";
    $conn->query($sql);
    $_SESSION['buku-dihapus'] = "Buku berhasil dihapus";
} else {
    $_SESSION['buku-gagal-dihapus'] = "Buku gagal dihapus";
}

header("Location: /../books/index.php");
exit();
