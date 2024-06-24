<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion des Tâches</title>
    <!-- Liens vers les fichiers Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion des Tâches</a>
        <!-- Bouton de navigation pour les petits écrans -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Tableau de Bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tâches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rapports</a>
                </li>
            </ul>
            <!-- Bouton de Connexion -->
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Se Connecter</button>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="container mt-4">
        <div class="row">
            <!-- Colonne pour le tableau de bord de l'administrateur -->
            <div class="col-md-6">
                <h2>Tableau de Bord de l'Administrateur</h2>
                <!-- Contenu de l'administration -->
                <!-- Ajoutez ici les cartes, tableaux et autres éléments -->
            </div>
            <!-- Colonne pour le tableau de bord de l'employé -->
            <div class="col-md-6">
                <h2>Tableau de Bord de l'Employé</h2>
                <!-- Contenu de l'employé -->
                <!-- Ajoutez ici les cartes, tableaux et autres éléments -->
            </div>
        </div>
    </div>

    <!-- Liens vers les fichiers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
