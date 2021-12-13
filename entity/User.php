<?php

class User
{
    public $ID;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $age;
    public $gender;

    public function __construct($ID = null, $username = null, $password = null, $firstname = null, $lastname = null, $age = null, $gender = null)
    {
        $this->ID = $ID;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->gender = $gender;
    }

    public static function register(User $user, mysqli $connection)
    {
        $query = "INSERT INTO USER (username, password, firstname, lastname, age, gender) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("ssssis", $user->username, $user->password, $user->firstname, $user->lastname, $user->age, $user->gender);

        return $stmt->execute();
    }

    public static function checkParams(User $user, mysqli $connection)
    {
        $query = "SELECT * FROM USER WHERE username = ?";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("s", $user->username);

        $stmt->execute();

        $rs = $stmt->get_result();

        return !empty($rs) && $rs->num_rows > 0;
    }

    public static function login(User $user, mysqli $connection)
    {
        $query = "SELECT ID FROM USER WHERE username = ? AND password = ?";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("ss", $user->username, $user->password);

        $stmt->execute();

        return $stmt->get_result();
    }

    public static function update(User $user, mysqli $connection)
    {
        $query = "UPDATE USER SET username = ?, password = ?, firstname = ?, lastname = ?, age = ?, gender = ? WHERE ID = ?";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("ssssisi", $user->username, $user->password, $user->firstname, $user->lastname, $user->age, $user->gender, $user->ID);

        return $stmt->execute();
    }

    public static function getUser($userID, mysqli $connection)
    {
        $query = "SELECT * FROM USER WHERE ID = '$userID'";

        $rs = $connection->query($query);

        $user = null;

        if (!empty($rs) && $rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                $user = new User($row["ID"], $row["username"], $row["password"], $row["firstname"], $row["lastname"], $row["age"], $row["gender"]);
            }
        }

        return $user;
    }

    public static function getGeneratedKey(mysqli $connection)
    {
        $query = "SELECT LAST_INSERT_ID() AS ID";

        return $connection->query($query);
    }
}
