<!doctype html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Osobný blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Môj Osobný Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'index' ? 'active' : '' ?>" href="index.php">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'routes' ? 'active' : '' ?>" href="routes.php">Témy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'form' ? 'active' : '' ?>" href="form.php">Registrácia</a>
                    </li>
                    <!-- DOPLŇ: pridanie štvrtej položky menu Kontakt -->
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'contact' ? 'active' : '' ?>" href="contact.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h1><?= $title ?></h1>
        <?php include $content; ?>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> Mykhailo Perepichai. Všetky práva vyhradené.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
