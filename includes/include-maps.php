<?php
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);

        $maps = $bdd->prepare("SELECT * FROM maps WHERE id = ?");
        $maps->execute(array($get_id));

        if($maps->rowCount() == 1) {
            $maps = $maps->fetch();
            $date_map = $maps['date_map'];
            $author = $maps['author'];
            $miniature = $maps['miniature'];
            $code = $maps['code'];
            $name_map = $maps['name'];
            $description = $maps['description'];
            $participants = $maps['participants'];
        } else {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
?>