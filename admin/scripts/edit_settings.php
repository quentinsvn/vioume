<?php      
            if(isset($_POST['confirm'])) {
                $name = htmlspecialchars($_POST['name']);
                $author = htmlspecialchars($_POST['auteur']);
                $description = htmlspecialchars($_POST['description']);

                $update = $bdd->prepare('UPDATE settings SET name = ?, auteur = ?, description = ? WHERE id = 1');
                $update->execute(array($name, $author, $description));
                header('Location: index.php');
            }
?>