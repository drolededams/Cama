<?PHP ob_start() ?>
	<DIV class = 'login'>
		<P class = 'identification'>Veuillez entrer votre nouveau mot de passe :</P>
		<FORM action = '' method = 'POST' onsubmit="return VerifNewPasswd()">
			<LABEL for ='mail'>Nouveau mot de passe :</LABEL> 
			<INPUT type = 'password' name = 'passwd' class = 'input' id = 'passwd' onblur = "PasswdSec(PutPass);">
			<P id="box_passwd" style = 'display: none'> </P>
			<LABEL for ='mail'>Répétez votre nouveau mot de passe :</LABEL> 
			<INPUT type = 'password' name = 'reppasswd' class = 'input' id = 'reppasswd' onblur = "SamePass();">
			<P id="box_reppasswd" style = 'display: none'> </P>
			<INPUT type = 'submit' name = 'submit' value = "Changer de mot de passe." class = 'submit' id = 'submit'>
		</FORM>
		<P class = 'no_member'> Vous avez retrouvé la mémoire ? <A HREF = 'index.php'>Connectez-vous</A> </P>
	<P><?= $message ?>  </P>

<?PHP $contenu = ob_get_clean(); 
		require "template/gabarit.php";
?>
