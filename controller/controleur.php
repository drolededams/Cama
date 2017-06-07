<?PHP 
	
function IsLog ($session)
{
	if(isset($session['loggued_on_user']))
		return TRUE;
	else
		return FALSE;
}

function SetLog()
{
	if(isset($_POST['login']) && isset($_POST['passwd']))
	{
		$hashed_passwd = hash('whirlpool', $_POST['passwd']);
		if(auth('users', 'username', $_POST['login'], 'passwd', $hashed_passwd))
		{	
			$active = Get_Datum('users', $_POST['login'], 'username', 'active');
			if ($active['active'] === "0")
			{
				$message = "Votre compte n'est pas encore activé";
			}
			else
			{
				$_SESSION['loggued_on_user'] = $_POST['login'];
				$user_id = Get_Datum('users', $_POST['login'], 'username', 'id');
				$_SESSION['user_id'] = $user_id['id']; 
				echo"<script>location.reload(true);</script>";
			}
		}
		else
			$message = "Identifiant et/ou mot de passe incorrect";
	}
	require "view/vueLogin.php";
}

function PasswdSec($passwd)
{
	$upp = 0;
	$low = 0;
	$num = 0;
	$spe = 0;

	if (($len = strlen($passwd)) < 8)
		return FALSE;
	else{
		for ($i = 0; $i < $len; $i++)
		{
			if($passwd[$i] >= 'a' && $passwd[$i] <= 'z')
				$low = 1;
			else if($passwd[$i] >= 'A' && $passwd[$i] <= 'Z')
				$upp = 1;
			else if($passwd[$i] >= '0' && $passwd[$i] <= '9')
				$num = 1;
			else
				$spe = 1;
		}
	}
	if($spe && $upp && $low && $num)
		return TRUE;
	return FALSE;
}

function SentConfirmation($post)
{
	$post['key'] = hash('whirlpool', (microtime(TRUE) * 250));
	Add_Pretender($post);
	$sujet = utf8_decode("Activez votre compte ".$post['username']." !");
	$entete = "From: inscription@camagru.com";
	$message = utf8_decode("Bienvenue sur Camagru !
	$dir = getcwd();
	$dir = explode('/',$dir);
	$dir = $dir[5];

		Afin d'activer votre compte, veuillez cliquer sur le lien ci-dessous
		ou le copier-coller dans votre navigateur internet.
		http://localhost:8080/$dir/index.php?action=validation&username=".$post['username']."&pile=".$post['key']."
		
		Ceci est un mail automatique merci de ne pas répondre");
	mail($post['mail'], $sujet, $message, $entete);
}

function Create()
{
	if (isset($_POST['username']) && isset($_POST['passwd']) && isset($_POST['reppasswd']) && isset($_POST['mail']) && $_POST['submit'] === "S'inscrire")
	{
		$mail = $_POST['mail'];
		$passwd = $_POST['passwd'];
		$reppasswd = $_POST['reppasswd'];
		$username = htmlspecialchars($_POST['username']);
		if(!(IsFree($username, 'username')))
			$error_username = "<P>Ce pseudo est déjà pris</P>";
		if(preg_match('/[^a-zA-Z0-9_]/', $username))
		{
			$error_username = "<P>Seul les caractères alpha-numérique et le _ sont acceptés</P>";
		}
		if(!(IsFree($mail, 'mail')))
			$error_mail = "<P>Cette adresse e-mail est déjà utilisée</P>";
		if(!(filter_var($mail, FILTER_VALIDATE_EMAIL)))
			$error_mail = "<P>L'adresse e-mail est invalide<P>";
		if((IsFree($mail, 'mail')) && (IsFree($username, 'username')) && filter_var($mail, FILTER_VALIDATE_EMAIL) && !(preg_match('/[^a-zA-Z0-9_]/', $username)))
		{
			if(!(PasswdSec($passwd)))
				$error_passwd = "<P>Le mot de passe doit contenir au moins 8 caractères et comporter au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</P>";
			else if($passwd != $reppasswd)
				$error_reppasswd = "<P>Les mots de passe ne correspondent pas.</P>";
			else
			{
				SentConfirmation($_POST);
				$confirm_mail = "<P> Un mail d'activation vous a été envoyé </P>";
			}
		}
	}
	require "view/vueCreate.php";
}

function ValidUser()
{
	$username = $_GET['username'];
	$active = Get_Datum('users', $username, 'username', 'active');
	$key_bdd = Get_Datum('users', $username, 'username', 'cle');
	$key_mail = $_GET['pile'];

	if ($active['active'] === "1")
	{
		$message = "<P>Le compte est déjà actif</P>";
		require "view/viewAlreadyActive.php";
	}
	else if ( $active['active'] === "0" && $key_bdd['cle'] === $key_mail)
	{
		$message = "<P>Le compte est maintenant actif</P>";
		require"view/viewAccountActivated.php";
		Up_Datum('users', 'username', $username, 'active', 1);
	}
	else
	{
		require "view/viewAccountError.php";
	}
}

function SentModif($mail)
{
	$key = hash('whirlpool', (microtime(TRUE) * 168));
	Up_Datum('users', 'mail', $mail, 'modif_cle', $key);
	$username = Get_Datum('users', $mail, 'mail', 'username');
	$username = $username['username'];
	$sujet = utf8_decode("Réinitialisation de mot de passe");
	$entete = "From: account@camagru.com";
	$message = utf8_decode("Hello ".$username." !
	$dir = getcwd();
	$dir = explode('/',$dir);
	$dir = $dir[5];

		Afin de réinitialiser votre mot de passe, veuillez cliquer sur le lien ci dessous ou le copier-coller dans votre navigateur internet.
		http://localhost:8080/$dir/index.php?action=modif_mail&username=".$username."&pile=".$key."
		
		Ceci est un mail automatique merci de ne pas répondre");
	mail($mail, $sujet, $message, $entete);
}

function PasswdForgot()
{

	if (isset($_POST['mail']))
	{
		$mail = $_POST['mail'];
		if(IsFree($mail, 'mail'))
			$message = "Aucun compte associé à cette adresse";
		else
		{
			SentModif($mail);
			$message = "Un mail de réinitialisation de mot de passe vous a été envoyé.";
			$_GET['action'] = 'test';
		}
	}
		require "view/viewPasswdForgot.php";
}

function SetNewPasswd()
{
	if (isset($_POST['passwd']) && isset($_POST['reppasswd']))
	{
		$passwd = $_POST['passwd'];
		$reppasswd = $_POST['reppasswd'];
		$key = $_GET['pile'];
		$username = $_GET['username'];
		if(!(PasswdSec($passwd)))
			$message = "Le mot de passe doit contenir au moins 8 caractères et comporter au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
		else if($passwd != $reppasswd)
			$message = "Les mots de passe ne correspondent pas.";
		else if (auth('users', 'username', $username, 'modif_cle', $key))
		{
			$hashed_passwd = hash('whirlpool', $passwd);
			Up_Datum('users', 'modif_cle', $key, 'passwd', $hashed_passwd);
			Up_Datum('users', 'modif_cle', $key, 'modif_cle', null);
			$message = "Votre mot de passe a été mis à jour.";
		}
		else
			$message = "Une erreur est survenue. Vérifier que l'URL corresponde au lien donné en e-mail ou refaite une demande de <A HREF = 'index.php?action=modif'>rénitialisation de mot de passe</A>.";
	}
	require "view/viewSetNewPasswd.php";
}

function Montage()
{
	$photos = Get_Data_Ord('images', $_SESSION['user_id'], 'user_id', '*', 'id', 'DESC');
	require "view/viewMontage.php";
}

function Delete_Img()
{
	$user_id = Get_Datum('images', $_GET['id'], 'id', 'user_id');
	if ($user_id['user_id'] === $_SESSION['user_id'])
	{
		$photo = Get_Datum('images', $_GET['id'], 'id', 'file');
		if ($photo['file'])
			require"view/viewDelete.php";
		else
		{
			require "view/viewNoPhoto.php";
		}
	}
	else if (isset($user_id['user_id']) && $users['user_id'] !== $_SESSION['user_id'] )
		require "view/viewNoAuthorize.php";
	else
		require"view/viewNoPhoto.php";
}

function Gallery()
{
	$photos = Get_Datum_Offset('images', 'file, id, user_id', 'id', 'DESC', '4', '0');
	$i = 0;
	while($photos[$i]){
		$like = Is_Liked($_SESSION['user_id'], $photos[$i]['id']);
		$nb_likes = Count_Datum('likes', 'img_id', $photos[$i]['id']);
		$nb_coms = Count_Datum('commentaires', 'img_id', $photos[$i]['id']);
		$user = Get_Datum('users', $photos[$i]['user_id'], 'id', 'username');
		$photos[$i]['is_liked'] = $like;
		$photos[$i]['nb_likes'] = $nb_likes;
		$photos[$i]['nb_coms'] = $nb_coms;
		$photos[$i]['username'] = $user['username'];
		$i++;
	}
 require "view/vueGalerie.php";
}

function ViewGalleryOffline()
{
	$photos = Get_Datum_Offset('images', 'file, id, user_id', 'id', 'DESC', '4', '0');
	$i = 0;
	while($photos[$i]){
		$like = Is_Liked($_SESSION['user_id'], $photos[$i]['id']);
		$nb_likes = Count_Datum('likes', 'img_id', $photos[$i]['id']);
		$nb_coms = Count_Datum('commentaires', 'img_id', $photos[$i]['id']);
		$user = Get_Datum('users', $photos[$i]['user_id'], 'id', 'username');
		$photos[$i]['is_liked'] = $like;
		$photos[$i]['nb_likes'] = $nb_likes;
		$photos[$i]['nb_coms'] = $nb_coms;
		$photos[$i]['username'] = $user['username'];
		$i++;
	}
 require "view/vueGalerieOffline.php";
}

function Display_Img()
{
	$photo = Get_Datum('images', $_GET['id'], 'id', 'file');
	$photo['id'] = $_GET['id'];
	$photo['is_liked']= Is_Liked($_SESSION['user_id'], $photo['id']);
	if ($photo['file'])
	{
		$coms = Get_Data_Join_Ord('commentaires', 'users', 'commentaires.user_id', 'users.id', $_GET['id'], 'img_id', 'commentaires.commentaire, commentaires.date_commentaire, users.username', 'commentaires.date_commentaire', 'ASC');
		require "view/viewImage.php";
	}
	else
		require "view/viewNoPhoto.php";
}

?>
