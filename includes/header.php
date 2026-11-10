<?php

session_start();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Library</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <nav>
        <div class="nav-contain container">
            <a href="/index.php" class="nav-option">
                <h4 style="font-weight: bold;">Mini Library</h4>
            </a>
            <div class="nav-menu">
                <a href="/index.php" class="nav-option nav-point">Home</a>
                <a href="/books/index.php" class="nav-option nav-point">Buku</a>
                <a href="/borrowings/index.php" class="nav-option nav-point">Peminjaman</a>
                <div class="dropdown h-100 nav-point">
                    <a class="nav-option dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile Management
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/index.php">Admin</a></li>
                        <li><a class="dropdown-item" href="/profile-management.php">Profile Management</a></li>
                    </ul>
                </div>
                <?php

                if (isset($_SESSION['logged-in'])) { ?>
                    <a href="/auth/logout.php" class="nav-option text-danger nav-point">Logout</a>
                <?php } else { ?>
                    <a href="/auth/login.php" class="nav-option text-success nav-point">Login</a>
                <?php }

                ?>

            </div>
        </div>
    </nav>