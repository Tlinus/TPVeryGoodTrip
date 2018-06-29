<?php
include('../../config.php');
$db = db_connect();

if ($db) {
  $query = $db->prepare('DELETE FROM country WHERE id = :id');
  $result = $query->execute(array(':id' => $_GET['id']));

  if ($result) {
    header('location:list.php');
  } else {
    echo '<p class="danger">La tentative de suppression a échoué</p>';
  }
}
?>
