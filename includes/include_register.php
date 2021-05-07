<?php
    if(isset($_POST['inscription'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mail = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);

        if(!empty($_POST['email']) AND !empty($_POST['identifiant']) AND !empty($_POST['mdp'])) {
            if(isset($_POST["cgu"])) { 
            $pseudolength = strlen($identifiant);
            if($pseudolength <= 255) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqidmail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
                    $reqidmail->execute(array($mail));
                    $mailidexist = $reqidmail->rowCount();
                    if($mailidexist == 0) {
                        $reqid = $bdd->prepare("SELECT * FROM users WHERE identifiant = ?");
                        $reqid->execute(array($identifiant));
                        $idexist = $reqid->rowCount();
                    if($idexist == 0) {
                        $insertmbr = $bdd->prepare("INSERT INTO users(date_inscription, ip, identifiant, email, password) VALUES (now(),'$ip',?,?,?)");
                        $insertmbr->execute(array($identifiant, $mail, $mdp));
                        $message = "<div style='text-align: center;' class='alert alert-success' >Votre compte a bien été créer !</div>";
                        header('Location: ../login');
                    } else {
                        $message = "<div style='text-align: center;' class='alert alert-danger'>Adresse email déjà utilisée !</div>";
                    } 
                } else {
                    $message = "<div style='text-align: center;' class='alert alert-danger'>Identifiant généré déjà utilisée !</div>";
                }
                }
            }
        } else {
            $message = "<div style='text-align: center;' class='alert alert-danger'>Vous devez accepter les CGU !</div>";
        }
        } else {
            $message = "<div style='text-align: center;' class='alert alert-warning'>Tous les champs doivent être complétés !</div>";
        }
    }
