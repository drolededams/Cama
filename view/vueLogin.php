<?PHP ob_start();?>

	<DIV class = 'login'>
		<P class = 'identification'>Avant d'entrer dans le monde merveilleux de Camagru, veuillez-vous connecter :</P>
		<FORM action = '' method = 'POST'>
			Identifiant : <INPUT type = 'text' name = 'login' class = 'input'>
			Mot de passe : <INPUT type = 'password' name = 'passwd' class = 'input'>
			<INPUT type = 'submit' name = 'submit' value = 'Se connecter' class = 'submit'>
		</FORM>
		<P class = 'no_member'>Pas encore parmi nous ? <A HREF = 'index.php?action=create'>Créez-vous un compte</A> :)</P>
		<P class ='forgotten'>Un trou de mémoire ? <A HREF = 'index.php?action=modif'>Réinitialisez votre mot de passe</A></P>
	</DIV>
	<P><?= $message ?>  </P>
<?PHP $contenu = ob_get_clean(); 
	require "template/gabarit.php";
?>

