/*/************************** */
php para buscar<?php
// Conectar ao banco de dados
$conn = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Verifica se recebeu um termo de busca
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search = "%" . $_POST['search'] . "%";

    // Consulta ao banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome LIKE :search LIMIT 10");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibir resultados
    if ($stmt->rowCount() > 0) {
        foreach ($resultados as $row) {
            echo "<li class='list-group-item'>
                    <strong>Nome:</strong> " . htmlspecialchars($row['nome']) . " <br>
                    <strong>Email:</strong> " . htmlspecialchars($row['email']) . " <br>
                    <strong>Telefone:</strong> " . htmlspecialchars($row['telefone']) . "
                  </li>";
        }
    } else {
        echo "<li class='list-group-item text-danger'>Nenhum resultado encontrado</li>";
    }
    exit();
}
?>


/*********html */


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Dinâmica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Busca Dinâmica com PHP, MySQL e AJAX</h2>

        <!-- Campo de busca -->
        <input type="text" id="search" class="form-control" placeholder="Digite um nome..." autocomplete="off">

        <!-- Resultados da busca -->
        <ul id="result" class="list-group mt-3"></ul>
    </div>

    <script>
        $(document).ready(function() {
            let debounceTimer;
            
            $("#search").on("keyup", function() {
                clearTimeout(debounceTimer);
                let query = $(this).val();

                debounceTimer = setTimeout(function() {
                    if (query.length > 0) {
                        $.ajax({
                            url: "buscar.php",
                            method: "POST",
                            data: { search: query },
                            success: function(data) {
                                $("#result").html(data);
                            }
                        });
                    } else {
                        $("#result").html("");
                    }
                }, 500);
            });
        });
    </script>
</body>
</html>


Script