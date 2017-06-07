<?PHP

class Database {
	public $pdo;

	public function getdb() {
		if (!$this->pdo) {
			$pdo;
			$pdo =  new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'dgameiro', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return ($this->pdo);
	}
}

function Get_Bdd()
{
	$bdd = new Database;
	return $bdd->getdb();
}

function auth ($table, $field_uniq, $uniq, $field_datum, $datum)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT id FROM '.$table.' WHERE '.$field_uniq.' = :uniq AND '.$field_datum.' = :datum';
	$req = $bdd->prepare($abc);
	$req->execute(array(
		'uniq' => $uniq,
		'datum' => $datum
	));
	if (!($req->fetch()))
	{
		return FALSE;
	}
	else
		return TRUE;
}

function IsFree($data, $champ)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT COUNT(*) FROM users WHERE '.$champ.' = ?';
	$req = $bdd->prepare($abc);
	$req->execute(array($data));
	if (!($req->fetchColumn()))
		return TRUE;
	else
		return FALSE;
}

function Is_Liked($user_id, $img_id)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT COUNT(*) AS nb FROM likes WHERE user_id = :user_id AND img_id = :img_id';
	$req = $bdd->prepare($abc);
	$req->execute(array(
		'user_id' => $user_id,
		'img_id' => $img_id
	));
	$data = $req->fetch();
	return($data['nb']);
}

function Add_Pretender($post)
{
	$pdo = Get_Bdd();
	$hash = hash('whirlpool', $post['passwd']);
	$req = 'INSERT INTO users(username, passwd, mail, active, cle) VALUES (:username, :passwd, :mail, :active, :key)';
	$pdo->prepare($req)->execute(array(
		'username' => $post['username'],
		'passwd' => $hash,
		'mail' => $post['mail'],
		'active' => 0,
		'key' => $post['key']
	));
}

function Get_Datum($table, $uniq, $field_uniq, $field_datum)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT '.$field_datum.' FROM '.$table.' WHERE '.$field_uniq.' = ?';
	$req = $bdd->prepare($abc);
	$req->execute(array($uniq));
	return ($req->fetch(PDO::FETCH_ASSOC));
}

function Get_Data_Join_Ord($table, $join, $datum_table, $datum_join, $uniq, $field_uniq, $field_datum, $field_ord, $ord)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT '.$field_datum.' FROM '.$table.' INNER JOIN '.$join.' ON '.$datum_table.' = '.$datum_join.' WHERE '.$field_uniq.' = ? ORDER BY '.$field_ord.' '.$ord;
	$req = $bdd->prepare($abc);
	$req->execute(array($uniq));
	return ($req);
}

function Get_Data($table, $uniq, $field_uniq, $field_datum)
{
	$bdd = Get_Bdd();
	
	$abc = 'SELECT '.$field_datum.' FROM '.$table.' WHERE '.$field_uniq.' = ?';
	$req = $bdd->prepare($abc);
	$req->execute(array($uniq));
	return ($req);
}

function Get_Data_Ord($table, $uniq, $field_uniq, $field_datum, $field_ord, $ord)
{
	$bdd = Get_Bdd();
	
	$abc = 'SELECT '.$field_datum.' FROM '.$table.' WHERE '.$field_uniq.' = ? ORDER BY '.$field_ord.' '.$ord;
	$req = $bdd->prepare($abc);
	$req->execute(array($uniq));
	return ($req);
}

function Up_Datum($table, $field_uniq, $uniq, $field_datum, $datum)
{
	$bdd = Get_Bdd();
	$abc = 'UPDATE '.$table.' SET '.$field_datum.' = :datum  WHERE '.$field_uniq.' = :uniq';
	$req = $bdd->prepare($abc);
	$req->execute(array(
		'datum' => $datum,
		'uniq' => $uniq
	));
}

function Add_image($user_id, $file, $published)
{
	$bdd = Get_Bdd();
	$abc = 'INSERT INTO images(user_id, file, published) VALUES (:user_id, :file, :published)';
	$bdd->prepare($abc)->execute(array(
		'user_id' => $user_id,
		'file' => $file,
		'published' => $published
	));
}

function Add_Com($user_id, $img_id, $com)
{
	$bdd = Get_Bdd();
	$tab;
	$abc = "INSERT into commentaires set user_id = ?, img_id = ?, commentaire = ?, date_commentaire = NOW()";
	//	$abc = 'INSERT INTO commentaires(user_id, img_id, commentaire, date_commentaire) VALUES (:user_id, :img_id, :commentaire, NOW() )';
	$tab[] = $user_id;
	$tab[] = $img_id;
	$tab[] = utf8_encode($com);
	$bdd->prepare($abc)->execute($tab);
//	$bdd->prepare($abc)->execute(array(
//		'user_id' => $user_id,
//		'img_id' => $img_id,
//		'commentaire' => $com,
//		'date' => $date
//	));
}

function Add_Like($user_id, $img_id)
{
	$bdd = Get_Bdd();
	$abc = 'INSERT INTO likes(user_id, img_id) VALUES (:user_id, :img_id)';
	$bdd->prepare($abc)->execute(array(
		'user_id' => $user_id,
		'img_id' => $img_id
	));
}

function Del_Like($user_id, $img_id)
{
	$bdd = Get_Bdd();
	$abc = 'DELETE FROM likes WHERE user_id = :user_id AND img_id = :img_id';
	$bdd->prepare($abc)->execute(array(
		'user_id' => $user_id,
		'img_id' => $img_id
	));
}


function Del_Datum($table, $field_uniq, $uniq)
{
	$bdd = Get_Bdd();
	$abc = 'DELETE FROM '.$table.' WHERE '.$field_uniq.' = ?';
	$req = $bdd->prepare($abc);
	return($req->execute(array($uniq)));
}

function Select_Field($table, $field, $field_ord, $ord)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT '.$field.' FROM '.$table.' ORDER BY '.$field_ord.' '.$ord;
	$req = $bdd->prepare($abc);
	$req->execute();
	return($req->fetchAll());
}

function Count_Datum($table, $field_uniq, $uniq)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT COUNT(*) AS nb FROM '.$table.' WHERE '.$field_uniq.' = '.$uniq;
	$req = $bdd->prepare($abc);
	$req->execute();
	$data = $req->fetch();
	return ($data['nb']);
}

function Get_Datum_Offset($table, $field, $field_ord, $ord,  $limit, $offset)
{
	$bdd = Get_Bdd();
	$abc = 'SELECT '.$field.' FROM '.$table.' ORDER BY '.$field_ord.' '.$ord.' LIMIT '.$limit.' OFFSET '.$offset;
	$req = $bdd->prepare($abc);
	$req->execute();
	return($req->fetchAll());

}
?>
