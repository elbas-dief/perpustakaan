# Rancangan Sistem — Tema A: Perpustakaan Mini
**Haltev IT Learning Center — Exam 2**
**Teknologi: PHP Native, MySQL, Bootstrap 5, XAMPP**

---

## Database

```sql
CREATE DATABASE IF NOT EXISTS perpustakaan;
USE perpustakaan;

CREATE TABLE books (
    id         INT PRIMARY KEY AUTO_INCREMENT,
    title      VARCHAR(200) NOT NULL,
    author     VARCHAR(150) NOT NULL,
    category   VARCHAR(100),
    year       YEAR,
    stock      INT DEFAULT 1,
    cover      VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE borrowings (
    id            INT PRIMARY KEY AUTO_INCREMENT,
    book_id       INT NOT NULL,
    borrower_name VARCHAR(150) NOT NULL,
    borrow_date   DATE NOT NULL,
    return_date   DATE,
    status        ENUM('dipinjam', 'dikembalikan') DEFAULT 'dipinjam',
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE users (
    id         INT PRIMARY KEY AUTO_INCREMENT,
    username   VARCHAR(50) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL
);

-- Data awal
INSERT INTO books (title, author, category, year, stock) VALUES
    ('Laskar Pelangi',       'Andrea Hirata',    'Novel',   2005, 3),
    ('Bumi Manusia',         'Pramoedya Ananta', 'Novel',   1980, 2),
    ('Atomic Habits',        'James Clear',      'Non-fiksi', 2018, 4),
    ('Clean Code',           'Robert C. Martin', 'Teknologi', 2008, 2),
    ('Sapiens',              'Yuval Noah Harari','Non-fiksi', 2011, 3);
```

### Relasi Tabel

```
books                    borrowings              users
─────                    ──────────              ─────
id ◄──────────────────── book_id                 id
title                    id                      username
author                   borrower_name           password (hashed)
category                 borrow_date
year                     return_date
stock                    status (dipinjam | dikembalikan)
cover
```

> 💡 Kolom `status` di tabel `borrowings` mempermudah query — tidak perlu bergantung pada `return_date IS NULL` untuk cek apakah buku masih dipinjam.

---

## Struktur Folder

```
perpustakaan/
├── config/
│   └── database.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── auth_check.php
├── books/
│   ├── index.php           ← daftar buku + search + paginasi
│   ├── create.php          ← form tambah buku + upload cover
│   ├── edit.php            ← form edit buku
│   └── delete.php          ← proses hapus (cek peminjaman aktif dulu)
├── borrowings/
│   ├── index.php           ← daftar peminjaman + filter status
│   ├── create.php          ← form pinjam buku
│   └── return.php          ← proses kembalikan (tidak ada tampilan)
├── auth/
│   ├── login.php
│   └── logout.php
├── uploads/
│   └── covers/             ← folder simpan cover buku
├── index.php               ← redirect ke books/index.php
├── create_admin.php        ← jalankan sekali lalu hapus!
└── database.sql
```

---

## Fitur Utama

### 1. Manajemen Buku (CRUD)

| Halaman | Fungsi |
|---------|--------|
| `books/index.php` | Tampilkan semua buku dalam tabel, dengan kolom: cover, judul, pengarang, kategori, tahun, stok, aksi |
| `books/create.php` | Form tambah buku baru dengan upload cover (opsional) |
| `books/edit.php` | Form edit data buku, pertahankan cover lama jika tidak diganti |
| `books/delete.php` | Hapus buku — **cek dulu apakah masih ada peminjaman aktif**, jika ada tolak dengan pesan error |

**Fitur tambahan di daftar buku:**
- Search berdasarkan judul atau pengarang
- Paginasi (8 buku per halaman)
- Badge warna pada stok: hijau jika > 0, merah jika 0 (habis)

---

### 2. Pencatatan Peminjaman

| Halaman | Fungsi |
|---------|--------|
| `borrowings/index.php` | Daftar semua peminjaman. Ada filter: "Semua", "Sedang Dipinjam", "Sudah Dikembalikan" |
| `borrowings/create.php` | Form pinjam buku: dropdown pilih buku (hanya yang stok > 0), nama peminjam, tanggal pinjam |
| `borrowings/return.php` | Proses kembalikan: update status jadi `dikembalikan`, isi `return_date = hari ini`, tambah stok +1 |

**Logika penting:**
- Saat pinjam: stok buku dikurangi 1, status peminjaman = `dipinjam`
- Saat kembalikan: stok buku ditambah 1, status peminjaman = `dikembalikan`, `return_date` diisi otomatis
- Buku dengan stok 0 tidak boleh muncul di dropdown form pinjam

---

### 3. Sistem Login

- Halaman login untuk admin (`auth/login.php`)
- Semua halaman di folder `books/` dan `borrowings/` diproteksi dengan `auth_check.php`
- Navbar menampilkan nama user yang login dan tombol logout
- Halaman daftar buku publik (jika ada) tidak perlu login

---

## Query Penting

### Daftar buku beserta jumlah yang sedang dipinjam

```sql
SELECT b.*,
       COUNT(CASE WHEN br.status = 'dipinjam' THEN 1 END) AS sedang_dipinjam
FROM books b
LEFT JOIN borrowings br ON b.id = br.book_id
GROUP BY b.id
ORDER BY b.title ASC
```

### Daftar peminjaman beserta judul buku

```sql
SELECT br.*, b.title AS book_title, b.author
FROM borrowings br
JOIN books b ON br.book_id = b.id
ORDER BY br.created_at DESC
```

### Daftar peminjaman yang masih aktif (filter)

```sql
SELECT br.*, b.title AS book_title
FROM borrowings br
JOIN books b ON br.book_id = b.id
WHERE br.status = 'dipinjam'
ORDER BY br.borrow_date ASC
```

### Proses pinjam buku (dua query, urutan penting)

```sql
-- 1. Catat peminjaman
INSERT INTO borrowings (book_id, borrower_name, borrow_date, status)
VALUES (?, ?, ?, 'dipinjam')

-- 2. Kurangi stok
UPDATE books SET stock = stock - 1 WHERE id = ? AND stock > 0
```

### Proses kembalikan buku (dua query)

```sql
-- 1. Update status peminjaman
UPDATE borrowings
SET status = 'dikembalikan', return_date = CURDATE()
WHERE id = ?

-- 2. Tambah stok
UPDATE books SET stock = stock + 1 WHERE id = ?
```

### Cek sebelum hapus buku

```sql
SELECT COUNT(*) AS total
FROM borrowings
WHERE book_id = ? AND status = 'dipinjam'
```

Jika hasilnya > 0, tampilkan pesan error dan batalkan penghapusan.

---

## Catatan untuk Siswa

**Bagian yang paling tricky:**

Saat pinjam dan kembalikan, kamu harus update **dua tabel sekaligus** — tabel `borrowings` dan tabel `books`. Pastikan keduanya dijalankan. Kalau hanya update satu, stok akan tidak sinkron dengan data peminjaman.

**Urutan pengerjaan yang disarankan:**

1. Buat database dan jalankan SQL
2. Setup folder, `database.php`, `header.php`, `footer.php`, `auth_check.php`
3. Buat login dan `create_admin.php`
4. Buat CRUD buku (`books/`) dulu sampai selesai
5. Baru buat fitur peminjaman (`borrowings/`)
6. Finishing: tambah search, paginasi, dan validasi stok
