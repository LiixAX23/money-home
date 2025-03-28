<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>🎉 Cadastro realizado com sucesso, <?= htmlspecialchars($_SESSION['nome']); ?>!</h1>
        <p class="highlight-text">📩 Em breve você receberá no seu e-mail o link de acesso para começar a lucrar!</p>
        <p class="urgent-text">📘 Junto com o link, enviaremos também um manual explicativo simples e direto para te guiar nesse processo.</p>
        <p class="highlight-text">🚀 Fique atento ao seu e-mail! Você pode começar a faturar ainda hoje com o Projeto Lucre em Casa com Instagram!</p>
        <a href="logout.php" class="btn-sair">🚪 Sair</a>
    </div>
</body>
</html>

