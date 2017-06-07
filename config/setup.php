<?PHP
require "database.php";
define( 'ADM_USER', 'Krante2' );
define( 'ADM_MAIL', 'dgameiro@student.42.fr' );
try
{
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
}
catch (Exception $e_pdo)
{
	exit('Erreur :'.$e_pdo->getMessage());
}
$requete = "CREATE DATABASE IF NOT EXISTS ".$DB_NAME." DEFAULT CHARACTER SET utf8";
$pdo->prepare($requete)->execute();
$pdo->query('use '.$DB_NAME);
$requete = 'CREATE TABLE IF NOT EXISTS users (
			id INT NOT NULL AUTO_INCREMENT,
			username VARCHAR(25) NOT NULL,
			passwd VARCHAR(255) NOT NULL,
			mail VARCHAR(255) NOT NULL,
			cle VARCHAR(255),
			modif_cle VARCHAR(255),
			active INT,
			PRIMARY KEY(id)
			) 
			ENGINE=INNODB;';
$pdo->prepare($requete)->execute();
$requete = 'INSERT INTO users(username, passwd, mail, active) SELECT * FROM (SELECT :username, :passwd, :mail, :active) AS tmp 
	WHERE NOT EXISTS (SELECT username FROM users WHERE username = :username) LIMIT 1';
$pwd = hash('whirlpool', 'MvGt5l9s@');
$pdo->prepare($requete)->execute(array(
	'username' => ADM_USER,
	'passwd' => $pwd,
	'mail' => ADM_MAIL,
	'active' => 1
));

$requete = 'CREATE TABLE IF NOT EXISTS images (
			id INT NOT NULL AUTO_INCREMENT,
			user_id INT NOT NULL,
			file VARCHAR(255) NOT NULL,
			published BOOL NOT NULL,
			PRIMARY KEY(id)
			) 
			ENGINE=INNODB;';
$pdo->prepare($requete)->execute();

$requete = 'CREATE TABLE IF NOT EXISTS commentaires (
			id INT NOT NULL AUTO_INCREMENT,
			user_id INT NOT NULL,
			img_id INT NOT NULL,
			commentaire TEXT NOT NULL,
			date_commentaire DATETIME NOT NULL,
			PRIMARY KEY(id)
			) 
			ENGINE=INNODB;';
$pdo->prepare($requete)->execute();

$requete = 'CREATE TABLE IF NOT EXISTS likes (
			id INT NOT NULL AUTO_INCREMENT,
			user_id INT NOT NULL,
			img_id INT NOT NULL,
			PRIMARY KEY(id)
			) 
			ENGINE=INNODB;';
$pdo->prepare($requete)->execute();


?>
