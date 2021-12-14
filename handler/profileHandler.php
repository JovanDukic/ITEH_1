<?php

require "../database/databaseManager.php";
require "../entity/User.php";

session_start();

if (sizeof($_POST) > 0) {
    echo User::update($_SESSION["ID"], $_POST, $connection);
} else {
    echo "nothing";
}
