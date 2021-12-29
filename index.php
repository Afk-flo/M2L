<?php require_once 'lib/autoLoader.php';
 session_start();
 if(!isset($_SESSION['antb'])) {
	 $_SESSION['antb'] = 1;
 }
	
// Voir si c'est bannis 
if(Securite::isBaned($_SERVER['REMOTE_ADDR'])) {
	echo "Vous avez été bannis et c'est franchement dommage :(";
	die();
}

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Maison des Ligues de Lorraine</title>
		<style type="text/css">
			@import url(styles/m2l.css);
		</style>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	
	</head>
	<body>
		<?php
		

			require_once 'controleur/controleurPrincipal.php';	
			
		?>

	</body>
</html>
