<?php
// traitement du formulaire photo
require('../../dbmanager.php');

// déplacement du fichier depuis son emplacement temporaire
// vers son emplacement choisi
if ($_FILES['picture']['size'] > 10000000) { // 100 KB
  echo '<p>fichier trop lourd</p>';
} else {
  $from = $_FILES['picture']['tmp_name'];
  $to = $_SERVER['DOCUMENT_ROOT']
    . '/php-bases/verygoodtrip/static/img/upload/'
    . $_FILES['picture']['name'];

  $result = move_uploaded_file($from, $to);
  if ($result) {
    echo '<p>Fichier téléchargé avec succès</p>';
    echo  $_POST['trip_id'];
    echo $_FILES['picture']['name'];
    // enregistrement en BDD
    if (insertPicture(
      $_POST['trip_id'],
      $_FILES['picture']['name'])
    ) {
      echo '<p>Enregisrement en DB OK</p>';
      header('location:edit.php?id=' . $_POST['trip_id']);
    }

  }
}

?>
