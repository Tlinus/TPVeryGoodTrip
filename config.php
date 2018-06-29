<?php
// déclaration de constantes
define('TEMPLATES_PATH','C:\wamp\www\php-bases\verygoodtrip\templates');
define('BASE_URL','http://localhost/php-bases/verygoodtrip');

function db_connect() {
  try {
    $db = new PDO('mysql:host=localhost;dbname=verygoodtrip', 'root', '');
    // paramètre assurant l'encodage UTF8 des données transmises par php
    $db->exec('SET NAMES utf8');
    // si succès on renvoie l'objet $db
    return $db;
  } catch(PDOException $e) {
    // si erreur on renvoie null
    return null;
  }
}
?>
