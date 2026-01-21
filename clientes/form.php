<?php
require_once __DIR__ . '/../config/database.php';
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';

$id = $_GET['id'] ?? null;
$cliente = [];
$licenca = [];

if ($id) {
    $cliente = $conn->query("SELECT * FROM clientes WHERE id = $id")->fetch_assoc();
    $licenca = $conn->query("SELECT * FROM licencas WHERE cliente_id = $id")->fetch_assoc();
}
?>

<div class="main-content">
    <div class="bg-light rounded p-4">
        <h3><?= $id ? 'Editar Cliente' : 'Novo Cliente' ?></h3>

        <form method="post" action="controller/salvar-cliente.php">
            <input type="hidden" name="id" value="<?= $cliente['id'] ?? '' ?>">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link active"
                        data-bs-toggle="tab"
                        data-bs-target="#cliente">
                        Cliente
                    </button>
                </li>

                <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#licenca">
                        Licença
                    </button>
                </li>
            </ul>

            <div class="tab-content border p-3">
                <!-- CLIENTE -->
                <div class="tab-pane fade show active" id="cliente">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control"
                                value="<?= $cliente['nome'] ?? '' ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Subdomínio</label>
                            <input type="text" name="subdominio" class="form-control"
                                value="<?= $cliente['subdominio'] ?? '' ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?= $cliente['email'] ?? '' ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Contato</label>
                            <input type="contato" name="contato" class="form-control"
                                value="<?= $cliente['contato'] ?? '' ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="ativo" <?= ($cliente['status'] ?? '') == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                                <option value="suspenso" <?= ($cliente['status'] ?? '') == 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- LICENÇA -->
                <div class="tab-pane fade" id="licenca">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Plano</label>
                            <input type="text" name="plano" class="form-control"
                                value="<?= $licenca['plano'] ?? 'basico' ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Data Início</label>
                            <input type="date" name="data_inicio" class="form-control"
                                value="<?= $licenca['data_inicio'] ?? '' ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Data Fim</label>
                            <input type="date" name="data_fim" class="form-control"
                                value="<?= $licenca['data_fim'] ?? '' ?>">
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success mt-3">Salvar</button>
            <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>