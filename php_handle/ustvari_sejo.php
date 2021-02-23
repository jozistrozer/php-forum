<?php
# ustvari sejo
session_start();

# povezava na podatkovno bazo
include("db_connect.php");

# spremenljivka uporabnisko ime
$_SESSION['username'] = $_POST['username'];

echo 1;

?>