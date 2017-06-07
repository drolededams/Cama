<?PHP
require "../modele/modele.php";
session_start();

	$offset = $_POST['offset'];
$photos = Get_Datum_Offset('images', 'file, id, user_id', 'id', 'DESC', '4', $offset);
	$i = 0;
	while($photos[$i]){
		$like = Is_Liked($_SESSION['user_id'], $photos[$i]['id']);
		$nb_likes = Count_Datum('likes', 'img_id', $photos[$i]['id']);
		$nb_coms = Count_Datum('commentaires', 'img_id', $photos[$i]['id']);
		$user = Get_Datum('users', $photos[$i]['user_id'], 'id', 'username');
		$photos[$i]['username'] = $user['username'];
		$photos[$i]['is_liked'] = $like;
		$photos[$i]['nb_likes'] = $nb_likes;
		$photos[$i]['nb_coms'] = $nb_coms;
		$i++;
	}
	if (isset($photos[0]))
	{
		foreach ($photos as $photo):
		echo'<DIV class ="encart" id = "encart_'.$photo['id'].'">
		<DIV class = "surcadre">
		<DIV class = "cadre">
		<A HREF = "index.php?action=view&id='.$photo['id'].'">
		<IMG src = "data/'.$photo['file'].'" ></A>
		</DIV>
		<DIV class = "com_gallery">
		<DIV class = "post">Posté par '.$photo['username'].' </DIV>
		<DIV class = "like_gallery" id = "like_gallery_'.$photo['id'].'">';
if ($photo['is_liked'] === '1')
			echo"<BUTTON id ='like_".$photo['id']."' onclick = 'Dislike(this)'> Désaimer</BUTTON>";
		else
			echo"<BUTTON id ='dis_".$photo['id']."' onclick = 'Like(this)'> Aimer</BUTTON>";
		echo "</DIV>";
		echo "</BR>";
		echo "</BR>";
		echo'<TEXTAREA placeholder="Tapez ici votre commentaire..." id = "com'.$photo['id'].'"></TEXTAREA>
			</BR>
		<BUTTON class = "post_com" id ="'.$photo['id'].'" onclick = "AddCom(this)"> Poster le commentaire</BUTTON>';
		echo "</BR>";
		echo "</BR>";
		if ($photo['nb_likes'] > '1')
			echo"<DIV class = 'nb_likes' id = 'nb_likes_".$photo['id']."'> ".$photo['nb_likes']." likes </DIV>";
		else
			echo"<DIV class = 'nb_likes' id = 'nb_likes_".$photo['id']."'> ".$photo['nb_likes']." like </DIV>";
		if ($photo['nb_coms'] > '1')
			echo"<A HREF = 'index.php?action=view&id=".$photo['id']." '><DIV class = 'nb_coms' id = 'nb_coms_".$photo['id']."'> ".$photo['nb_coms']." commentaires </DIV></A>";
		else
			echo"<A HREF = 'index.php?action=view&id=".$photo['id']." '><DIV class = 'nb_coms' id = 'nb_coms_".$photo['id']."'> ".$photo['nb_coms']." commentaire </DIV></A>";
				echo'</DIV>';
		echo'</DIV>';
		echo'</DIV>';
		echo "</BR>";
		endforeach;
	}

?>
