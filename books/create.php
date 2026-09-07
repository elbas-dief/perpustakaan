<?php

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$sql = "SELECT category FROM books GROUP BY category";
$list_kategori = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// var_dump($list_kategori);

$judul_buku = $_POST['title'] ?? '';
$author = $_POST['author'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$tahun = $_POST['tahun'] ?? '';
$stok = $_POST['stok'] ?? '';
$cover = $_FILES['cover'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = getimagesize($cover['tmp_name']);
    if ($info === false) {
        $_SESSION['error'] = "File bukan gambar";
        header("location: {$_SERVER['HTTP_REFERER']}?message=not an image");
        exit();
    }

    $allowed_type = [
        IMAGETYPE_BMP => 'bmp',
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WEBP => 'webp',
    ];

    if (!array_key_exists($info[2], $allowed_type)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?message=type not allowed");
    }

    $filename = $_FILES['cover']['name'];
    $tmp_name = $_FILES['cover']['tmp_name'];

    $tipe = pathinfo($filename, PATHINFO_EXTENSION);
    $image_name = 'book_' . time() . '.' . $tipe; // book_08092026.jpg
    $target_dir = __DIR__ . '/../uploads/covers' . $image_name;

    move_uploaded_file($tmp_name, $target_dir);

    $sql_post = "INSERT INTO books(title, author, category, year, stock, cover) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_post);
    $stmt->execute([$judul_buku, $author, $kategori, $tahun, $stok, $image_name]);
}

?>

<form action="#" method="POST" class="container" enctype="multipart/form-data">
    <div>
        <label for="title" class="form-label">Judul Buku<span style="color: red; font-weight:bold">*</span></label>
        <input type="text" name="title" id="titlee" class="form-control" required>
    </div>
    <div>
        <label for="author" class="form-label">Pegarang<span style="color: red; font-weight:bold">*</span></label>
        <input type="text" name="author" id="author" class="form-control" required>
    </div>
    <div>
        <label for="kategori" class="form-label">Kategori</label>
        <select name="kategori" id="kategori" class="form-select">
            <option value="novel" class="" disabled selected>--Pilih Kategori--</option>
            <?php foreach ($list_kategori as $k): ?>
                <option value="<?= $k['category']; ?>">
                    <?= $k['category']; ?>
                </option>
            <?php endforeach; ?>
            <option value="lain-lain">Lain-lain</option>
        </select>
    </div>
    <div>
        <label for="tahun" class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" id="tahun" class="form-control">
    </div>
    <div>
        <label for="stok" class="form-label">Stok<span style="color: red; font-weight:bold">*</span></label>
        <input type="number" name="stok" id="stok" class="form-control" required>
    </div>
    <div>
        <label for="cover" class="form-label">Cover</label>
        <input type="file" name="cover" id="cover" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

require __DIR__ . '/../includes/footer.php';

?>