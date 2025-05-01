<?php
include '../../bd/conn.php';

// Buscar usuários
$stmt = $conn->query("SELECT * FROM operator WHERE status_operator = 1");//1 actife - 2 Desactif
$operators = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="conteiner">
    <h2>Manage Operator</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ADD </button>
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Formation</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($operators as $operator): ?>
                <tr>

                    <td> <?= htmlspecialchars($operator['name_operator']) ?> </td>
                    <td> <?= htmlspecialchars($operator['lastname_operator']) ?> </td>
                    <td> <?= htmlspecialchars($operator['email_operator']) ?> </td>
                    <td> <a href="hpedit.p?id=<?= $operator['id_operator'] ?>" class="btn btn-info btn-sm">Formation</a> </td>
                    <td>

                        <a href="function.php?id=<?= $operator['id_operator'] ?>&act=edit" class="btn btn-primary btn-sm">Edit</a>                        
                        <a href="function.php?id=<?= $operator['id_operator'] ?>&act=del" class="btn btn-danger btn-sm" onclick="return confirm('Eliminate the Operator ?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    
    <div class="d-flex">    
        <div class="ms-auto text-white p-3 bg"> 
            <a href="desactiOperator.php">Desctivated</a>
        </div>    
       
    </div>

    




    <!-- Modal para adicionar Operadpor -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Operator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="function.php?act=creat">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Nome</label>
                            <input type="text" name="lnome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



</div>