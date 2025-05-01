<?php
include '../../bd/conn.php';

// Buscar usuários
$stmt = $conn->query("SELECT op.id_operator,op.name_operator,op.lastname_operator,op.email_operator,st.name_status 
FROM `operator` as op INNER JOIN status as st on st.id_status = op.status_operator 
WHERE op.status_operator = 2;"); //1 actife - 2 Desactif
$operators = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="conteiner mt-4">
        <div class="mt-4 p-4 bg-light border rounded">
        <h2>Desactive Operator</h2>
        <div class="conteiner">
        <a href="dashboard.php?pag=operador.php" class="btn btn-secondary">Back</a>

        </div>
        

        <table class="table table-bordered">
        
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($operators as $operator): ?>                   
                    <tr>
                        <td> <?= htmlspecialchars($operator['name_operator']) ?> </td>
                        <td> <?= htmlspecialchars($operator['lastname_operator']) ?> </td>
                        <td> <?= htmlspecialchars($operator['email_operator']) ?> </td>
                        <td> <?= htmlspecialchars($operator['name_status']) ?> </td>

                        
                        <td>

                            <a href="function.php?id=<?= $operator['id_operator'] ?>&act=edit" class="btn btn-primary btn-sm">Active</a>

                            <a href="function.php?id=<?= $operator['id_operator'] ?>&act=del" class="btn btn-danger btn-sm" onclick="return confirm('Eliminate the Operator ?')">Delete</a>
                           
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        </div>

        
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>