<?php

class User
{
    private $ID;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $age;
    private $gender;

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

    public static function login(User $user, mysqli $connection)
    {
    }
}
