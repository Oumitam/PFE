<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification - Stryve Solutions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="lg.css">
</head>
<body>
    <div class="bg-gradient">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <img src="img/logo.png" alt="Stryve Solutions" class="logo">
                    </div>
                    <div class="modal-content p-4">
                        <div class="row no-gutters">
                            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
                                <img src="img/img1.png" alt="Welcome" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <h3 class="display-4">Bienvenue dans Stryve Solutions</h3>
                                <p class="lead text-muted">Une description de votre entreprise peut être ici.</p>
                                <form method="POST" class="mt-4">
                                    <div class="form-group">
                                        <input type="text" name="nom" placeholder="Login" required class="form-control rounded-pill">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pwd" placeholder="Mot de passe" required class="form-control rounded-pill">
                                    </div>
                                    <button type="submit" name="ok" class="btn btn-primary btn-block rounded-pill">Connexion</button>
                                </form>
                                <?php
                                    if (isset($_POST['ok'])) {
                                        $conn = new mysqli('localhost', 'root', '', 'gestionemployee');
                                        $login = $_POST['nom'];
                                        $pwd = $_POST['pwd'];
                                        $req = "SELECT * FROM `utilisateurs` WHERE nom='$login' and pwd='$pwd'";
                                        $res = $conn->query($req);
                                        $data = $res->fetch_assoc();
                                        if ($data) {
                                            session_start();
                                            $_SESSION['nom'] = $data['nom'];
                                            header('location:accuiel.php');
                                        } else {
                                            echo '<div class="alert alert-danger mt-3">Login ou mot de passe sont incorrectes</div>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
