<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function carregarPagina(pagina) {
            fetch(pagina)
            .then(response => response.text())
            .then(data => {
                document.getElementById("conteudo").innerHTML = data;
            })
            .catch(error => console.error('Erro ao carregar a página:', error));
        }
    </script>
    
</head>
<body>
   
<div class="container mt-5">  
    <p>Esta é a área restrita do usuário comun.</p>   
</div>
<div class="container mt-4">
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Meu Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="carregarPagina('home.php')">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="carregarPagina('sobre.html')">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="carregarPagina('servicos.html')">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="carregarPagina('contato.html')">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Div onde a página será carregada -->
    <div id="conteudo" class="mt-4 p-4 bg-light border rounded">
        <h3>Bem-vindo!</h3>
        
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
