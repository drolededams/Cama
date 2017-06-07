<?PHP
require "../modele/modele.php";
session_start();
	$com = htmlspecialchars($_POST['com']);
	$com = nl2br($com);
	$img_id = $_POST['img_id'];
	$img_own = Get_Datum('images', $_POST['img_id'], 'id', 'user_id'); 
	$mail_own = Get_Datum('users', $img_own['user_id'], 'id', 'mail');
	$dir = getcwd();
	$dir = explode('/',$dir);
	$dir = $dir[5];

	$sujet = utf8_decode("Vous avez reçu un nouveau commentaire");
	$entete = "From: notification@camagru.com";
	$message = utf8_decode("Vous avez reçu un nouveau commentaire cliquez sur le lien pour le voir http://localhost:8080/$dir/index.php?action=view&id=".$_POST['img_id']."
		Ceci est un mail automatique merci de ne pas répondre.");
	mail($mail_own['mail'], $sujet, $message, $entete);
	Add_Com($_SESSION['user_id'], $img_id, $com);
	$count = Count_Datum('commentaires', 'img_id', $img_id);
	echo $count;

?>
