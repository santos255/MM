<?php
include_once '../../bd/conn.php';
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
                <a class="navbar-brand" href="#" onclick="carregarPagina('home.php')"><img src="../../img/logo.png" alt="" srcset=""><?php echo (" " . $_SESSION['usuario_nome']) ?></a>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="carregarPagina('home.php')">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="carregarPagina('formation.php')">Formation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="carregarPagina('operador.php')">Employers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="carregarPagina('estatistique.php')">Statistique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="carregarPagina('aboutPortal.php')">About the portal</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../logout.php" class="btn ">Log Out</a>

                        </li>
                    </ul>
                </div>
            </div>
            
        </nav>
       

       
        <?php

        if (isset($_GET['pag'])) {
            $pag = $_GET['pag']; // Definindo a variável $pag
            echo "<script>carregarPagina('$pag')</script>";
        } else {
            echo "<script>carregarPagina('home.php')</script>";
        }

        ?>

        <!-- Div onde a página será carregada -->
        <div id="conteudo" class="mt-4 p-4 bg-light border rounded">
            <?php include 'home.php'; ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>