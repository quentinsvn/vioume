<?php
        ini_set('display_errors','off');
        $mode_edition = 0;
        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit = $bdd->prepare('SELECT * FROM tournaments WHERE id = ?');
            $edit->execute(array($edit_id));
            if($edit->rowCount() == 1) {
                $edit = $edit->fetch();
            } else {
                die('Erreur : le tournoi n\'existe pas...');
            }
        }
        
        if($mode_edition == 1) {
            if(isset($_POST['confirm'])) {
                $date_tournoi = htmlspecialchars($_POST['date_tournoi']);
                $participants = htmlspecialchars($_POST['participants']);
                $name = htmlspecialchars($_POST['name']);
                $description = htmlspecialchars($_POST['description']);
                $mode = htmlspecialchars($_POST['mode']);
                $cashprice = htmlspecialchars($_POST['cashprice']);

                $update = $bdd->prepare('UPDATE tournaments SET date_tournament = ?, participants = ?, name = ?, description = ?, mode = ?, cashprice = ? WHERE id = ?');
                $update->execute(array($date_tournoi, $participants, $name, $description, $mode, $cashprice, $edit_id));
                header('Location: ../index.php');
            }
        }
?>