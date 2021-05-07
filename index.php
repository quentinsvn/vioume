<?php
ini_set('display_errors','off');
session_start();
include('includes/config.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['name']); ?></title>
    <meta name="description" content="<?php echo $name['description']; ?>">
    <meta name="author" content="<?php echo $name['auteur']; ?>" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"
        style="background: -webkit-gradient(linear,left top,left bottom,from(#000),to(#0e0e0e))">
        <a class="navbar-brand" href="index.php"><img id="logo" src="assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="actu/">Actu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="maps/">Maps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tournaments/">Tournois</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link go-premium" href="premium/">Premium</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop/">Boutique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vioucoins/">Vioucoins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="team/">Équipe</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <i class="fas fa-search" style="color: #f3f3f3; margin-right: 5px"></i>
                <input id="search" type="search" disabled placeholder="Rechercher...">
                <?php if(!isset($_SESSION['id'])) { ?>
                    <button onclick="location.href='account/login'" id="login">Inscription/Connexion</button>
                <?php } else { ?>
                    <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="login"><?php echo $user['identifiant']; ?></button>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <?php if($user['admin'] == 1) { ?>
                            <a class="dropdown-item" href="admin/">Admnistration</a>
                        <?php } ?>
                        <a class="dropdown-item" href="#">Mon Compte</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="account/logout">Se déconnecter</a>
                    </div>
                <?php } ?>   
            </div>
        </div>
    </nav>

    <main>
        <div class="container content_website">
            <h1>LA REFERENCE EN MODE <span style="color: #ff5100">CRÉATIF</span></h1>
            <p>Rejoignez la communauté <b>Vioume</b> !</p>
            <div class="row mt-5 mb-5">
                <div class="col-12 col-xl-4">
                    <a href="maps/">
                       <div class="card_home">
                            <div class="text-light bg-trans play-card pb-5 mb-4 buildfight card-mode">
                                <div class="text-card p-1">
                                    <h2 class="text-center font-italic pt-1 title-card">MAPS</h2><small
                                        class="grey font-weight-light"> Jouer à plusieurs avec vos amis sur nos nombreuses maps créer par notre communauté ! </small>
                                </div>
                            </div>
                        </div> 
                    </a>
                    
                    
                </div>
                <div class="col-12 col-xl-4">
                    <a href="tournaments/">
                        <div class="text-light bg-trans play-card pb-5 mb-4 tournois card-mode">
                            <div class="text-card p-1">
                                <h2 class="text-center font-italic pt-1 title-card">TOURNOIS</h2><small
                                    class="grey font-weight-light"> Participez à nos nombreux tournois, sortez vainqueur et soyez récompensé !</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-xl-4">
                    <a href="shop/">
                        <div class="text-light bg-trans play-card pb-5 mb-4 boutique card-mode">
                            <div class="text-card p-1">
                                <h2 class="text-center font-italic pt-1 title-card">BOUTIQUE</h2><small
                                    class="grey font-weight-light"> Découvrez notre boutique d'objets et de jeux !</small>
                            </div>
                        </div>
                    </a>
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
    <video muted id="bgvid" playsinline autoplay muted loop>
        <source src="assets/videos/fond.mp4" type="video/mp4">

    </video>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>