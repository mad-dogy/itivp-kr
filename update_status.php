<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if ($id && is_numeric($id)) {
    $stmt = $pdo->prepare("SELECT status FROM serias WHERE id = ?");
    $stmt->execute([$id]);
    $current_status = $stmt->fetchColumn();

    $new_status = ($current_status == 'просмотрен') ? 'не просмотрен' : 'просмотрен';

    $stmt = $pdo->prepare("UPDATE serias SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);
}

header("Location: index.php");
exit;
?>