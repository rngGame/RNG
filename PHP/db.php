<?php
include_once 'config.php';   // As functions.php is not included
$db = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if (!$db->set_charset("utf8")) 
  ?>