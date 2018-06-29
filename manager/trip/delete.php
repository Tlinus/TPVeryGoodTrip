<?php
include('../../dbmanager.php');
if (deleteTrip($_GET['id'])) {
  header('location:list.php');
} else {
  echo '<p>Problème</p>';
}
?>
