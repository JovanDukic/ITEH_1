<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["controller"]) && isset($_POST["flag"])) {
    $flag = $_POST["flag"];
    $controller = $_SESSION["controller"];

    if (strlen($flag) == 0) {
        echo json_encode($controller->userTests);
    } else {
        $controller->sortUserTests($flag);
        echo json_encode($controller->sortedArray);
    }
}
