<?php
require_once '../config/database.php';
include '../includes/header.php';

// Ambil data outlet untuk dropdown
 $outlets = $pdo->query("SELECT * FROM outlet")->fetchAll(PDO::FETCH_ASSOC);

// Proses tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];
    $id_outlet = !empty($_POST['id_outlet']) ? $_POST['id_outlet'] : null;

    try {
        $sql = "INSERT INTO user (nama, username, password, role, id_outlet) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $username, $password, $role, $id_outlet]);
        
        $_SESSION['success'] = "Data user berhasil ditambahkan!";
        header("Location: tambah-user.php");
        exit();
    } catch (PDOException $e) {
        // Cek apakah error karena username duplikat
        if ($e->getCode() == 23000) {
            $error = "Username sudah digunakan, silakan pilih username lain.";
        } else {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person-plus-fill"></i> Tambah User Baru</h5>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <form action="user.php" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_outlet" class="form-label">Outlet (Opsional)</label>
                        <select class="form-select" id="id_outlet" name="id_outlet">
                            <option value="">-- Pilih Outlet --</option>
                            <?php foreach ($outlets as $outlet): ?>
                                <option value="<?= $outlet['id_outlet'] ?>"><?= htmlspecialchars($outlet['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    <a href="../index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>