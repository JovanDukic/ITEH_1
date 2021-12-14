<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_POST["userID"])) {
    $controller = $_SESSION["controller"];
    $controller->deleteUser($_POST["userID"], $connection);

    if ($connection->affected_rows > 0) {
        $controller->loadUsers($connection);
        echo json_encode($controller->users);
    } else {
        echo "failed";
    }
}
