<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["controller"]) && isset($_POST["text"])) {
    $controller = $_SESSION["controller"];
    $controller->searchForUserTests($_POST["text"], $_SESSION["ID"], $connection);
    echo json_encode($controller->userTests);
}
