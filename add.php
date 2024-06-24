<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Projet</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
      
        body {
            background-color: #999;
        }
    </style>
</head>
<body>
    <!-- Menu de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Gestion des Employés</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="accuiel.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employees.php">Employés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">Rapports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_project.php">Ajouter un Projet</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Ajouter un Projet</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Récupération des données du formulaire
            $employeeId = $_POST['employeeId'];
            $projectName = $_POST['project_name'];
            $projectDescription = $_POST['project_description'];

            // Insertion du nouveau projet
            $sql = "INSERT INTO projets (nompjt, description) VALUES ('$projectName', '$projectDescription')";
            if ($conn->query($sql) === TRUE) {
                $projectId = $conn->insert_id;

                // Mise à jour du statut de l'employé
                $updateSql = "UPDATE utilisateurs SET statut='working', project='$projectName' WHERE Idutl=$employeeId";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<div class='alert alert-success'>Projet ajouté avec succès.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Erreur de mise à jour du statut de l'employé.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Erreur d'ajout du projet: " . $conn->error . "</div>";
            }

            $conn->close();
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les employés disponibles
            $sql = "SELECT Idutl, nom FROM utilisateurs WHERE statut='free'";
            $result = $conn->query($sql);

            $conn->close();
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="employeeId">Sélectionnez un Employé:</label>
                <select class="form-control" id="employeeId" name="employeeId" required>
                    <?php
                    // Affichage des employés disponibles dans le menu déroulant
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["Idutl"] . "'>" . $row["nom"] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Aucun employé disponible</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="project_name">Nom du Projet:</label>
                <input type="text" class="form-control" id="project_name" name="project_name" required>
            </div>
            <div class="form-group">
                <label for="project_description">Description du Projet:</label>
                <textarea class="form-control" id="project_description" name="project_description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter Projet</button>
        </form>
    </div>

    <!-- Pied de page -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Gestion des Employés</h5>
                    <p>
                        Système de gestion des employés et des projets pour une organisation efficace et performante.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Liens Utiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="index.php" class="text-dark">Accueil</a>
                        </li>
                        <li>
                            <a href="employees.php" class="text-dark">Employés</a>
                        </li>
                        <li>
                            <a href="projects.php" class="text-dark">Projets</a>
                        </li>
                        <li>
                            <a href="reports.php" class="text-dark">Rapports</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-dark text-white">
            © 2024 Gestion des Employés. Tous droits réservés.
        </div>
    </footer>

    <!-- Liens vers les fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




