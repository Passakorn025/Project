<?php
$h = "localhost";
$u = "root";
$p = "";
$db = "project";
$conn = new mysqli($h,$u,$p,$db);
if($conn->connect_error) {
    die('Error'.$conn->connect_error);
} else {
   // echo "ok";
}

?>