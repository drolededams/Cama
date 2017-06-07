<?PHP
require "../controller/controleur.php";

	$passwd = $_POST['passwd'];

	if (PasswdSec($passwd) === TRUE)
		echo "OK";
	else
		echo "NO";
?>
