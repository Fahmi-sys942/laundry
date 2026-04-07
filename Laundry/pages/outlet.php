<?php
require_once '../config/database.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['tlp'];

    try {
        $sql = "INSERT INTO outlet (nama, alamat, tlp) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $alamat, $telepon]);
        
        $_SESSION['success'] = "Data outlet berhasil ditambahkan!";
        header("Location: outlet.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-shop"></i> Tambah Outlet Baru</h5>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <form action="outlet.php" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Outlet</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    <a href="../index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>