<?PHP ob_start();?>
	<DIV class = 'login'>
		<P class = 'identification'>Afin de créer votre compte veuillez renseignez les champs suivants :</P>
		<FORM action = '' method = 'POST' onsubmit="return VerifForm()">
			<LABEL for ='username'>Identifiant :</LABEL> 
			<INPUT type = 'text' name = 'username' class = 'input' id = 'username' onblur = "IsUserFree(UserData); UserValid();" >
			<P id="box_username" style = 'display: none'> </P>
			<P id="box_username_valid" style = 'display: none'> </P>
			<?= $error_username ?>
			<LABEL for ='mail'>Mail :</LABEL> 
			<INPUT type = 'text' name = 'mail' class = 'input' id = 'mail' onblur = "IsMailNew(MailData); MailValid();">
			<P id="box_mail" style = 'display: none'> </P>
			<P id="box_mail_valid" style = 'display: none'> </P>
			<?= $error_mail ?>
			<LABEL for ='passwd'>Mot de passe :</LABEL> 
			<INPUT type = 'password' name = 'passwd' class = 'input' id = 'passwd' onblur = "PasswdSec(PutPass); SamePass();">
			<P id="box_passwd" style = 'display: none'> </P>
			<?= $error_passwd ?>
			<LABEL for ='reppasswd'>Répétez votre mot de passe :</LABEL> 
			<INPUT type = 'password' name = 'reppasswd' class = 'input' id = 'reppasswd' onblur = "SamePass()">
			<P id="box_reppasswd" style = 'display: none'> </P>
			<?= $error_reppasswd ?>
			<INPUT type = 'submit' name = 'submit' value = "S'inscrire" class = 'submit' id = 'submit'>
		</FORM>
			<P> Tous les champs sont obligatoires </P>
			<?= $confirm_mail ?>
		<P class = 'no_member'> Déjà parmi nous ? <A HREF = 'index.php'>Connectez-vous</A> </P>
			<P id="box_hack" style = 'display: none'> </P>
	</DIV>
<?PHP $contenu = ob_get_clean(); 
	require "template/gabarit.php";
?>




