<?php
# BAZA
include("db_connect.php");

# POST PODATKI
$komentar = $_POST["komentar"];
$username = $_POST["username"];
$post_id = $_POST["post_id"];

$sql = "INSERT INTO komentar (id_objava, komentar, id_uporabnik) VALUES ((SELECT id FROM objava WHERE id='$post_id'), '$komentar', (SELECT id FROM uporabniki WHERE username='$username'))";

if (mysqli_query($conn, $sql)){
    echo 1;
} else {
    echo 0;
}
?>