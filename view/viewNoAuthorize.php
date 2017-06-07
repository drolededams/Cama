<?PHP ob_start();?>
<P> Vous ne pouvez pas modifier les photos d'autres utilisateurs </P>
<?PHP $contenu = ob_get_clean();
require "template/gabarit.php";?>
