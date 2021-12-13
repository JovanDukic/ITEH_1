<?php

require "../database/databaseManager.php";
require "../entity/User.php";

session_start();

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["age"]) && isset($_POST["gender"])) {
    $user = new User($_SESSION["ID"], $_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["age"], $_POST["gender"]);

    if (User::checkParams($user, $connection)) {
        echo "exists";
        exit();
    }

    $res = User::update($user, $connection);

    if ($res) {
        echo "success";
    } else {
        echo "failed";
    }
}
