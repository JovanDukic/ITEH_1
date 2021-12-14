<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["ID"]) && isset($_SESSION["admin"])) {
    Controller::getController()->loadUsers($connection);
    $_SESSION["controller"] = Controller::getController();
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
    <title>Admin</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/link.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/logout.js"></script>

</head>

<body>

    <div class="navbar">
        <a href="#" id="logout">LOGOUT</a>
    </div>

    <div class="container">

        <div class="title">Users</div>

        <div class="toolbar">
            <div class="ambulanceFilter">
                <div>
                    <label for="search">Search:</label>
                </div>
                <div class="search">
                    <input type="text" name="search" id="search">
                </div>
                <div class="filter">
                    <select id="filterValue">
                        <option value="firstname">Firstname</option>
                        <option value="lastname">Lastname</option>
                        <option value="age">Age</option>
                        <option value="gender">Gender</option>
                    </select>
                </div>
            </div>

            <div class="other">
                <div class="part">
                    <label>Sort criteria: </label>
                </div>

                <div class="part">
                    <label for="sortFirstname">firstname</label>
                    <input type="checkbox" name="sortFirstname" id="sortFirstname">
                </div>

                <div class="part">
                    <label for="sortLastname">lastname</label>
                    <input type="checkbox" name="sortLastname" id="sortLastname">
                </div>

                <div class="part">
                    <label for="sortAge">age</label>
                    <input type="checkbox" name="sortAge" id="sortAge">
                </div>

                <div class="part">
                    <label for="sortGender">gender</label>
                    <input type="checkbox" name="sortGender" id="sortGender">
                </div>
            </div>
        </div>

        <div class="data">
            <table id="table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (Controller::getController()->users as $user => $value) { ?>
                        <tr>
                            <td><?php echo $value->ID ?></td>
                            <td><?php echo $value->firstname ?></td>
                            <td><?php echo $value->lastname ?></td>
                            <td><?php echo $value->age ?></td>
                            <td><?php echo $value->gender ?></td>
                            <td><a href="#" class="delete">DELETE</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>