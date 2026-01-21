<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

// =========================
// Validação básica
// =========================
$subdominio = $_GET['subdominio'] ?? null;

if (!$subdominio) {
    http_response_code(400);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Subdomínio não informado'
    ]);
    exit;
}

// =========================
// Consulta cliente + licença
// =========================
$sql = "
    SELECT 
        c.id AS cliente_id,
        c.nome,
        c.subdominio,
        c.status AS cliente_status,

        l.id AS licenca_id,
        l.plano,
        l.data_inicio,
        l.data_fim,
        l.status AS licenca_status
    FROM clientes c
    LEFT JOIN licencas l ON l.cliente_id = c.id
    WHERE c.subdominio = ?
    ORDER BY l.id DESC
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $subdominio);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

// =========================
// Cliente não encontrado
// =========================
if (!$data) {
    http_response_code(404);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Cliente não encontrado'
    ]);
    exit;
}

// =========================
// Cliente inativo
// =========================
if ($data['cliente_status'] !== 'ativo') {
    http_response_code(403);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Cliente ' . $data['cliente_status']
    ]);
    exit;
}

// =========================
// Licença não encontrada
// =========================
if (!$data['licenca_id']) {
    http_response_code(403);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Licença não cadastrada'
    ]);
    exit;
}

// =========================
// Status da licença
// =========================
if ($data['licenca_status'] !== 'ativa') {
    http_response_code(403);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Licença ' . $data['licenca_status']
    ]);
    exit;
}

// =========================
// Validação de datas
// =========================
$hoje = date('Y-m-d');

if ($hoje < $data['data_inicio'] || $hoje > $data['data_fim']) {
    http_response_code(403);
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Licença vencida',
        'data_fim' => $data['data_fim']
    ]);
    exit;
}

// =========================
// Licença válida
// =========================
echo json_encode([
    'status' => 'ok',
    'licenca' => 'ativa',
    'cliente' => [
        'id' => $data['cliente_id'],
        'nome' => $data['nome'],
        'subdominio' => $data['subdominio']
    ],
    'plano' => $data['plano'],
    'periodo' => [
        'inicio' => $data['data_inicio'],
        'fim' => $data['data_fim']
    ]
]);
