<?PHP ob_start(); ?>

<DIV id = "photo">
<IMG src = "data/<?= $photo['file'] ?>" id = "photo_del">
<BUTTON id="delete" onclick ="DelPhoto(DelConfirm)">Supprimer la photo</BUTTON>
</DIV>
<?PHP $contenu = ob_get_clean(); 
require "template/gabarit.php";?>
