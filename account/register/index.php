<?php
ini_set('display_errors','off');
session_start();
include('../../includes/config.php');
include('../../includes/include_register.php');
if(isset($_SESSION['id'])) {
    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vioume | Connexion</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../../assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../../assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../../assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/login/images/bg_fortnite.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" name="signup">
					<span class="login100-form-logo">
						<img width="50%" src="../../assets/img/logo.png" alt="">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Inscription
                    </span>
                    <?php 
						if(isset($message)) {
							echo $message;
						}
					?>
                    <div class="wrap-input100 validate-input" data-validate = "Identifiant">
						<input class="input100" type="text" name="identifiant" placeholder="Identifiant">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Adresse e-mail">
						<input class="input100" type="email" name="email" placeholder="Adresse e-mail">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Mot de passe">
						<input class="input100" type="password" name="mdp" placeholder="Mot de passe">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Confirmez le mot de passe">
						<input class="input100" type="password" name="mdpconfirm" placeholder="Confirmez le mot de passe">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="cgu">
						<label class="label-checkbox100" for="ckb1">
							J'accepte les conditions générales d'utilisations
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="inscription">
							Créer un compte
						</button>
					</div>

					<div class="container-login100-form-btn">
						<a class="text-light pt-3" href="../login/">J'ai déjà un compte</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>