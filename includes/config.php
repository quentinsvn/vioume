<?php
    try {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=HOSTNAME;dbname=NOM_DE_VOTRE_BDD', 'IDENTIFIANT', 'MOTDEPASSE');
    } catch (Exception $e) {
        echo $e;
    }
?>