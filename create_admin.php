<?php 

require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users(username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt-> execute([$username, $hash_password]);

    header("location: /auth/login.php");

}

?>

<div class="register-form container">
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
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
</div>

<?php 

require __DIR__ . '/includes/footer.php';

?>