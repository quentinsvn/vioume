<?php
        ini_set('display_errors','off');
        $mode_edition = 0;
        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit = $bdd->prepare('SELECT * FROM users WHERE id = ?');
            $edit->execute(array($edit_id));
            if($edit->rowCount() == 1) {
                $edit = $edit->fetch();
            } else {
                die('Erreur : l\'utilisateur n\'existe pas...');
            }
        }
        
        if($mode_edition == 1) {
            if(isset($_POST['confirm'])) {
                            $identifiant = htmlspecialchars($_POST['identifiant']);
                            $email = htmlspecialchars($_POST['email']);
                            $mdp = sha1($_POST['password']);
                            $discord = htmlspecialchars($_POST['discord']);
                            $youtube = htmlspecialchars($_POST['youtube']);
                            $twitch = htmlspecialchars($_POST['twitch']);
                            $instagram = htmlspecialchars($_POST['instagram']);
                            $solde = htmlspecialchars($_POST['vioumcoins']);
                            if(!empty($_POST["premium"])) { 
                                $premium = 1;
                            } else {
                                $premium = 0;
                            }
                            if(!empty($_POST["staff"])) { 
                                $staff = 1;
                            } else {
                                $staff = 0;
                            }
                            if(!empty($_POST["admin"])) { 
                                $admin = 1;
                            } else {
                                $admin = 0;
                            }
                            $reqid = $bdd->prepare("SELECT * FROM users WHERE identifiant = ?");
                            $reqid->execute(array($identifiant));
                            $idexist = $reqid->rowCount();
                            if($idexist == 0 || $identifiant === $edit['identifiant']) {
                                $update = $bdd->prepare('UPDATE users SET date_modification = now(), identifiant = ?, email = ?, password = ?, discord_username = ?, solde = ?, premium = ?, youtube = ?, twitch = ?, instagram = ?, staff = ?, admin = ? WHERE id = ?');
                                $update->execute(array($identifiant, $email, $mdp, $discord, $solde, $premium, $youtube, $twitch, $instagram, $staff, $admin, $edit_id));
                                $message = '<div class="alert alert-success">Votre utilisateur a bien été mis à jour !</div>';
                                header("Location: ../index.php");
                            } else {
                                $message = '<div class="alert alert-danger">L\'identifiant existe déjà !</div>';
                            }
                        }
                    }
?>