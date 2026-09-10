<?php 

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$sql_kategori = "SELECT category FROM books GROUP BY category";
$list_kategori = $conn->query($sql_kategori)->fetch_all(MYSQLI_ASSOC);
// $result = $conn->query($sql)->fetch_assoc();

$where = $_GET['id'];

$sql = "SELECT * FROM books WHERE id=$where";
// $list_kategori = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$result = $conn->query($sql)->fetch_assoc();

// var_dump($result);

?>

<form action="#" method="POST" class="container" enctype="multipart/form-data">
    <input type="hidden" value="<?= $result['id']; ?>" name="id">
    <div>
        <label for="title" class="form-label">Judul Buku<span style="color: red; font-weight:bold">*</span></label>
        <input type="text" name="title" id="titlee" class="form-control" required value="<?= $result['title']; ?>">
    </div>
    <div>
        <label for="author" class="form-label">Pegarang<span style="color: red; font-weight:bold">*</span></label>
        <input type="text" name="author" id="author" class="form-control" required value="<?= $result['author']; ?>">
    </div>
    <div>
        <label for="kategori" class="form-label">Kategori</label>
        <select name="kategori" id="kategori" class="form-select">
            <option value="" class="" disabled>--Pilih Kategori--</option>
            <?php foreach ($list_kategori as $k): ?>
                <option value="<?= $result['category']; ?>" <?= $result['category'] == $k['category'] ? 'selected' : ''; ?>>
                    <?= $k['category']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="tahun" class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" id="tahun" class="form-control" value="<?= $result['year']; ?>">
    </div>
    <div>
        <label for="stok" class="form-label">Stok<span style="color: red; font-weight:bold">*</span></label>
        <input type="number" name="stok" id="stok" class="form-control" value="<?= $result['stock']; ?>" required>
    </div>
    <div>
        <label for="cover" class="form-label">Cover</label>
        <input type="file" name="cover" id="cover" class="form-control" value="<?= $result['cover']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

$id = $_POST['id'] ?? '';
$judul_buku = $_POST['title'] ?? '';
$author = $_POST['author'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$tahun = $_POST['tahun'] ?? '';
$stok = $_POST['stok'] ?? '';
$cover = $_FILES['cover'] ?? NULL;

if (!empty($cover['name']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
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
        exit();
    }

    $filename = $cover['name'];
    $tmp_name = $cover['tmp_name'];

    $tipe = pathinfo($filename, PATHINFO_EXTENSION);
    $image_name = 'book_' . time() . '.' . $tipe; // book_08092026.jpg
    $target_dir = __DIR__ . '/../uploads/covers/' . $image_name;

    move_uploaded_file($tmp_name, $target_dir);

    $sql_post = "UPDATE books SET id=?, title=?, author=?, category=?, year=?, stock=?, cover=? WHERE id=$where";
    $stmt = $conn->prepare($sql_post);
    $stmt->execute([$id, $judul_buku, $author, $kategori, $tahun, $stok, $image_name]);

    header("Location = /../books/index.php");
}

require __DIR__ . '/../includes/footer.php';

?>