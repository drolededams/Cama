<?PHP
require "../modele/modele.php";
session_start();

	$image = $_POST['image'];
	$image = str_replace('data:image/png;base64,', '', $image);
	$image = str_replace(' ', '+', $image);
	$data = base64_decode($image);
	$file = uniqid() . '_' . $_SESSION['user_id'] . '.png';
	Add_image($_SESSION['user_id'], $file, 0);
	$file = '../data/' . $file;
	$success = file_put_contents($file, $data);
	if ($success)
		echo "OK";
	else
		echo "NO";
?>
