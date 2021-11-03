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
    <!-- BOOTSTRAP -->
    <link href="https://bootswatch.com/5/litera/bootstrap.min.css" rel="stylesheet">
    <!-- MY CSS -->
    <link
    href="../Assets/css/style.css"
    rel="stylesheet"
    />
</head>
<body>

    <!-- HEADER  -->
    <header class="container mb-5 mt-2 sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><i class="fas fa-adjust me-2"></i>WORLD INFOS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="index.php?page=admin" class="btn btn-danger my-2 my-sm-0 <?= ($_GET['page'] == 'admin') ? 'disabled' : '' ?>" type="submit"><i class="fas fa-lock me-2"></i> Administration</a>
                </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN  -->
    <main>
    <?= include "../views/$path"; ?> <!-- Appel de la vue -->
    </main>

    <!-- My JS  -->
    <script src="../Assets/js/app.js"></script>
</body>
</html>

