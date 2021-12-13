<?php

session_start();

if (isset($_POST["flag"]) && $_POST["flag"] = "logout") {
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    $_SESSION = array();
    echo "success";
}
