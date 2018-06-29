<?php
session_start(); // reprise éventuelle de la session existante
session_destroy(); // destruction de la session active
header('location:index.php');
?>
