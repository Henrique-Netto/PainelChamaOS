<?php
/**
 * Conexão com o banco de dados
 * Painel ChamaOS (MASTER)
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'painelchamaos');   // nome do banco do painel
define('DB_USER', 'root');
define('DB_PASS', '');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log('Erro de conexão DB: ' . $e->getMessage());
    die('Erro ao conectar no banco de dados.');
}
