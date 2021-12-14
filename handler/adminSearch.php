<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["controller"]) && isset($_POST["text"]) && isset($_POST["filter"])) {
    $controller = $_SESSION["controller"];
    $controller->searchForUsers($_POST["text"], $_POST["filter"], $_SESSION["ID"], $connection);
    echo json_encode($controller->users);
}
