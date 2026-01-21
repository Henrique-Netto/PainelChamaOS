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

$clientesProximoVencimento = $conn->query("
    SELECT 
        c.id,
        c.nome,
        c.subdominio,
        l.data_fim,
        DATEDIFF(l.data_fim, CURDATE()) AS dias_restantes
    FROM clientes c
    INNER JOIN licencas l ON l.cliente_id = c.id
    WHERE 
        l.data_fim >= CURDATE()
        AND l.data_fim <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        AND c.status = 'ativo'
    ORDER BY l.data_fim ASC
");

?>

<div class="main-content">
    <div class="bg-light rounded p-4">
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

        <!-- CLIENTES PRÓXIMOS DE VENCER -->
        <div class="row mt-5">
            <div class="col">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="mb-3 text-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            Licenças próximas do vencimento
                        </h5>

                        <?php if ($clientesProximoVencimento->num_rows > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Subdomínio</th>
                                            <th>Vencimento</th>
                                            <th>Dias Restantes</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($c = $clientesProximoVencimento->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($c['nome']) ?></td>
                                                <td><?= $c['subdominio'] ?>.chamaos.com</td>
                                                <td><?= date('d/m/Y', strtotime($c['data_fim'])) ?></td>
                                                <td>
                                                    <span class="badge bg-warning text-dark">
                                                        <?= $c['dias_restantes'] ?> dias
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="clientes/form.php?id=<?= $c['id'] ?>"
                                                        class="btn btn-sm btn-outline-primary">
                                                        Ver cliente
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success mb-0">
                                Nenhuma licença próxima do vencimento 🎉
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>