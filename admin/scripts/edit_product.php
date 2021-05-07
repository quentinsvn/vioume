<?php
        ini_set('display_errors','off');
        $mode_edition = 0;
        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit = $bdd->prepare('SELECT * FROM products WHERE id = ?');
            $edit->execute(array($edit_id));
            if($edit->rowCount() == 1) {
                $edit = $edit->fetch();
            } else {
                die('Erreur : l\'utilisateur n\'existe pas...');
            }
        }
        
        if($mode_edition == 1) {
            if(isset($_POST['confirm'])) {
                $title = htmlspecialchars($_POST['name']);
                $description = htmlspecialchars($_POST['description']);
                $price = htmlspecialchars($_POST['price']);

                $update = $bdd->prepare('UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?');
                $update->execute(array($title, $description, $price, $edit_id));
                header('Location: ../index.php');
            }
        }
?>