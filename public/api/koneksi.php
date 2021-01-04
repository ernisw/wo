<?php
// mengkoneksikan ke database
$server = "localhost";
$server_username = "root";
$server_password = "";
$database_name =  "wedding_organizer";

$conn = new Mysqli($server, $server_username, $server_password, $database_name);
?>