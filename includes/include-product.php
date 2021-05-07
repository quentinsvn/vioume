<?php
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);

        $products = $bdd->prepare("SELECT * FROM products WHERE id = ?");
        $products->execute(array($get_id));

        if($products->rowCount() == 1) {
            $products = $products->fetch();
            $namep = $products['name'];
            $description = $products['description'];
            $miniature = $products['miniature'];
            $price = $products['price'];
        } else {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
?>