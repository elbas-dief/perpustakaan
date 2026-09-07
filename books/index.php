<?php

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// var_dump($result2);

?>

<div class="container">
    <h1>Daftar Buku</h1>
    <a href="/books/create.php" class="btn btn-primary">+ Tambah Buku</a>

    <table style="width: 100%;">
        <thead>
            <th style="width: 15%;">Cover</th>
            <th style="width: 40%;">Judul/Pengarang</th>
            <th style="width: 20%;">Kategori</th>
            <th style="width: 10%;">Stok</th>
            <th style="width: 15%;">Aksi</th>
        </thead>
        <tbody>
            <?php foreach ($result as $p):
                $img_path = $p['cover'] != NULL ? "/uploads/{$p['cover']}" : "/uploads/Book.png";
            ?>
                <tr>
                    <td><img src="<?= $img_path; ?>" alt="<?= $img_path; ?>" style="width:60px; height:100px;"></td>
                    <td>
                        <strong style="font-weight: bold"><?= $p['title']; ?></strong><br>
                        <small><?= $p['author']; ?></small>
                    </td>
                    <td><?= $p['category']; ?></td>
                    <td><?= $p['stock']; ?></td>
                    <td>
                        <div class="action-button">
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

require __DIR__ . '/../includes/footer.php';

?>