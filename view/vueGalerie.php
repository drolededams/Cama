<?PHP ob_start();?>

<P class = "welcome"> Bonjour <?= $_SESSION['loggued_on_user']?> <P>
<DIV id = "gallery">
	<?PHP foreach ($photos as $photo): ?>
	<DIV class ="encart" id = "encart_<?=$photo['id']?>">
		<DIV class = "surcadre">
		<DIV class = "cadre">
		<A HREF = "index.php?action=view&id=<?=$photo['id'] ?>">
		<IMG class = "img_gallery" src = "data/<?= $photo['file'] ?>" ></A>
		</DIV>
		<DIV class = "com_gallery">
		<DIV class = "post">Photo posté par <?= $photo['username']?> </DIV>
		<DIV class = "like_gallery" id = "like_gallery_<?=$photo['id']?>">
<?PHP
if ($photo['is_liked'] === '1')
	echo"<BUTTON id ='like_".$photo['id']."' onclick = 'Dislike(this)'> Désaimer</BUTTON>";
else
	echo"<BUTTON id ='dis_".$photo['id']."' onclick = 'Like(this)'> Aimer</BUTTON>";
?>
		</DIV>
		</BR>
		</BR>
		<TEXTAREA placeholder="Tapez ici votre commentaire..." id = "com<?= $photo['id'] ?>"></TEXTAREA>
		</BR>
		<BUTTON class = "post_com" id ="<?= $photo['id']?>" onclick = "AddCom(this)"> Poster le commentaire</BUTTON>
		</BR>
		</BR>
<?PHP 
if ($photo['nb_likes'] > '1')
	echo"<DIV class = 'nb_likes' id = 'nb_likes_".$photo['id']."'> ".$photo['nb_likes']." likes </DIV>";
else
	echo"<DIV class = 'nb_likes' id = 'nb_likes_".$photo['id']."'> ".$photo['nb_likes']." like </DIV>";
if ($photo['nb_coms'] > '1')
	echo"<A HREF = 'index.php?action=view&id=".$photo['id']." '><DIV class = 'nb_coms' id = 'nb_coms_".$photo['id']."'> ".$photo['nb_coms']." commentaires </DIV></A>";
else
	echo"<A HREF = 'index.php?action=view&id=".$photo['id']." '><DIV class = 'nb_coms' id = 'nb_coms_".$photo['id']."'> ".$photo['nb_coms']." commentaire </DIV></A>";
?>
		</DIV>
		</DIV>
	</DIV>
		</BR>
		<?PHP endforeach; ?>
	<P id = "loader" style = "display: none"> EN cours...</P>
</DIV>
<SCRIPT>
infiniteScroll();
</SCRIPT>
<?PHP $contenu = ob_get_clean(); 
	require "template/gabarit.php";
?>

