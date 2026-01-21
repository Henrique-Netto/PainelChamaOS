<body>
<header class="topbar d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="bi bi-list"></i>
        </button>

        <span class="topbar-title">Painel ChamaOS</span>
    </div>

    <!-- Usuário logado -->
    <div class="dropdown">
        <i class="bi bi-person-circle fs-5"></i>
        <span class="fw-semibold">
            <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário') ?>
        </span>
    </div>
</header>

<div class="sidebar" id="sidebar">
    <ul class="menu">
        <li>
            <a href="/PainelChamaOS/index.php">
                <i class="bi bi-speedometer2"></i>
                <span>Painel</span>
            </a>
        </li>

        <li>
            <a href="/PainelChamaOS/clientes/index.php">
                <i class="bi bi-people"></i> 
                <span>Clientes</span> 
            </a>
        </li>

        <li class="mt-auto">
            <a href="/PainelChamaOS/logout.php" class="text-danger">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span> 
            </a>
        </li>
    </ul>
</div>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>