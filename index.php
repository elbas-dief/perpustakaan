<?php

require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/header.php';

?>

<main>
    <?php if (!isset($_SESSION['logged-in'])) { ?>
        <div class="btn-login">
            <a href="/borrowings/index.php" class="btn btn-primary btn-admin">I am an Admin</a>
            <a href="/books/index.php" class="btn btn-secondary btn-guest">I am a Guest</a>
        </div>
    <?php } else { ?>
        <div class="admin-menu">
            <a href="/books/index.php" class="btn btn-primary btn-admin-menu btn-daftar-buku"><i class="bi bi-book-half"></i> Daftar Buku</a>
            <a href="/borrowings/index.php" class="btn btn-success btn-admin-menu btn-daftar-pinjam"><i class="bi bi-list-check"></i> Daftar Peminjaman</a>
            <a href="/profile-management.php" class="btn btn-secondary btn-admin-menu btn-settings"><i class="bi bi-gear-fill"></i> Profile Management</a>
        </div>
    <?php } ?>
</main>

<?php

require __DIR__ . '/includes/footer.php';

?>