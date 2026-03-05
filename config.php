<?php
$connection = new mysqli("localhost", "root", "", "todoapp");
if($connection->connect_error){
    die("Connection Failed " . $connection->connect_error);
}
?>