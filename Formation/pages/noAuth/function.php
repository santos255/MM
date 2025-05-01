<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
<?php
include '../../bd/conn.php';
$variavel = $_GET['act'];

if ($variavel == 'creat') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //covert primeira letra em maiuscula e acentos
        $nome = mb_convert_case($_POST['nome'], MB_CASE_TITLE, "UTF-8");
        $lname = mb_convert_case($_POST['lnome'], MB_CASE_TITLE, "UTF-8");
        $email = $_POST['email'];



        //see if this reg existe on the bd
        $stmt = $conn->prepare("SELECT COUNT(*) FROM operator WHERE name_operator = ? and email_operator = ?");
        $stmt->execute([$nome, $email]);
        $count = $stmt->fetchColumn();


        if ($count > 0) {
            echo "<script>
                 alert('This Operator already exists!');
                 window.location.href = 'dashboard.php?pag=operador.php';
                </script>";
            exit; // Impede que o PHP continue processando
        } else {
            $stmt = $conn->prepare("INSERT INTO operator (name_operator, lastname_operator, email_operator) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $lname, $email]);
            echo "<script>
                 alert('Operator inserted successfully!');
                 window.location.href = 'dashboard.php?pag=operador.php';
                </script>";
            exit;
        }
    } else {
        echo "<script>
                 alert('Error!');
                 window.location.href = 'dashboard.php?pag=operador.php';
                </script>";
        exit;
    }
} elseif ($variavel == 'del') {
    $id = $_GET['id'];
    echo $id;
    $stmt = $conn->prepare("DELETE FROM operator WHERE id_operator  = ?");
    $stmt->execute([$id]);
    echo "<script>
                  alert('Operator deleted successfully!');
                  window.location.href = 'dashboard.php?pag=operador.php';
                 </script>";
    exit;
} elseif ($variavel == 'edit') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM operator WHERE id_operator = ?");
    $stmt->execute([$id]);
    $operator = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        echo $status;

        $stmt = $conn->prepare("UPDATE operator SET name_operator = ?, lastname_operator = ?, email_operator = ?, status_operator = ? WHERE id_operator = ?");
        $stmt->execute([$name,$lname, $email,$status,$id]);

        echo "<script>
                 alert('Operator Edited successfully!');
                 window.location.href = 'dashboard.php?pag=operador.php';
                </script>";
            exit;
    }
    ?>
        <h2>Editar Usuário</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($operator['name_operator']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Last Nome</label>
            <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($operator['lastname_operator']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($operator['email_operator']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Status</label>            
            <div>
                <input type="radio" id="Act" name="status" value="1" <?php if ($operator['status_operator'] == 1) echo 'checked'; ?>> Active
                &nbsp;
                <input type="radio" id="Des" name="status" value="2" <?php if ($operator['status_operator'] == 2) echo 'checked'; ?>> Desactive
            </div>          
            
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="dashboard.php?pag=operador.php" class="btn btn-secondary">Voltar</a>
    </form>
<?php
}elseif ($variavel == 'des') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE operator SET status_operator = 2 WHERE id_operator = ?");
    $stmt->execute([$id]);
    echo "<script>
                  alert('Operator desactivated successfully!');
                  window.location.href = 'dashboard.php?pag=operador.php';
                 </script>";
    exit;
}


?>
