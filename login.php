<?php
$titulo = "Login";

require 'config/database.php';
require_once __DIR__ . '/layout/header.php';

$erro = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = $_POST['senha'] ?? '';

    if (empty($usuario) || empty($senha)) {
        $erro = 'Preencha usuário e senha.';
    } else {

        $sql = "SELECT id, nome, usuario, senha FROM usuarios WHERE usuario = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $user = $resultado->fetch_assoc();

        if ($user && password_verify($senha, $user['senha'])) {

            $_SESSION['usuario_id']    = $user['id'];
            $_SESSION['usuario_nome']  = $user['nome'];
            $_SESSION['usuario_login'] = $user['usuario'];

            header('Location: index.php');
            exit;
        } else {
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}
?>

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center" style="min-height:100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="p-4 p-sm-5 my-4 mx-3 bg-white rounded-4 shadow-lg">

                <div class="text-center mb-3">
                    <h3 class="fw-semibold">Fazer Login</h3>
                </div>

                <div class="text-center mb-4">
                    <small class="text-muted d-block">
                        Acesso ao <strong>Painel Administrativo do ChamaOS</strong>
                    </small>
                </div>

                <!-- Formulário -->
                <form method="POST" novalidate autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="text"
                            name="usuario"
                            class="form-control bg-white text-primary border"
                            id="floatingUsuario"
                            placeholder="Usuário"
                            required
                            autocomplete="off"
                            autocapitalize="off"
                            spellcheck="false">

                        <label for="floatingUsuario" class="text-secondary">
                            Usuário <span class="text-danger">*</span>
                        </label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password"
                            name="senha"
                            class="form-control bg-white text-primary border"
                            id="floatingSenha"
                            placeholder="Senha"
                            required
                            autocomplete="new-password">
                        <label for="floatingSenha" class="text-secondary">
                            Senha <span class="text-danger">*</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4 rounded-3">
                        Entrar
                    </button>
                </form>

                <div class="text-center mt-2">
                    <small class="text-secondary">
                        Este acesso é restrito ao <strong>Painel do Sistema ChamaOS</strong>.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        <?php if (!empty($erro)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: <?= json_encode($erro) ?>
            });
        <?php endif; ?>
    });
</script>