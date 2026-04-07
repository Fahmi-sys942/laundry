<?php
// Mengincludekan file yang diperlukan
require_once 'config/database.php';
include 'includes/header.php';

// Query untuk mengambil data
$query_user = "SELECT user.*, outlet.nama AS nama_outlet FROM user LEFT JOIN outlet ON user.id_outlet = outlet.id_outlet";
$query_outlet = "SELECT * FROM outlet";
$query_member = "SELECT * FROM member";

$stmt_user = $pdo->query($query_user);
$stmt_outlet = $pdo->query($query_outlet);
$stmt_member = $pdo->query($query_member);
?>

<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Dashboard Aplikasi Laundry</h1>
    </div>
</div>

<!-- Tabel Data User -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people-fill"></i> Data User</h5>
                <a href="pages/user.php" class="btn btn-primary btn-sm">+ Tambah User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Outlet</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt_user->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['id_user'] ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><span class="badge bg-info"><?= htmlspecialchars($row['role']) ?></span></td>
                                <td><?= htmlspecialchars($row['nama_outlet'] ?? '-') ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Outlet -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-shop"></i> Data Outlet</h5>
                <a href="pages/outlet.php" class="btn btn-primary btn-sm">+ Tambah Outlet</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Outlet</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt_outlet->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['id_outlet'] ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                                <td><?= htmlspecialchars($row['tlp']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Member -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Data Member</h5>
                <a href="pages/member.php" class="btn btn-primary btn-sm">+ Tambah Member</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Member</th>
                                <th>Jenis Kelamin</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt_member->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['id_member'] ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                <td><?= htmlspecialchars($row['tlp']) ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>