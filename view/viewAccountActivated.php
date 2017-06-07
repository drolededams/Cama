<?PHP ob_start();?>
<?= $message ?>
<?PHP $contenu = ob_get_clean();
	require "template/gabarit.php";
?>
