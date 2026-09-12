<?php

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->get_result()->fetch_assoc();

    if (!$user || !password_verify($password, $user['password'])) {
        header("location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    $_SESSION['logged-in'] = true;
    $_SESSION['login-sukses'] = "Selamat datang kembali!";
    $_SESSION['user-id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header("location: /books/index.php");
    exit();
}


// echo $_SESSION['logged_in'];

?>

<div class="login-form container">
    <h1>Mini Library</h1>
    <form action="#" method="POST">
        <div class="username">
            <label for="username" class="form-label">Username</label>
            <input class="form-control" type="text" name="username" id="username">
        </div>
        <div>
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <div class="button">
            <div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div>
                <a href="/create_admin.php" class="btn btn-outline-primary">Register</a>
            </div>
        </div>
    </form>
</div>

<?php

require __DIR__ . '/../includes/footer.php';

?>