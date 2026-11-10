<?php

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../config/database.php';

$sql = "SELECT * FROM books WHERE stock > 0";
$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['buku'];
    $peminjam = $_POST['peminjam'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    // var_dump($id);

    $sql_post = "INSERT INTO borrowings(status, book_id, borrower_name, borrow_date) VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_post);
    $stmt->execute(['Dipinjam', $id, $peminjam, $tgl_pinjam]);

    $sql_books = "UPDATE books SET stock = stock - 1 WHERE id = ? AND stock > 0";
    $stmt_books = $conn->prepare($sql_books);
    $stmt_books->execute([$id]);

    $_SESSION['pinjaman-dicatat'] = 'Data peminjaman berhasil dicatat!';

    header("Location: /../borrowings/index.php");
    exit();
}

?>

<div class="container">
    <h1>Catat Peminjaman</h1>

    <form action="#" method="POST">
        <div>
            <label for="buku" class="form-label">Nama Buku<span style="color: red; font-weight:bold">*</span></label>
            <select name="buku" id="buku" class="form-select">
                <option value="" selected disabled>--Pilih Buku--</option>
                <?php foreach ($result as $b): ?>
                    <option value="<?= $b['id']; ?>">
                        <div><?= $b['title']; ?></div>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="peminjam" class="form-label">Nama Peminjam<span style="color: red; font-weight:bold">*</span></label>
            <input type="text" name="peminjam" id="peminjam" class="form-control" required>
        </div>
        <div>
            <label for="tgl_pinjam">Tanggal Pinjam<span style="color: red; font-weight:bold">*</span></label>
            <input type="date" name="tgl_pinjam" id="tgl_pinajm" class="form-control" required>
        </div>
        <a href="/borrowings/index.php" class="btn btn-danger">Batal</a>
        <button class="btn btn-primary" type="submit">Catat Pinjaman</button>
    </form>
</div>

<?php

require __DIR__ . '/../includes/footer.php';

?>