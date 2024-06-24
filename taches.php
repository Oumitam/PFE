<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .task-card {
            transition: transform 0.3s ease-in-out;
        }
        .task-card:hover {
            transform: scale(1.05);
        }
        .status-complete {
            color: green;
        }
        .status-in-progress {
            color: orange;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
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
                    <a class="nav-link" href="accuiel.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projets.php">Projets</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="taches.php">Tâches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rapports.php">Rapports</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="projects.php">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher un projet" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
            </form>
            <button class="btn btn-outline-success my-2 my-sm-0" type="button">Se Connecter</button>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="container mt-4">
        <h2 class="mb-4">Liste des Tâches</h2>
        <div class="row">
            <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les tâches
            $sql = "SELECT t.nomtch, t.description, t.statut, t.dateD, t.dateF, u.nom AS developer, p.nompjt AS project_name
                    FROM taches t
                    JOIN utilisateurs u ON t.IdUtl = u.IdUtl
                    JOIN projets p ON t.Idpjt = p.Idpjt";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $statusClass = $row['statut'] === 'terminee' ? 'status-complete' : 'status-in-progress';
                    echo '<div class="col-md-4">
                            <div class="card task-card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['nomtch'] . '</h5>
                                    <p class="card-text">' . $row['descriptiontch'] . '</p>
                                    <p class="card-text ' . $statusClass . '">Statut: ' . $row['statut'] . '</p>
                                    <p class="card-text">Développeur: ' . $row['developer'] . '</p>
                                    <p class="card-text">Projet: ' . $row['project_name'] . '</p>
                                    <p class="card-text">Début: ' . $row['dateD'] . '</p>
                                    <p class="card-text">Fin: ' . $row['dateF'] . '</p>
                                </div>
                            </div>
                          </div>';
                }
            } else {
                echo '<p>Aucune tâche trouvée.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-center">
        <p>© 2024 Gestion des Tâches des Employés. Tous droits réservés.</p>
    </div>

    <!-- Scripts Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
