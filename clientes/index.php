<?php
require_once __DIR__ . '/../config/database.php';
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';

$clientes = $conn->query("
    SELECT c.*, 
           l.data_fim,
           l.status AS status_licenca
    FROM clientes c
    LEFT JOIN licencas l ON l.cliente_id = c.id
    ORDER BY c.created_at DESC
");
?>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h3>Clientes</h3>
            <a href="form.php" class="btn btn-primary">
                Novo Cliente
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Subdomínio</th>
                            <th>Status</th>
                            <th>Licença</th>
                            <th>Vencimento</th>
                            <th width="140">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($c = $clientes->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['nome']) ?></td>
                                <td><?= $c['subdominio'] ?>.chamaos.com</td>
                                <td>
                                    <span class="badge bg-<?= $c['status'] == 'ativo' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($c['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $c['status_licenca'] ?? '-' ?>
                                </td>
                                <td>
                                    <?= $c['data_fim'] ? date('d/m/Y', strtotime($c['data_fim'])) : '-' ?>
                                </td>
                                <td>
                                    <a href="form.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    <a href="controller/excluir-cliente.php?id=<?= $c['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Excluir este cliente?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>