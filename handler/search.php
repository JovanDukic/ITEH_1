<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["controller"]) && isset($_SESSION["userID"]) && isset($_POST["text"]) && isset($_POST["filter"])) {
    $controller = $_SESSION["controller"];
    $controller->searchForUserTests($_POST["text"], $_POST["filter"], $_SESSION["userID"], $connection);
    echo json_encode($controller->userTests);
    exit();
}

if (isset($_SESSION["controller"]) && isset($_POST["text"]) && isset($_POST["filter"])) {
    $controller = $_SESSION["controller"];
    $controller->searchForUserTests($_POST["text"], $_POST["filter"], $_SESSION["ID"], $connection);
    echo json_encode($controller->userTests);
}
