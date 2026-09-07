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

</head>

<body>
    <nav>
        <div class="nav-contain container">
            <a href="/index.php" class="nav-option">
                <h4 style="font-weight: bold;">Mini Library</h4>
            </a>
            <div class="nav-menu">
                <a href="/index.php" class="nav-option">Home</a>
                <a href="/books/index.php" class="nav-option">Buku</a>
                <a href="/borrowings/index.php" class="nav-option">Peminjaman</a>
                <select name="admin" id="admin" class="nav-dropdown">
                    <option value="admin">Admin</option>
                    <option value="profile">Profile Management</option>
                </select>
                <a href="/auth/login.php" class="nav-option">Login</a>
                <a href="/auth/logout.php" class="nav-option">Logout</a>
            </div>
        </div>
    </nav>