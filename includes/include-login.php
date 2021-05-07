<?php
    if(isset($_POST['login'])) {
        $id = htmlspecialchars($_POST['usernameEmail']);
        $password = sha1($_POST['mdp']);
        if(!empty($id) AND !empty($password)) {
            $requser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $requser->execute(array($id,$password));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['identifiant'] = $userinfo['identifiant'];
                $_SESSION['email'] = $userinfo['email'];
                header("Location: ../../index.php");
            }
            else {
                $message = "<div style='text-align: center;' class='alert alert-danger'>Identifiants incorrects !</div>";
            }
        }
        else {
            $message = "<div style='text-align: center;' class='alert alert-danger'>Tous les champs doivent être complétés !</div>";
        } 
    }

?>