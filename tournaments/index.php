<?php
ini_set('display_errors','off');
session_start();
include('../includes/config.php');
$name = $bdd->prepare('SELECT * FROM settings WHERE id = ?');
$name->execute(array(1));
$name = $name->fetch();

$tournois = $bdd->query('SELECT * FROM tournaments');
$tournois2 = $bdd->query('SELECT * FROM tournaments');
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Tournois</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link go-premium" href="../premium/">Premium</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../shop/">Boutique</a>
                </li>
                <li class="nav-item">
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
            <div class="row">
                <div class="col-md-8">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">En cours</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Terminés</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <?php while($t = $tournois->fetch()) { 
                                $phpdate = strtotime($t['date_tournament']);
                                $t['date_publish'] = date( 'd/m/Y', $phpdate );
                                // date à tester :
                                $now = date('Y-m-d H:m:s');
                                $next = $t['date_tournament'];
                                if($now <= $next) {
                            ?>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="../assets/uploads/tournaments/<?php echo $t['miniature'] ?>" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $t['name'] ?></h5>
                                            <p class="card-text"><?php echo $t['description'] ?></p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Date : <?php echo date("d/m/Y H:m", strtotime($t['date_tournament'])); ?></li>
                                                <li class="list-group-item">Participants : 0/<?php echo $t['participants'] ?></li>
                                                <li class="list-group-item">Mode : <?php echo $t['mode'] ?></li>
                                                <li class="list-group-item">Récompense : <?php echo $t['cashprice'] ?></li>
                                            </ul>
                                            <div class="float-right mb-3">
                                                <a href="details/index.php?id=<?php echo $t['id'] ?>" class="btn btn-primary">Participer</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                        <div class="tab-pane fade mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <?php while($t2 = $tournois2->fetch()) { 
                                $phpdate2 = strtotime($t2['date_tournament']);
                                $t2['date_publish'] = date( 'd/m/Y', $phpdate2 );
                                // date à tester :
                                $now2 = date('Y-m-d H:m:s');
                                $next2 = $t2['date_tournament'];
                                if($now2 >= $next2) {
                            ?>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="../assets/uploads/tournaments/<?php echo $t2['miniature'] ?>" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $t2['name'] ?></h5>
                                            <p class="card-text"><?php echo $t2['description'] ?></p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Date : <?php echo date("d/m/Y H:m", strtotime($t2['date_tournament'])); ?></li>
                                                <li class="list-group-item">Participants : 0/<?php echo $t2['participants'] ?></li>
                                                <li class="list-group-item">Mode : <?php echo date("H:m", strtotime($t2['date_tournament'])); ?></li>
                                                <li class="list-group-item">Récompense : <?php echo $t2['cashprice'] ?></li>
                                            </ul>
                                            <div class="float-right mb-3">
                                                <a href="#" class="btn btn-primary">Participer</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            Rechercher
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">@</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Rechercher" aria-label="Username" aria-describedby="addon-wrapping">
                                    <button type="submit" style="display: none;"></button>
                                </div>
                            </form>
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