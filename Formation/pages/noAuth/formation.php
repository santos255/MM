<?php
include '../../bd/conn.php';

// Buscar usuários
$stmt = $conn->query("SELECT forc.id_formation,forc.name_formation,fort.name_formador, forc.duration_in_h_formation,cat.name_category, forc.type_formation,pt.name_post, forc.comment_formation FROM `formation` as forc INNER JOIN category as cat on cat.id_category = forc.category_formation inner JOIN formador as fort on fort.id_formador=forc.formator_formation INNER JOIN post as pt on pt.id_post = forc.post_conser_formation WHERE 1;");//1 actife - 2 Desactif
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="conteiner">
    <h2>Manage Operator</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ADD </button>
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Formation</th>
                <th>Formator</th>
                <th>Duration in H</th>
                <th>Category</th>
                <th>Type</th>
                <th>Post conserned</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation): ?>
                <tr>

                    <td> <?= htmlspecialchars($formation['name_formation']) ?> </td>

                    <td>
                        <a href=""data-bs-toggle="modal" data-bs-target="#staticBackdrop"><?= htmlspecialchars($formation['name_formador']) ?></a>
                        
                    </td>
                   

                    <td> <?= htmlspecialchars($formation['duration_in_h_formation']) ?>H </td>
                    <td> <?= htmlspecialchars($formation['name_category']) ?> </td>
                    <td> <?= htmlspecialchars($formation['type_formation']) ?> </td>
                    <td> <?= htmlspecialchars($formation['name_post']) ?> </td>
                    <td> <?= htmlspecialchars($formation['comment_formation']) ?> </td>
                   
                    <td>

                        <a href="function.php?id=<?= $formation['id_formation'] ?>&act=edit" class="btn btn-primary btn-sm">Edit</a>                        
                        <a href="function.php?id=<?= $formation['id_formation'] ?>&act=del" class="btn btn-danger btn-sm" onclick="return confirm('Eliminate the Operator ?')">Delete</a>
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

    




    <!-- Modal para detalhe do formador -->
     <?php
     ?>
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