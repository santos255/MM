<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><img src="../../img/logo.png" alt="" srcset=""> <?php echo $_SESSION['usuario_nome']; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Formation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="operador.php">Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Statistique</a>
                </li>
                <li class="nav-item">
                <a href="../../logout.php" class="btn ">LogOut</a>
                </li>
            </ul>
        </div>
    </div>
</nav>