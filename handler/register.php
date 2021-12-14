<?php

require "../database/databaseManager.php";
require "../entity/User.php";

session_start();

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["age"]) && isset($_POST["gender"])) {
    $user = new User(null, $_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["age"], $_POST["gender"]);

    if (User::checkParams($user->username, $connection)) {
        echo "exists";
        exit();
    }

    $res = User::register($user, $connection);

    if ($res) {
        $rs = User::getGeneratedKey($connection);

        if (!empty($rs) && $rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                $_SESSION["ID"] = $row["ID"];
                echo "success";
            }
        } else {
            echo "failed";
        }
    } else {
        echo "failed";
    }
}
