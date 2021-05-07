<?php
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);

        $articles = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
        $articles->execute(array($get_id));

        if($articles->rowCount() == 1) {
            $articles = $articles->fetch();
            $title = $articles['title'];
            $content = $articles['content'];
            $author = $articles['author'];
            $date_article = $articles['date_article'];
            $miniature = $articles['miniature'];
        } else {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
?>