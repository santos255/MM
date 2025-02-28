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
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="conteiner">
        <h2>Editar Operador</h2>
        <form method="POST" action="function.php?act=update">
            <input type="hidden" name="id" value="<?= $user['id_operator'] ?>">
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= $user['name_operator'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Last Nome</label>
                <input type="text" name="lnome" class="form-control" value="<?= $user['lastname_operator'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email_operator'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
<?php
}
?>