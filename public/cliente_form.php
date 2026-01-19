<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <h3>Cadastrar Cliente</h3>

    <form method="post" action="cliente_salvar.php">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#cliente">
                    Cliente
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#licenca">
                    Licença
                </button>
            </li>
        </ul>

        <div class="tab-content border p-3">
            <!-- ABA CLIENTE -->
            <div class="tab-pane fade show active" id="cliente">
                <div class="mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Subdomínio</label>
                    <input type="text" name="subdominio" class="form-control" placeholder="cliente1">
                </div>

                <div class="mb-3">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="ativo">Ativo</option>
                        <option value="suspenso">Suspenso</option>
                    </select>
                </div>
            </div>

            <!-- ABA LICENÇA -->
            <div class="tab-pane fade" id="licenca">
                <div class="mb-3">
                    <label>Plano</label>
                    <select name="plano" class="form-control">
                        <option value="basico">Básico</option>
                        <option value="pro">Pro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Data Início</label>
                    <input type="date" name="data_inicio" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Data Fim</label>
                    <input type="date" name="data_fim" class="form-control">
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Salvar</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
