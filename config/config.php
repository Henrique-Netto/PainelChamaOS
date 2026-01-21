<?php
// Inicia sessão UMA ÚNICA VEZ
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base do sistema
define('BASE_URL', '/painelchamaos');
