<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion des Tâches</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projets.php">Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taches.php">Tâches</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="rapports.php">Rapports</a>
                </li>
            </ul>
            <button class="btn btn-outline-success my-2 my-sm-0" type="button">Se Connecter</button>
        </div>
    </nav> 

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <!-- Formulaire de recherche -->
                <form class="form-inline my-2 my-lg-0" method="GET" action="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher un rapport ou un utilisateur" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Les rapports seront affichés ici -->
            <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les rapports en fonction de la recherche
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT * FROM rapports WHERE titre LIKE '%$search%' OR contenu LIKE '%$search%'
                    UNION
                    SELECT * FROM utilisateurs WHERE nom LIKE '%$search%' OR project LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['titre'] . '</h5>
                                    <p class="card-text">' . substr($row['contenu'], 0, 100) . '...</p>
                                    <a href="detailrapport.php?id=' . $row['id'] . '" class="btn btn-primary">Lire plus</a>
                                </div>
                            </div>
                          </div>';
                }
            } else {
                echo '<p>Aucun rapport trouvé.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Liens vers les fichiers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
