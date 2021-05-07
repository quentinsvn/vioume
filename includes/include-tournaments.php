<?php
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);

        $tournois = $bdd->prepare("SELECT * FROM tournaments WHERE id = ?");
        $tournois->execute(array($get_id));

        if($tournois->rowCount() == 1) {
            $tournois = $tournois->fetch();
            $date_publish = $tournois['date_publish'];
            $date_tournament = $tournois['date_tournament'];
            $miniature = $tournois['miniature'];
            $participants = $tournois['participants'];
            $author = $tournois['author'];
            $namet = $tournois['name'];
            $description = $tournois['description'];
            $mode = $tournois['mode'];
            $cashprice = $tournois['cashprice'];

        } else {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
?>