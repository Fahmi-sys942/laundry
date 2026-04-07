<?php
require_once '../config/database.php';

$id_member = $_GET['id'] ?? null;

if (!$id_member) {
    $_SESSION['error'] = "ID member tidak valid!";
    header("Location: ../index.php");
    exit();
}

try {
    $sql = "DELETE FROM member WHERE id_member = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_member]);

    $_SESSION['success'] = "Data member berhasil dihapus!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}

header("Location: ../index.php");
exit();
?>