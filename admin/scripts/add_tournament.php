<?php

if (isset($_POST['confirm'])) {
    if (!empty($_POST['date_tournoi']) and !empty($_POST['participants']) and !empty($_POST['name']) and !empty($_POST['description']) and !empty($_POST['mode']) and !empty($_POST['cashprice'])) {
        if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {

                    $date_tournoi = htmlspecialchars($_POST['date_tournoi']);
                    $participants = htmlspecialchars($_POST['participants']);
                    $name = htmlspecialchars($_POST['name']);
                    $description = htmlspecialchars($_POST['description']);
                    $mode = htmlspecialchars($_POST['mode']);
                    $cashprice = htmlspecialchars($_POST['cashprice']);

                    $insert = $bdd->prepare('INSERT INTO tournaments(date_tournament, participants, author, name, description, mode, cashprice) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $insert->execute(array($date_tournoi, $participants, $_SESSION['identifiant'], $name, $description, $mode, $cashprice));
                    $lastid = $bdd->lastInsertId();
                    /* Miniature */
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                            $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/tournaments/' . $lastid . '.jpg';
                            $filename = $lastid . '.jpg';
                            $size = filesize($filename);
                            if ($size < 0) {
                                move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                            }             
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }
            
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 3) {
                        $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/tournaments/' . $lastid . '.png';
                        $filename = $lastid . '.png';
                        move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }

                    $update = $bdd->prepare('UPDATE tournaments SET miniature = ? WHERE id= ?');
                    $update->execute(array($filename, $lastid));
                    header('Location: ../index.php');
        } else {
            $message = '<div class="alert alert-danger" role="alert">
        Veuillez choisir une image de présentation !
      </div>';
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">
        Veuillez remplir tous les champs !
      </div>';
    }
}


?>