<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["ID"])) {
    $user = $_SESSION["controller"]->loadUser($_SESSION["ID"], $connection);
    $gender = array("male", "female");
} else {
    header("Location: ../pages/login.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/profile.js"></script>
    <script src="../js/logout.js"></script>
</head>

<body>

    <div class="navbar">
        <a href="home.php">HOMEPAGE</a>
        <a href="test.php">TESTING</a>
        <a href="#" id="logout">LOGOUT</a>
    </div>

    <div class="container">

        <div class="title">Profile Info</div>

        <form action="#" method="POST" id="form">
            <div class="content">

                <label for="search">Username: </label>
                <input type="text" name="username" id="username" value="<?php echo $user->username ?>" disabled>
                <input type="checkbox" value="usernameBox" id="usernameBox">

                <label for="search">Password: </label>
                <input type="password" name="password" id="password" value="<?php echo $user->password ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" disabled>
                <input type="checkbox" value="passwordBox" id="passwordBox">

                <label for="search">Firsname: </label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstname ?>" disabled>
                <input type="checkbox" value="firstnameBox" id="firstnameBox">

                <label for="search">Lastname: </label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastname ?>" disabled>
                <input type="checkbox" value="lastnameBox" id="lastnameBox">

                <label for="search">Age: </label>
                <input type="text" name="age" id="age" value="<?php echo $user->age ?>" disabled>
                <input type="checkbox" value="ageBox" id="ageBox">

                <label for="gender">Gender:</label>
                <select name="gender" id="gender" disabled>
                    <?php foreach ($gender as $g) { ?>
                        <option value="<?php echo $g ?>" <?php if ($g == $user->gender) echo "selected" ?>><?php echo $g ?></option>
                    <?php } ?>
                </select>
                <input type="checkbox" value="genderBox" id="genderBox">

                <div class="submit-div">
                    <input type="submit" name="submit" id="submit" value="SAVE">
                </div>
            </div>
        </form>

    </div>

    <div class="footer"></div>

</body>


</html>