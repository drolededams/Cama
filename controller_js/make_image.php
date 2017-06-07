<?PHP
require "../modele/modele.php";
session_start();

	$image = $_POST['image'];
		$image = str_replace('data:image/png;base64,', '', $image);
		$image = str_replace(' ', '+', $image);
		$data = base64_decode($image);
	
		$file_photo = uniqid() . $_SESSION['user_id'] . '.png';
		Add_image($_SESSION['user_id'], $file_photo, 0);
		$file_photo = '../data/' . $file_photo;
		$message = file_put_contents($file_photo, $data);
	
		$source = imagecreatefrompng("../content/stickers/".$_POST['sticker'].".png"); // Le logo est la source
		$destination = imagecreatefrompng($file_photo); // La photo est la destination

	 //Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
		$largeur_source = imagesx($source);
		$hauteur_source = imagesy($source);
		$largeur_destination = imagesx($destination);
		$hauteur_destination = imagesy($destination);
	
	// // On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
		$destination_x = $largeur_destination - $largeur_source;
		$destination_y =  $hauteur_destination - $hauteur_source;
	//
	// // On met le logo (source) dans l'image de destination (la photo)
		imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
		imagepng($destination, $file_photo);
	 
		$photos = Get_Data_Ord('images', $_SESSION['user_id'], 'user_id', '*', 'id', 'DESC');
		foreach ($photos as $photo): 
			echo'<a href = "index.php?action=delete&id='.$photo['id'].'">
			<img src = "data/'.$photo["file"].'" > </a>';
		endforeach;
	
?>
