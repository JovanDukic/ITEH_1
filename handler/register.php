<?php

require "../database/databaseManager.php";
require "../entity/User.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["age"]) && isset($_POST["gender"])) {
    $user = new User(null, $_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["age"], $_POST["gender"]);

    $res = User::register($user, $connection);

    if ($res) {
        echo "success";
    } else {
        echo "failed";
    }
}
