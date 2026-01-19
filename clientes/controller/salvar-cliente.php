<?php
require_once __DIR__ . '/../../config/database.php';

$conn->begin_transaction();

try {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $conn->prepare("
            UPDATE clientes SET
                nome = ?, subdominio = ?, email = ?, contato = ?, status = ?
            WHERE id = ?
        ");
        $stmt->bind_param(
            "sssssi",
            $_POST['nome'],
            $_POST['subdominio'],
            $_POST['email'],
            $_POST['contato'],
            $_POST['status'],
            $id
        );
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("
            INSERT INTO clientes (nome, subdominio, email, contato, status)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "sssss",
            $_POST['nome'],
            $_POST['subdominio'],
            $_POST['email'],
            $_POST['contato'],
            $_POST['status']
        );
        $stmt->execute();
        $id = $conn->insert_id;
    }

    // LICENÇA
    if (!empty($_POST['data_inicio']) && !empty($_POST['data_fim'])) {
        $existe = $conn->query("SELECT id FROM licencas WHERE cliente_id = $id")->num_rows;

        if ($existe) {
            $stmt = $conn->prepare("
                UPDATE licencas SET plano=?, data_inicio=?, data_fim=?
                WHERE cliente_id=?
            ");
            $stmt->bind_param(
                "sssi",
                $_POST['plano'],
                $_POST['data_inicio'],
                $_POST['data_fim'],
                $id
            );
        } else {
            $stmt = $conn->prepare("
                INSERT INTO licencas (cliente_id, plano, data_inicio, data_fim)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "isss",
                $id,
                $_POST['plano'],
                $_POST['data_inicio'],
                $_POST['data_fim']
            );
        }
        $stmt->execute();
    }

    $conn->commit();
    header('Location: ../index.php');
} catch (Exception $e) {
    $conn->rollback();
    die('Erro ao salvar cliente');
}
