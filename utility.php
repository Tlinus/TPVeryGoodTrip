<?php

function transformSQLDate($sql_date) {
  $date = date_create($sql_date); // native PHP
  return date_format($date, 'd/m/Y');
  // '2018-08-24' => '24/08/2018'
}

function cleanInput($str) {
  // supprime toutes les balises HTML et PHP (SECURITE)
  $cleanedStr = strip_tags($str);
  // supprime les espaces initiaux et finaux
  $cleanedStr = trim($cleanedStr);
  return $cleanedStr;
}

?>
