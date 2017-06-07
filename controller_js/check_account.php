<?PHP
require "../modele/modele.php";
	
	$username = $_POST['username'];
	$champ = $_POST['champ'];
	if (!($username))
		echo "EMPTY";
	else if (IsFree($username, $champ))
		echo "FREE";
	else
		echo "NO";

?>
