<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
    rel="stylesheet"
    />
    <!-- MY CSS -->
    <link
    href="../Assets/css/style.css"
    rel="stylesheet"
    />
</head>
<body>

    <!-- HEADER  -->
    <header class="container mb-5 mt-2 sticky-top">
        <nav class="navbar rounded navbar-expand-lg navbar-dark bg-dark d-flex justify-content-around align-items-center shadow">
            <div class="container-fluid px-4">
                <a href="index.php" class="navbar-brand"><i class="fas fa-adjust me-2"></i>WORLD INFOS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item  mx-3">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">infos</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">contact</a>
                    </li>
                    <li class="nav-item mx-3 pe-4" style="min-width:fit-content">
                        <a class="btn btn-danger <?= ($_GET['page'] == 'admin') ? 'disabled' : '' ?>" href="index.php?page=admin"><i class="fas fa-lock me-2"></i> Administration</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- MAIN  -->
    <main>
    <?= include "../views/$path"; ?> <!-- Appel de la vue -->
    </main>

    <!-- JS -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js">
    </script>
    <!-- My JS  -->
    <script src="../Assets/js/app.js"></script>
</body>
</html>

