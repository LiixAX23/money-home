<?php
// Informações do banco de dados
$host = 'sql10.freesqldatabase.com';           // No seu caso, como está usando local, é localhost
$dbname = 'sql10769891';       // Nome do seu banco de dados
$user = 'sql10769891';                // Usuário padrão do MariaDB no local
$password = 'l4KISeAg8i';                // Senha do banco (em branco se não definiu)

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida!"; // Pode comentar ou remover
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

