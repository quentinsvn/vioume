<?php
        ini_set('display_errors','off');
        $mode_edition = 0;
        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
            $edit->execute(array($edit_id));
            if($edit->rowCount() == 1) {
                $edit = $edit->fetch();
            } else {
                die('Erreur : l\'utilisateur n\'existe pas...');
            }
        }
        
        if($mode_edition == 1) {
            if(isset($_POST['confirm'])) {
                $title = htmlspecialchars($_POST['title']);
                $content = htmlspecialchars($_POST['content']);

                $update = $bdd->prepare('UPDATE articles SET title = ?, content = ? WHERE id = ?');
                $update->execute(array($title, $content, $edit_id));
                header('Location: ../index.php');
            }
        }
?>