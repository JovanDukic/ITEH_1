<?php

$host = "localhost";
$port = 3305;
$database = "ITEH_1";
$username = "root";
$password = "";

$connection = new mysqli($host, $username, $password, $database, $port);

$connection->autocommit(true);

if ($connection->connect_errno) {
    exit("Failed to connect to DB!");
}
