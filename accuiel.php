<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches des Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f1f1f1;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .status-working {
            color: green;
        }
        .status-free {
            color: red;
        }
        .carousel-inner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
       
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = document.getElementById('carouselExampleIndicators');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 3000, // Change every 3 seconds
                pause: 'hover'
            });
        });
    </script>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Stryve Solutions
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="projets.php">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="taches.php">Tâches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rapports.php">Rapports</a>
                    </li>
                </ul>
                <form class="d-flex" method="GET" action="">
                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
                <button class="btn btn-outline-success ms-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Se Connecter</button>
            </div>
        </div>
    </nav> 

    <!-- Modal de Connexion -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion Employé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" >
                        <div class="mb-3">
                            <label for="email" class="form-label">login</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="pwd" required>
                        </div>
                        <button type="submit"  name="ok" class="btn btn-primary">Se Connecter</button>
                    </form>
                    <?php 
   		if (isset($_POST['ok'])){
			$conn = new mysqli('localhost', 'root', '', 'gestionemployee');
			$login=$_POST['nom'];
			$pwd=$_POST['pwd'];

			$req="SELECT * FROM `utilisateurs` WHERE  nom='$login' and pwd='$pwd'";
			$res=$conn->query($req);
			$data=$res->fetch_assoc();
			if ($data){
				$_SESSION['nom']=$data['nom'];
				header('location:accuiel.php');
			}else{
				echo '<center>Login ou mot de passe sont incorrectes</center>';
			}
   		}
   		
    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h1 class="text-center">Stryve Solutions</h1>

        <!-- Carrousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/img1.png" class="d-block w-100" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="img/img4.png" class="d-block w-100" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="img/img0.jpeg" class="d-block w-100" alt="Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Profils des employés -->
        <div class="row mt-4" id="employee-profiles">
            <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "", "gestionemployee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête pour récupérer les employés
            $sql = "SELECT * FROM `utilisateurs`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $statusClass = $row['statut'] === 'working' ? 'status-working' : 'status-free';
                    echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <img src="img/' . $row['img'] . '" class="card-img-top profile-img" alt="' . $row['nom'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['nom'] . ' ' . $row['prenom'] . '</h5>
                                    <p class="card-text ' . $statusClass . '">' . $row['statut'] . '</p>';
                    if ($row['statut'] === 'working') {
                        echo '<p class="card-text"><strong>Projet:</strong> ' . $row['project'] . '</p>
                              <a href="detail.php?id=' . $row['IdUtl'] . '" class="btn btn-primary">Voir Détails</a>';
                    } else {
                        echo '<form method="GET" action="add.php">
                                  <input type="hidden" name="employeeId" value="' . $row['IdUtl'] . '">
                                  <button type="submit" class="btn btn-secondary">Ajouter un projet</button>
                              </form>';
                    }
                    echo '</div>
                        </div>
                    </div>';
                }
            }
?>
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



