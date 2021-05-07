<?php

if (isset($_POST['confirm'])) {
    if (!empty($_POST['name']) and !empty($_POST['code']) and !empty($_POST['description'])) {
        if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                    $name = htmlspecialchars($_POST['name']);
                    $description = htmlspecialchars($_POST['description']);
                    $code = htmlspecialchars($_POST['code']);
                    $participants = htmlspecialchars($_POST['participants']);
                    $insert = $bdd->prepare('INSERT INTO maps(author, code, name, description, participants) VALUES (?, ?, ?, ?, ?)');
                    $insert->execute(array($_SESSION['identifiant'], $code, $name, $description, $participants));
                    $lastid = $bdd->lastInsertId();
                    /* Miniature */
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                            $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/maps/' . $lastid . '.jpg';
                            $filename = $lastid . '.jpg';
                            $size = filesize($filename);
                            if ($size < 0) {
                                move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                            }             
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }
            
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 3) {
                        $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/maps/' . $lastid . '.png';
                        $filename = $lastid . '.png';
                        move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }

                    $update = $bdd->prepare('UPDATE maps SET miniature = ? WHERE id= ?');
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