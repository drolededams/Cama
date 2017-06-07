<?PHP ob_start();?>
<P> Cette photo n'existe pas.</P>
<?PHP $contenu = ob_get_clean();
require "template/gabarit.php";?>
