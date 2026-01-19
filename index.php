<?php
require_once __DIR__ . '/config/database.php';

require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/layout/sidebar.php';
require_once __DIR__ . '/layout/footer.php';



/* KPIs */
$totalClientes = $conn->query("
    SELECT COUNT(*) AS total 
    FROM clientes
")->fetch_assoc()['total'];

$clientesAtivos = $conn->query("
    SELECT COUNT(*) AS total 
    FROM clientes 
    WHERE status = 'ativo'
")->fetch_assoc()['total'];

$clientesSuspensos = $conn->query("
    SELECT COUNT(*) AS total 
    FROM clientes 
    WHERE status = 'suspenso'
")->fetch_assoc()['total'];

$licencasVencidas = $conn->query("
    SELECT COUNT(*) AS total 
    FROM licencas 
    WHERE data_fim < CURDATE()
")->fetch_assoc()['total'];
?>


<div class="main-content">
    <div class="container-fluid dashboard-container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="dashboard-title">Painel ChamaOS</h2>
                <p class="dashboard-subtitle">
                    Visão geral dos clientes e licenças do sistema
                </p>
            </div>
        </div>

        <div class="row g-4">
            <!-- TOTAL CLIENTES -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard card-primary">
                    <div class="card-body">
                        <span class="card-label">Clientes</span>
                        <h3><?= $totalClientes ?></h3>
                    </div>
                </div>
            </div>

            <!-- ATIVOS -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard card-success">
                    <div class="card-body">
                        <span class="card-label">Ativos</span>
                        <h3><?= $clientesAtivos ?></h3>
                    </div>
                </div>
            </div>

            <!-- SUSPENSOS -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard card-warning">
                    <div class="card-body">
                        <span class="card-label">Suspensos</span>
                        <h3><?= $clientesSuspensos ?></h3>
                    </div>
                </div>
            </div>

            <!-- VENCIDOS -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard card-danger">
                    <div class="card-body">
                        <span class="card-label">Licenças Vencidas</span>
                        <h3><?= $licencasVencidas ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOCO FUTURO -->
        <div class="row mt-5">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Próximos passos</h5>
                        <ul class="mb-0">
                            <li>Clientes vencendo nos próximos dias</li>
                            <li>Integração com Mercado Pago</li>
                            <li>Relatórios de acesso</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/layout/footer.php'; ?>