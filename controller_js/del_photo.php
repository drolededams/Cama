<?PHP
require "../modele/modele.php";
session_start();

	$id = $_POST['id'];
	$user_id = Get_Datum('images', $id, 'id', 'user_id');
	if ($user_id['user_id'] === $_SESSION['user_id'])
	{
		if(Del_Datum('images', 'id', $id))
			echo "DELETED";
		else
			echo"NOT DELETED";
	}
	else
		echo"WRONG USER";

?>
