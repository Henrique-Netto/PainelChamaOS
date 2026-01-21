<body>
<header class="topbar">
    <button class="menu-toggle" onclick="toggleMenu()">
        <i class="bi bi-list"></i>
    </button>

    <span class="topbar-title">Painel ChamaOS</span>
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