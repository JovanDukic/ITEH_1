<?php

session_start();

if (isset($_POST["userID"])) {
    $_SESSION["userID"] = $_POST["userID"];
    echo "success";
}
