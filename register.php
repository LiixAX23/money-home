<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';
var_dump($_POST);

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    if (!$nome || !$instagram || !$email || !$senha) {
        $erro = "⚠️ Por favor, preencha todos os campos!";
    } else {
        try {
            // Verifica se o e-mail já está cadastrado
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $erro = "⚠️ Este E-mail já está cadastrado! Tente outro.";
            } else {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, instagram, email, senha_hash) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$nome, $instagram, $email, $senha_hash])) {
                    header("Location: cadastro_sucesso.php");
                    exit();
                } else {
                    $erro = "❌ Erro ao cadastrar. Tente novamente!";
                }
            }
        } catch (PDOException $e) {
            $erro = "Erro no Banco de Dados: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Erro ao Cadastrar</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
      <h1>🚨 Ops! Algo deu errado</h1>
      <p class="error-text"><?= $erro ?></p>
      <a href="cadastro.html" class="btn-voltar">🔄 Tentar Novamente</a>
  </div>
</body>
</html>
