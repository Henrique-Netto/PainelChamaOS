<?php
session_start();

/*
 | Destroi todas as variáveis de sessão
 */
$_SESSION = [];

/*
 | Destroi a sessão
 */
session_destroy();

/*
 | Garante que o cookie de sessão seja removido (boa prática)
 */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/*
 | Redireciona para a tela de login
 */
header('Location: login.php');
exit;
