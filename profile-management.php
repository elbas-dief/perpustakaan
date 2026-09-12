<?php

require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/auth_check.php';

cekLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];

    $hash_password = password_hash($new_password, PASSWORD_BCRYPT);

    $id = $_SESSION['user-id'];

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql)->fetch_assoc();

    if (!password_verify($old_password, $result['password'])) {
        $_SESSION['password-salah'] = 'Password salah!';
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        $sql_post = "UPDATE users SET password = ? WHERE id = $id";
        $stmt = $conn->prepare($sql_post);
        $stmt->execute([$hash_password]);

        $_SESSION['password-diganti'] = 'Password berhasil diganti!';

        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    };
}

if (isset($_SESSION['password-diganti'])) { ?>
    <div class="alert alert-success"><?= $_SESSION['password-diganti']; ?></div>
<?php
} elseif (isset($_SESSION['password-salah'])) { ?>
    <div class="alert alert-danger"><?= $_SESSION['password-salah']; ?></div>
<?php
}

?>

<div class="container">
    <h1>Profile Management</h1>

    <form action="#" method="POST">
        <div>
            <label for="old-password" class="form-label">Passowrd Lama</label>
            <input type="password" name="old-password" id="old-password" class="form-control" placeholder="Masukan password lama">
        </div>
        <div>
            <label for="new-password" class="form-label">Password Baru</label>
            <input type="password" name="new-password" id="new-password" class="form-control" placeholder="Masukan password baru">
        </div>
        <button type="submit" class="btn btn-primary">Ganti Password</button>
    </form>
</div>

<?php

require __DIR__ . '/includes/footer.php'

?>