<?PHP ob_start();?>

<DIV class = "img" id = "encart_<?=$photo['id']?>">
	<DIV class = "col">
	<DIV class = "surcadre">
	<DIV class = "cadre">
	<IMG src = "data/<?= $photo['file'] ?>">
	</DIV>
	<DIV class = com_img>
	<DIV id="coms" class="coms">
	<?PHP foreach ($coms as $com): ?>
		<DIV class = "com">
		<P> Posté par <?= $com['username'] ?> </P>
		<P class = 'date'> Le <?= $com['date_commentaire'] ?> </P>
		<P class = 'commentaire'> <?= utf8_decode($com['commentaire']) ?> </P>
		</DIV>
	<?PHP endforeach; ?>
	</DIV>
		<TEXTAREA placeholder="Tapez ici votre commentaire..." id = "com<?= $photo['id'] ?>"></TEXTAREA>
		<BUTTON class = "post_com" id ="<?= $photo['id']?>" onclick = "AddComToPage(this)"> Poster le commentaire</BUTTON>
<DIV class = "like_img" id = "like_gallery_<?=$photo['id']?>">
<?PHP 
if ($photo['is_liked'] === '1')
	echo"<BUTTON id ='like_".$photo['id']."' onclick = 'Dislike(this)'> Désaimer</BUTTON>";
else
	echo"<BUTTON id ='dis_".$photo['id']."' onclick = 'Like(this)'> Aimer</BUTTON>";
?>
	</DIV>
	</DIV>
</DIV>
</DIV>
</DIV>

<?PHP $contenu = ob_get_clean();
require "template/gabarit.php";?>
