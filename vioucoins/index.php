<?php
ini_set('display_errors','off');
session_start();
include('../includes/config.php');
$name = $bdd->prepare('SELECT * FROM settings WHERE id = ?');
$name->execute(array(1));
$name = $name->fetch();
if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['name']); ?></title>
    <meta name="description" content="<?php echo $name['description']; ?>">
    <meta name="author" content="<?php echo $name['auteur']; ?>" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background: -webkit-gradient(linear,left top,left bottom,from(#000),to(#0e0e0e))">
        <a class="navbar-brand" href="../index.php"><img id="logo" src="../assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../actu/index.php">Actu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../maps">Maps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Tournois</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link go-premium" href="../premium/">Premium</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../shop/">Boutique</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../vioucoins/">Vioucoins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../team/">Équipe</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <i class="fas fa-search" style="color: #f3f3f3; margin-right: 5px"></i>
                <input id="search" type="search" disabled placeholder="Rechercher...">
                <?php if(!isset($_SESSION['id'])) { ?>
                    <button onclick="location.href='../account/login'" id="login">Inscription/Connexion</button>
                <?php } else { ?>
                    <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="login"><?php echo $user['identifiant']; ?></button>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <?php if($user['admin'] == 1) { ?>
                            <a class="dropdown-item" href="../admin/">Admnistration</a>
                        <?php } ?>
                        <a class="dropdown-item" href="#">Mon Compte</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../account/logout">Se déconnecter</a>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </nav>

    <main>
        <div class="container mt-4">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">ViouCoins</h1>
                    <p class="lead">Gagne des ViouCoins en remplissant différentes types de tâches et achète des articles depuis la boutique !</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Tous</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vidéos</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Réseaux Sociaux</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 mb-5">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://www.tipeeestream.com/img/tipeeestream-preview.jpg" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">TipeeeStream</h5>
                                                <p class="card-text">Gagne des ViouCoins en regardant de courte vidéos pendant une minute!</p>
                                                <h5>3 Vioucoins/vidéo</h5>
                                                <button class="btn btn-primary btn-block mt-3">Voir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://www.youtube.com/img/desktop/yt_1200.png" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">YouTube</h5>
                                                <p class="card-text">Abonne-toi à la chaîne YouTube de <b>Segali</b> et gagne des Vioucoins (connexion à YouTube requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://images-eu.ssl-images-amazon.com/images/I/21kRx-CJsUL.png" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Twitch</h5>
                                                <p class="card-text">Abonne-toi à la chaîne Twitch de <b>segali_ytb</b> et gagne des Vioucoins (connexion à Twitch requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://ressources.blogdumoderateur.com/2018/06/logo-instagram.jpg" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Instagram</h5>
                                                <p class="card-text">Abonne-toi au compte Instagram de <b>vioume_corp2</b> et gagne des Vioucoins (connexion à Twitch requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card mb-3">
                                        <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src="https://www.tipeeestream.com/img/tipeeestream-preview.jpg" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">TipeeeStream</h5>
                                                        <p class="card-text">Gagne des ViouCoins en regardant de courte vidéos pendant une minute!</p>
                                                        <h5>3 Vioucoins/vidéo</h5>
                                                        <button class="btn btn-primary btn-block mt-3">Voir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://www.youtube.com/img/desktop/yt_1200.png" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">YouTube</h5>
                                                <p class="card-text">Abonne-toi à la chaîne YouTube de <b>Segali</b> et gagne des Vioucoins (connexion à YouTube requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://images-eu.ssl-images-amazon.com/images/I/21kRx-CJsUL.png" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Twitch</h5>
                                                <p class="card-text">Abonne-toi à la chaîne Twitch de <b>segali_ytb</b> et gagne des Vioucoins (connexion à Twitch requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://ressources.blogdumoderateur.com/2018/06/logo-instagram.jpg" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Instagram</h5>
                                                <p class="card-text">Abonne-toi au compte Instagram de <b>vioume_corp2</b> et gagne des Vioucoins (connexion à Twitch requise) !</p>
                                                <h5>10 Vioucoins</h5>
                                                <button class="btn btn-primary btn-block mt-3">S'abonner</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </main>

    <footer>
        <div class="social_networks">
            <div class="row" style="margin:0;">

                <a target="__blank" class="col discord" href="https://discord.gg/BZYUgpR">
                    <i class="fab fa-2x fa-discord"></i>
                </a>


                <a target="__blank" href="https://www.youtube.com/channel/UC-o7GvxcarI7TjOr4iWWflA" class="col youtube">
                    <i class="fab fa-2x fa-youtube"></i>
                </a>

                <a target="__blank" href="https://www.twitch.tv/segali_ytb" class="col twitch">
                    <i class="fab fa-2x fa-twitch"></i>
                </a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>