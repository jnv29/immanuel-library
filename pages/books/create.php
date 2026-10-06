<?php
// Perbaikan: Panggil repository resmi untuk mengambil data kategori dan penulis
require_once '../../repositories/category-repository.php';
require_once '../../repositories/author-repository.php';

$pageTitle = 'Tambah Buku';
$pageSubtitle = 'Form untuk menambah data buku baru';

// Ambil data melalui fungsi repository, bukan langsung dari db()
$categories = getCategories();
$authors = getAuthors();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../styles/base.css">
    <link rel="stylesheet" href="../../styles/pages/management.css">
    <link rel="stylesheet" href="../../styles/components/sidebar.css">
    <link rel="stylesheet" href="../../styles/components/header.css">
    <link rel="stylesheet" href="../../styles/components/forms.css">
    <link rel="stylesheet" href="../../styles/books/create.css">
</head>
<body>
    <div class="container">
        <?php include '../../components/admin/sidebar.php'; ?>

        <div class="main-content">
            <?php include '../../components/admin/topbar.php'; ?>

            <div class="content">
                <form action="../../actions/books/store.php" method="POST">
                    <div class="form-group">
                        <label for="title">Judul Buku</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Tahun Terbit</label>
                        <input type="number" id="year" name="year" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" id="stock" name="stock" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <!-- Perbaikan: Gunakan $categories dari getCategories() -->
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="author_ids">Penulis</label>
                        <select id="author_ids" name="author_ids[]" multiple required>
                            <!-- Perbaikan: Gunakan $authors dari getAuthors() -->
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= htmlspecialchars($author['id']) ?>"><?= htmlspecialchars($author['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Simpan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>