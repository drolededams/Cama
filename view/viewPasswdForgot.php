<?PHP ob_start() ?>
	<DIV class = 'login'>
		<P class = 'identification'>Afin de créer votre compte veuillez renseignez les champs suivants :</P>
		<FORM action = '' method = 'POST' onsubmit="return VerifMail()">
			<LABEL for ='mail'>Mail :</LABEL> 
			<INPUT type = 'text' name = 'mail' class = 'input' id = 'mail' onblur = "IsMailNew(MailExistsData); MailValid();">
			<P id="box_mail" style = 'display: none'> </P>
			<P id="box_mail_valid" style = 'display: none'> </P>
			<INPUT type = 'submit' name = 'submit' value = "Réinitialiser le mot de passe." class = 'submit' id = 'submit'>
		</FORM>
		<P class = 'no_member'> Vous avez retrouvé la mémoire ? <A HREF = 'index.php'>Connectez-vous</A> </P>
	<P><?= $message ?>  </P>


<?PHP $contenu = ob_get_clean(); 
		require "template/gabarit.php";
?>
