<?PHP
	if(!IsLog($_SESSION))
	{
		ob_start();?>	
		<A href = "index.php">Accueil</A>'
		<A href = "index.php?action=view_gallery">Galerie</A>'
<?PHP $header = ob_get_clean();
	}
	else
	{
		ob_start();?>	
	<A href = "index.php">Accueil</A>
	<A href = "index.php?action=montage">Montage</A>
	<A href = "controller/logout.php">Se Déconnecter</A>
<?PHP $header = ob_get_clean();
	}
?>
