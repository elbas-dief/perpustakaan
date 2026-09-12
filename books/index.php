<?php

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// var_dump($result2);
?>

<div class="container">

    <?php

    if (isset($_SESSION['buku-dihapus'])) { ?>
        <div class="alert alert-success">
            <?= $_SESSION['buku-dihapus']; ?>
        </div>
        <?php unset($_SESSION['buku-dihapus']) ?>
    <?php } elseif (isset($_SESSION['buku-gagal-dihapus'])) { ?>
        <div class="alert alert-danger">
            <?= $_SESSION['buku-gagal-dihapus']; ?>
        </div>
    <?php unset($_SESSION['buku-gagal-dihapus']);
    }

    if (isset($_SESSION['buku-ditambah'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['buku-ditambah']; ?></div>
    <?php unset($_SESSION['buku-ditambah']);
    }


    if (isset($_SESSION['buku-diedit'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['buku-diedit']; ?></div>
    <?php unset($_SESSION['buku-diedit']);
    }
    

    if (isset($_SESSION['login-sukses'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['login-sukses']; ?></div>
    <?php unset($_SESSION['login-sukses']);
    }
    ?>

    <?php
    if (isset($_SESSION['logged-in'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['logged-sukses']; ?></div>
    <?php }
    ?>

    <h1>Daftar Buku</h1>
    <a href="/books/create.php" class="btn btn-primary">+ Tambah Buku</a>

    <table style="width: 100%;">
        <thead>
            <th style="width: 15%;">Cover</th>
            <th style="width: 40%;">Judul/Pengarang</th>
            <th style="width: 20%;">Kategori</th>
            <th style="width: 10%;">Stok</th>
            <?php if (isset($_SESSION['logged-in'])) { ?>
                <th style="width: 15%;">Aksi</th>
            <?php } ?>
        </thead>
        <tbody>
            <?php foreach ($result as $p):
                $img_path = $p['cover'] != NULL ? "/uploads/covers/{$p['cover']}" : "/uploads/covers/Book.png";
            ?>
                <tr>
                    <td><img src="<?= $img_path; ?>" alt="<?= $img_path; ?>" style="width:60px; height:100px;"></td>
                    <td>
                        <strong style="font-weight: bold"><?= $p['title']; ?></strong><br>
                        <small><?= $p['author']; ?></small>
                    </td>
                    <td><?= $p['category']; ?></td>
                    <td><?= $p['stock']; ?></td>
                    <?php if (isset($_SESSION['logged-in'])) { ?>
                        <td>
                        <div class="action-button">
                            <a class="btn btn-warning" href="/books/edit.php?id=<?= $p['id']; ?>">Edit</a>
                            <form action="/books/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin hapus buku ini?')">Delete</button>
                            </form>
                        </div>
                    </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

require __DIR__ . '/../includes/footer.php';

?>