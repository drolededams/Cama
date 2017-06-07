<?PHP ob_start();?>
<DIV class ="stickers">
	<FORM id = stickers>
		<INPUT class = 'sticker' type= 'radio' name = "sticker" id = "mario_i" value = "mario">
		<LABEL for= 'mario' class = sticker> <IMG src = 'content/stickers/mario.png' id = 'mario'></LABEL>
		<INPUT  class = 'sticker'type= 'radio' name = "sticker" id = "pikachu_i" value = "pikachu">
		<LABEL for= 'pikachu' class = 'sticker'> <IMG src = 'content/stickers/pikachu.png' id = 'pikachu'></LABEL>
		<INPUT  class = 'sticker'type= 'radio' name = "sticker" id = "sonic_i" value = "sonic">
		<LABEL for= 'sonic' class = 'sticker'> <IMG src = 'content/stickers/sonic.png' id = "sonic" ></LABEL>
		<INPUT  class = 'sticker' type= 'radio' name = "sticker" id = "link_i" value = "link">
		<LABEL for= 'link' class = 'sticker'> <IMG src = 'content/stickers/link.png' id = "link"></LABEL>
	</FORM>
</DIV>
</BR>
<VIDEO id="video"></VIDEO>
<DIV id=button>
<BUTTON id="takebutton" disabled>Prendre une photo</BUTTON>
<INPUT id = "uploadbutton" type="file" name="file" accept = ".png, .jpeg, .gif" disabled>
</DIV>
</BR>
<CANVAS id="canvas"></CANVAS>
<CANVAS id="canvas2"></CANVAS>
</BR>
</BR>
<DIV class="side_photo" id = "photos">
	<?PHP foreach ($photos as $photo): ?>
	<A HREF = "index.php?action=delete&id=<?=$photo['id'] ?>">
	<img src = "data/<?= $photo['file'] ?>" ></A>
		<?PHP endforeach; ?>
</DIV>
<P>Pour supprimer une image de votre galerie, cliquez dessus.</P>
<SCRIPT type="text/javascript" src="front_js/cam.js"></SCRIPT>

<?PHP $contenu = ob_get_clean();
require "template/gabarit.php";
?>
