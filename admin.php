<?php
require 'db.php';
session_start();

// Verificação simples para restringir o acesso (você pode trocar por uma verificação mais segura depois)
$acesso_liberado = true; // Mude para false para testar proteção

if (!$acesso_liberado) {
    echo "Acesso negado.";
    exit();
}

$stmt = $pdo->query("SELECT nome, instagram, email, senha_hash, data_criacao FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>👀 Lista de Usuários Cadastrados</h1>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; color:white;">
            <tr>
                <th>Nome</th>
                <th>Instagram</th>
                <th>Email</th>
                <th>Senha (hash)</th>
                <th>Data Cadastro</th>
            </tr>
            <?php foreach ($usuarios as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['nome']) ?></td>
                <td><?= htmlspecialchars($user['instagram']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['senha_hash']) ?></td>
                <td><?= htmlspecialchars($user['data_criacao']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br><a href="dashboard.php" class="btn-voltar">🔙 Voltar</a>
    </div>
</body>
</html>
