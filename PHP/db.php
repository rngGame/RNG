<?php
include_once '/home1/miniforu/public_html/rng/PHP/config.php';   // As functions.php is not included
$db = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if (!$db->set_charset("utf8")) 
  ?>