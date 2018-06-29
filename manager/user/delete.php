<?php
include('../../dbmanager.php');
if (deleteUser($_GET['id'])) {
  header('location:list.php');
} else {
  echo '<p>Problème</p>';
}
?>
