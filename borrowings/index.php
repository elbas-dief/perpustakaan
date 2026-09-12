<?php

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/auth_check.php';

cekLogin();

$status = $_GET['status'] ?? 'semua';
$result = [];

if ($status === 'semua') {
    $sql = "SELECT br.*, b.title AS judul_buku
    FROM borrowings br
    JOIN books b ON br.book_id = b.id
    ORDER BY b.title";
    $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
} elseif ($status === 'dipinjam') {
    $sql = "SELECT br.*, b.title AS judul_buku
    FROM borrowings br
    JOIN books b ON br.book_id = b.id
    WHERE br.status = 'Dipinjam'
    ORDER BY b.title";
    $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
} elseif ($status === 'dikembalikan') {
    $sql = "SELECT br.*, b.title AS judul_buku
    FROM borrowings br
    JOIN books b ON br.book_id = b.id
    WHERE br.status = 'Dikembalikan'
    ORDER BY b.title";
    $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

if (isset($_SESSION['pinjaman-dicatat'])) { ?>
    <div class="alert alert-success"><?= $_SESSION['pinjaman-dicatat']; ?> </div>
<?php unset($_SESSION['pinjaman-dicatat']);
}

if (isset($_SESSION['buku-dikembalikan'])) { ?>
    <div class="alert alert-success"><?= $_SESSION['buku-dikembalikan']; ?> </div>
<?php unset($_SESSION['buku-dikembalikan']);
}

// var_dump($dipinjam['judul_buku']);

?>

<div class="container">
    <h1>Peminjaman</h1>

    <a href="/borrowings//create.php" class="btn btn-primary">+ Catat Pinjaman</a>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link <?= ($status === 'semua') ? 'active fw-bold' : '' ?>"
                href="/borrowings/index.php?status=semua">Semua</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($status === 'dipinjam') ? 'active fw-bold' : '' ?>"
                href="/borrowings/index.php?status=dipinjam">Dipinjam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($status === 'dikembalikan') ? 'active fw-bold' : '' ?>"
                href="/borrowings/index.php?status=dikembalikan">Dikembalikan</a>
        </li>
    </ul>

    <table style="width: 100%;">
        <thead>
            <th>Judul Buku</th>
            <th>Peminjam</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php foreach ($result as $b): ?>
                <tr>
                    <td><?= $b['judul_buku']; ?></td>
                    <td><?= $b['borrower_name']; ?></td>
                    <td><?= $b['borrow_date']; ?></td>
                    <td><?= $b['return_date']; ?></td>
                    <td>
                        <?php
                        if ($b['status'] == 'Dipinjam') { ?>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2"><?= $b['status']; ?></span>
                        <?php } else { ?>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2"><?= $b['status']; ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($b['status'] == 'Dipinjam') : ?>
                            <a href="/borrowings/return.php?id=<?= $b['id']; ?>" class="btn btn-success">Kembalikan</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php

require __DIR__ . '/../includes/footer.php';

?>