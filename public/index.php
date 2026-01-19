<?php
require_once 'config/database.php';

$total = $conn->query("SELECT COUNT(*) total FROM clientes")->fetch_assoc()['total'];

$ativos = $conn->query("
    SELECT COUNT(*) total 
    FROM clientes 
    WHERE status = 'ativo'
")->fetch_assoc()['total'];

$vencidos = $conn->query("
    SELECT COUNT(*) total 
    FROM licencas 
    WHERE data_fim < CURDATE()
")->fetch_assoc()['total'];
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h3>Dashboard</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5>Total de Clientes</h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5>Clientes Ativos</h5>
                    <h2><?= $ativos ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5>Licenças Vencidas</h5>
                    <h2><?= $vencidos ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
