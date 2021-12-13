<?php

class CovidTest
{

    public $ID;
    public $type;

    public function __construct($ID = null, $type = null)
    {
        $this->ID = $ID;
        $this->type = $type;
    }

    public static function loadCovidTests(mysqli $connection)
    {
        $query = "SELECT * FROM CovidTest";

        $rs = $connection->query($query);

        $covidTests = array();

        if (!empty($rs) && $rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                array_push($covidTests, new CovidTest($row["ID"], $row["type"]));
            }
        }

        return $covidTests;
    }

    public static function getTypeFromID($ID)
    {
        switch ($ID) {
            case 1:
                return "quick";
            case 2:
                return "pcr";
            default:
                return "error";
        }
    }

    public static function getIDFromType($type)
    {
        switch ($type) {
            case "quick":
                return "1";
            case "pcr":
                return "2";
            default:
                return "error";
        }
    }
}
