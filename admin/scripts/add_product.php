<?php

if (isset($_POST['confirm'])) {
    if (!empty($_POST['name']) and !empty($_POST['description']) and !empty($_POST['price'])) {
        if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                    $title = htmlspecialchars($_POST['name']);
                    $description = htmlspecialchars($_POST['description']);
                    $price = htmlspecialchars($_POST['price']);
                    $insert = $bdd->prepare('INSERT INTO products(name, description, price) VALUES (?, ?, ?)');
                    $insert->execute(array($title, $description, $price));
                    $lastid = $bdd->lastInsertId();
                    /* Miniature */
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                            $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/products/' . $lastid . '.jpg';
                            $filename = $lastid . '.jpg';
                            $size = filesize($filename);
                            if ($size < 0) {
                                move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                            }             
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }
            
                    if (exif_imagetype($_FILES['miniature']['tmp_name']) == 3) {
                        $chemin = 'C:/xampp/htdocs/vioume/assets/uploads/products/' . $lastid . '.png';
                        $filename = $lastid . '.png';
                        move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                    } else {
                        $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                    }

                    $update = $bdd->prepare('UPDATE products SET miniature = ? WHERE id= ?');
                    $update->execute(array($filename, $lastid));
                    $message = "<div class='alert alert-success'>Produit publié avec succès!</div>";
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