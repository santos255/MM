/*/************************** */
php para buscar
<?php



// Obter o valor da busca
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Buscar os produtos que contêm a palavra-chave
$sql = "SELECT * FROM operator WHERE nome LIKE '%$query%'";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card mb-2">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name_operator'] . '</h5>';
        echo '<p class="card-text">' . $row['lastname_operator'] . '</p>';
        echo '<p class="card-text"><strong>Preço:</strong> R$ ' . number_format($row['status'], 2, ',', '.') . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Nenhum produto encontrado.";
}

$conn->close();
?>



/*********html */

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Dinâmica com AJAX</title>
    <!-- Adicionando Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Busca Dinâmica de Produtos</h2>
        <input type="text" id="search" class="form-control" placeholder="Digite para buscar..." onkeyup="searchProducts()">
        
        <div id="results" class="mt-3"></div>
    </div>

    <!-- Scripts -->
    <script>
        function searchProducts() {
            var query = $('#search').val();
            $.ajax({
                url: ' ', // PHP que vai buscar os dados
                type: 'GET',
                data: {query: query},
                success: function(response) {
                    $('#results').html(response);
                }
            });
        }
    </script>
</body>
</html>
