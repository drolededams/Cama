<?PHP ob_start();?>

<P> Une erreur est survenue lors de la validation de votre compte. Vérifiez la correspondance de l'URL et du lien envoyé par mail</P>

<?PHP $contenu = ob_get_clean();
	require "template/gabarit.php";
?>
