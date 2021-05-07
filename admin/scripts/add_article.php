<?php

if (isset($_POST['confirm'])) {
    if (!empty($_POST['title']) and !empty($_POST['content'])) {
        if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                    $title = htmlspecialchars($_POST['title']);
                    $content = htmlspecialchars($_POST['content']);
                    $insert = $bdd->prepare('INSERT INTO articles(author, title, content) VALUES (?, ?, ?)');
                    $insert->execute(array($_SESSION['identifiant'], $title, $content));
                    $lastid = $bdd->lastInsertId();
                    /* Miniature */
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                            $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/articles/' . $lastid . '.jpg';
                            $filename = $lastid . '.jpg';
                            $size = filesize($filename);
                            if ($size < 0) {
                                move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                            }             
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }
            
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 3) {
                        $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/articles/' . $lastid . '.png';
                        $filename = $lastid . '.png';
                        move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }

                    $update = $bdd->prepare('UPDATE articles SET miniature = ? WHERE id= ?');
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