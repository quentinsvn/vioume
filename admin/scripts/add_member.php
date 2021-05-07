<?php

    if(isset($_POST['confirm'])) {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mail = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $mdpconfirm = sha1($_POST['password_confirm']);
        $discord = htmlspecialchars($_POST['discord']);
        $youtube = htmlspecialchars($_POST['youtube']);
        $twitch = htmlspecialchars($_POST['twitch']);
        $instagram = htmlspecialchars($_POST['instagram']);
        $solde = htmlspecialchars($_POST['vioumcoins']);
        if(empty($_POST["premium"])) { 
            $premium_check = 1;
        } else {
            $premium_check = 0;
        }
        if(empty($_POST["staff"])) { 
            $staff_check = 1;
        } else {
            $staff_check = 0;
        }
        if(empty($_POST["admin"])) { 
            $admin_check = 1;
        } else {
            $admin_check = 0;
        }
        if(!empty($_POST['identifiant']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])) {
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
                            if($mdp == $mdpconfirm) {
                                $premium = htmlspecialchars($_POST['premium']);
                                $staff = htmlspecialchars($_POST['staff']);
                                $admin = htmlspecialchars($_POST['admin']);
                                $insertmbr = $bdd->prepare("INSERT INTO users(date_inscription, date_modification, identifiant, email, password, discord_username, solde, premium, youtube, twitch, instagram, staff, admin) VALUES (now(),now(),?,?,?,?,?,?,?,?,?,?,?)");
                                $insertmbr->execute(array($identifiant,$mail,$mdp,$discord,$solde,$premium,$youtube,$twitch,$instagram,$staff,$admin));
                                $message = '<div class="alert alert-success">
                                                <p><strong>Bien joué :D</strong> Le compte à bien été créer avec succès !</p>
                                            </div>';
                                header('Location: ../index.php');
                            } else {
                                $message = '<div class="alert alert-danger">
                                                <p><strong>Erreur :(</strong> Les mots de passes ne correspondent pas !</p>
                                            </div>';
                            }                 
                        } else {
                            $message = '<div class="alert alert-danger">
                                            <p><strong>Erreur :(</strong> Identifiant déjà utilisé !</p>
                                        </div>';
                        }
                    } else {
                        $message = '<div class="alert alert-danger">
                                        <p><strong>Erreur :(</strong> Adresse e-mail déjà utilisé !</p>
                                    </div>';
                    }
                } else {
                    $message = '<div class="alert alert-danger">
                                        <p><strong>Erreur :(</strong> Adresse e-mail incorrecte !</p>
                                    </div>';
                }
            } else {
                $message = '<div class="alert alert-danger">
                                <p><strong>Erreur :(</strong> Identifiant trop longs !</p>
                            </div>';
            }
        } else {
            $message = '<div class="alert alert-danger">
                            <p><strong>Erreur :(</strong> Tous les champs doivent être complétés !</p>
                        </div>';
        }

    }


?>