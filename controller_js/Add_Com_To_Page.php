<?PHP
require "../modele/modele.php";
session_start();
	
	$com = nl2br(htmlspecialchars($_POST['com']));
	$img_id = $_POST['img_id'];
	$img_own = Get_Datum('images', $_POST['img_id'], 'id', 'user_id'); 
	$mail_own = Get_Datum('users', $img_own['user_id'], 'id', 'mail');
	$dir = getcwd();
	$dir = explode('/',$dir);
	$dir = $dir[5];

	$sujet = utf8_decode("Vous avez reçu un nouveau commentaire");
	$entete = "From: notification@camagru.com";
	$message = utf8_decode("Vous avez reçu un nouveau commentaire cliquez sur le lien pour le voir http://localhost:8080/$dir/index.php?action=view&id=".$_POST['img_id']."
		Ceci est un mail automatique merci de ne pas répondre");
	mail($mail_own['mail'], $sujet, $message, $entete);
	Add_Com($_SESSION['user_id'], $img_id, $com);
	$coms = Get_Data_Join_Ord('commentaires', 'users', 'commentaires.user_id', 'users.id', $_POST['img_id'], 'img_id', 'commentaires.commentaire, commentaires.date_commentaire, users.username', 'commentaires.date_commentaire', 'ASC');
	foreach ($coms as $com):
		echo "<DIV class = 'com'>
		<P>Posté par ".$com['username']."</P>
		<P class = 'date'>Le ".$com['date_commentaire']."</P>
		<P class = 'commentaire'>".utf8_decode($com['commentaire'])."</P>
		</DIV>";
	endforeach; 
?>
