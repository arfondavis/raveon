<?php
ccc$db = new mysqli("localhost", "root", "password", "podcasts");

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>