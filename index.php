<?PHP
session_start();
require"config/setup.php";
require "modele/modele.php";
require "controller/controleur.php";
?>
<?PHP
	$titre = "Bienvenue Dans Camagru";
	if(!IsLog($_SESSION))
	{
		if (isset($_GET['action'])) {
			if ($_GET['action'] === 'create') {
				Create();
			}
			else if ($_GET['action'] === 'validation') {
				ValidUser();
			}
			else if ($_GET['action'] === 'modif') {
				PasswdForgot();
			}	
			else if ($_GET['action'] === 'modif_mail') {
				SetNewPasswd();
			}	
			else if ($_GET['action'] === 'view_gallery') {
				ViewGalleryOffline();
			}	
			else {
				SetLog();
			}
		}
		else {
			SetLog();
		}
	}
	else
	{
		if (isset($_GET['action'])) {
			if ($_GET['action'] === 'montage') {
				montage();
			}
			else if($_GET['action'] === 'delete') {
				Delete_Img();
			}
			else if ($_GET['action'] === 'view') {
				Display_Img();
			}
		}
		else
			Gallery();
	}
?>
