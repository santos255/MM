<?php
require_once "../bd/conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email_usuario  = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Este email já está cadastrado.";
    } else {
        // Insere o usuário no banco
        $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email_usuario , senha_usuario) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        echo "Sing in successfully!";

    }
}
?>
<br>
<a href="../index.php">Back to Login</a>
