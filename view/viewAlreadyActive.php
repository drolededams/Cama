<?PHP ob_start();?>

<P> Le compte est déja actif </P>


<?PHP $contenu = ob_get_clean();
	require "template/gabarit.php";
?>
