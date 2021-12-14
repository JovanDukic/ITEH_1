<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_POST["testID"])) {
    $controller = $_SESSION["controller"];
    $controller->deleteUserTest($_SESSION["userID"], $_POST["testID"], $connection);

    if ($connection->affected_rows > 0) {
        $controller->loadUserTests($_SESSION["userID"], $connection);
        echo json_encode($controller->userTests);
    } else {
        echo "failed";
    }
}
