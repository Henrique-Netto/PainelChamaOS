<?php
require_once __DIR__ . '/../config/config.php';

if (empty($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}
