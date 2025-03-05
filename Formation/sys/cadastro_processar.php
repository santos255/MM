<?php
require_once "../bd/conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $role = 3;// user_view

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email_usuario  = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Este email já está cadastrado.";
    } else {
        // Insere o usuário no banco
        $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email_usuario , senha_usuario, role) VALUES (:nome, :email, :senha, :role)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        echo "<script>
        alert('Sing-in Successfuly, please login!');
        window.location.href = '../index.php';
       </script>";

    }
}
?>
<br>
<a href="../index.php">Back to Login</a>
