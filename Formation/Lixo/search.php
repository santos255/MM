



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Dinâmica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Busca Dinâmica no Banco de Dados</h2>
    <input type="text" id="search" class="form-control" placeholder="Digite um nome...">
    
    <ul id="result" class="list-group mt-3"></ul>
</div>

<script>
$(document).ready(function() {
    $("#search").on("keyup", function() {
        let query = $(this).val();
        
        if (query.length > 0) {
            $.ajax({
                url: "",
                method: "POST",
                data: { search: query },
                success: function(data) {
                    $("#result").html(data);
                }
            });
        } else {
            $("#result").html(""); // Limpa a lista quando não há texto
        }
    });
});
</script>


<?php
// Conectar ao banco de dados
$conn = new PDO("mysql:host=localhost;dbname=formation", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['search'])) {
    $search = "%" . $_POST['search'] . "%"; // Prepara para busca parcial

    // Consulta ao banco de dados
    $stmt = $conn->prepare("SELECT * FROM operator WHERE name_operator LIKE :search LIMIT 10");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($resultados as $row) {
            echo "<li class='list-group-item'>" . htmlspecialchars($row['name_operator']) . " - " . htmlspecialchars($row['email_operator']) . "</li>";
        }
    } else {
        echo "<li class='list-group-item text-danger'>Nenhum resultado encontrado</li>";
    }
}
?>


</body>
</html>
