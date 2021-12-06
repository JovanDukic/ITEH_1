<?php

require "../database/databaseManager.php";
require "../entity/User.php";

session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $user = new User(null, $_POST["username"], $_POST["password"]);

    $rs = User::login($user, $connection);

    if (!empty($rs) && $rs->num_rows > 0) {
        while ($row = $rs->fetch_array()) {
            $_SESSION["ID"] = $row["ID"];
            header("Location: home.");
            exit();
        }
    } else {
        echo "User does not exists!";
    }
}
