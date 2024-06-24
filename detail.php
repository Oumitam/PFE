<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Projet</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
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
                    <a class="nav-link" href="index.php">Accueil</a>
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="button">Se Connecter</button>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="container mt-4">
        <?php
        if (isset($_GET['id'])) {
            $employeeId = $_GET['id'];

            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les détails du projet
            $sql = "SELECT p.nompjt AS project_name, t.nomtch AS task_name, t.dateD, t.dateF, e.nom AS developer
                    FROM projes p
                    JOIN taches t ON p.Ipjt = t.Idpjt
                    JOIN utilisateurs e ON t.IdUtl= e.IdUtl
                    WHERE e.IdUtl = $employeeId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $projectDetails = $result->fetch_assoc();
                echo '<div class="card mb-4">
                        <div class="card-header">
                            Détails du Projet: ' . $projectDetails['nompjt'] . '
                        </div>
                        <div class="card-body">
                            <ul>';
                do {
                    echo '<li>
                            <strong>' . $projectDetails['nomtch'] . '</strong> - Début: ' . $projectDetails['dateD'] . ', Fin: ' . $projectDetails['dateF'] . ', Développeur: ' . $projectDetails['nom'] . '
                          </li>';
                } while ($projectDetails = $result->fetch_assoc());
                echo '    </ul>
                        </div>
                      </div>';
            } else {
                echo '<p>Aucun détail de projet trouvé pour cet employé.</p>';
            }

            $conn->close();
        } else {
            echo '<p>Identifiant de l\'employé non fourni.</p>';
        }
        ?>
    </div>

    <!-- Liens vers les fichiers Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
