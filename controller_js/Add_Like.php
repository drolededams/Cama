<?PHP
require "../modele/modele.php";
session_start();

	$img_id = $_POST['img_id'];
	if(Is_liked($_SESSION['user_id'], $img_id) === '0')
	{
		Add_Like($_SESSION['user_id'], $img_id);
	}
	$count = Count_Datum('likes', 'img_id', $img_id);
	echo $count;
?>
