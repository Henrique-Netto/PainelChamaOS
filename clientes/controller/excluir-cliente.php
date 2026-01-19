<?php
require_once __DIR__ . '/../../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ../index.php');
    exit;
}

$stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: ../index.php');
