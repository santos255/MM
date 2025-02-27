<?php
session_start();
require_once "../bd/conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email_usuario = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario  && password_verify($senha, $usuario['senha_usuario'])) {
        // Login bem-sucedido
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nome'] = $usuario['id_usuario'];
        if($usuario['stat'] == 1){
            header('Location: ../pages/administration/dashboard.php');
            
        }
        elseif($usuario['stat'] == 2){
            header('Location: ../pages/noAuth/dashboard.php');
        }
        else{
       
        header('Location: ../pages/dashboard.php');
        }
        exit;
    } else {
        echo "Email ou senha incorretos!";
    }
}
?>
