<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? 'Musculation'; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/color-modes.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ms-2">
        <a class="navbar-brand fw-bold" href="/">Musculation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-2" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/exercices">Exercices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/performances">Performances</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Inscription</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thème
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="light">Clair</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="dark">Sombre</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-theme-value="auto">Système</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4 mb-5">
