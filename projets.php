<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
             margin: 0 10px;
         }
        body{
        background-color: #999;
        }
        .card-body ul {
            list-style-type: none;
            padding: 0;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
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
                <li class="nav-item active">
                    <a class="nav-link" href="projets.php">Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taches.php">Tâches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rapport.php">Rapports</a>
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
        <div class="row">
            <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les projets
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT * FROM projets WHERE nompjt LIKE '%$search%' OR  description  LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($project = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">' . $project['nompjt'] . '</h5>
                                    <p class="card-text">' . $project['description'] . '</p>';

                    // Requête pour récupérer les tâches du projet
                    $projectId = $project['Idpjt'];
                    $taskSql = "SELECT * FROM taches WHERE Idpjt = $projectId";
                    $taskResult = $conn->query($taskSql);

                    if ($taskResult->num_rows > 0) {
                        echo '<ul>';
                        while($task = $taskResult->fetch_assoc()) {
                            echo '<li>
                                    <strong>' . $task['nomtch'] . '</strong> - Début: ' . $task['dateD'] . ', Fin: ' . $task['dateF'] . '
                                  </li>';
                        }
                        echo '</ul>';
                    }

                    // Calcul du temps passé sur le projet terminé
                    if ($project['statut'] === 'finished') {
                        $totalTimeSql = "SELECT SUM(TIMESTAMPDIFF(HOUR, dateD, dateF)) AS total_time FROM taches WHERE Idpjt = $projectId";
                        $totalTimeResult = $conn->query($totalTimeSql);
                        if ($totalTimeResult->num_rows > 0) {
                            $totalTime = $totalTimeResult->fetch_assoc()['total_time'];
                            echo '<p>Temps total passé: ' . $totalTime . ' heures</p>';
                        }
                    }

                    echo '      </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p>Aucun projet trouvé.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Gestion des Tâches. Tous droits réservés.</p>
        <p>Contactez-nous: contact@gestiondestaches.com</p>
        <p>Adresse: 123 Rue de l'Entreprise, 75000 Paris, France</p>
    </footer>

    <!-- Liens vers les fichiers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
