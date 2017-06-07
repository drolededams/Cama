<!DOCTYPE html>
<?PHP
session_start();
require "template/headerLogin.php";
?>
<HTML>
	<HEAD>
		<META charset="UTF-8" />
		<LINK rel="stylesheet" type="text/css" href="content/style.css" />
		<TITLE><?= $titre ?> </TITLE>
		<script type="text/javascript" src="front_js/xhr.js"></script>
	</HEAD>
	<BODY>
		<HEADER>
			<P class = "logo"> Camagru</P>
			<?= $header ?>
		</HEADER>
			<?= $contenu ?> 
		<FOOTER>
			<P class = "footer">Camagru By dgameiro</P>
		</FOOTER>
	</BODY>
</HTML>
