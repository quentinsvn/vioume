<?php
        ini_set('display_errors','off');
        $mode_edition = 0;
        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit = $bdd->prepare('SELECT * FROM maps WHERE id = ?');
            $edit->execute(array($edit_id));
            if($edit->rowCount() == 1) {
                $edit = $edit->fetch();
            } else {
                die('Erreur : la map n\'existe pas...');
            }
        }
        
        if($mode_edition == 1) {
            if(isset($_POST['confirm'])) {
                $name = htmlspecialchars($_POST['name']);
                $code = htmlspecialchars($_POST['code']);
                $description = htmlspecialchars($_POST['description']);
                $participants = htmlspecialchars($_POST['participants']);

                $update = $bdd->prepare('UPDATE maps SET name = ?, code = ?, description = ?, participants = ? WHERE id = ?');
                $update->execute(array($name, $code, $description, $participants, $edit_id));
                header('Location: ../index.php');
            }
        }
?>