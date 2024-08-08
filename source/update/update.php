<?php


namespace update;
use mysqli;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

class Update
{

    function migrateTable($table, $excluded_fields)
    {
        $mysqliGet = $this->getLiveConnection();
        $data = $this->getTableContentAndFields($mysqliGet, $table, $excluded_fields);
        $mysqliGet->close();
        $mysqliSet = $this->getUpdateConnection();
        $this->writeData($mysqliSet, $data, $table);
        $mysqliSet->close();
    }

    function writeData($mysqliSet, $data, $table)
    {

        $query = "TRUNCATE " . $table;
        $mysqliSet->query($query);
        $counter = 0;
        foreach ($data['content'] as $row) {
            $sql = "INSERT INTO " . $table . " (" . $this->generateFieldList($data['fields']) . ") VALUES (" . $this->generateValueList($data['fields'], $row) . ")";
            $mysqliSet->query($sql) or die($sql);
            $counter++;
        }
        echo $counter . " rows inserted in " . $table . "<br>";
    }

    function generateFieldList($fields)
    {

        $string = "";

        foreach ($fields as $field) {
            $string .= $field . ", ";
        }
        return substr($string, 0, -2);
    }

    function generateValueList($fields, $row)
    {
        $string = "";

        foreach ($fields as $field) {
            $row[$field] = str_replace("'", "''", $row[$field]);
            $string .= "'" . $row[$field] . "', ";
        }
        return substr($string, 0, -2);
    }


    function getTableContentAndFields($mysqli, $table, $delete_keys)
    {

        $array=[];

        $query = "SELECT * from " . $table;
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $array['content'][] = $row;
            }
            $result->free();
        }


        foreach ($array['content'][0] as $key => $value) {
            $array['fields'][$key] = $key;
        }
        $delete_keys = explode(",", $delete_keys);
        foreach ($delete_keys as $delete_key) {
            unset ($array['fields'][$delete_key]);
        }
        asort($array['fields']);

        return $array;
    }


    function getLiveConnection()
    {
        //LIVE
        $mysqli = new mysqli(
            "localhost",
            "itenqoda3",
            "4o8$?wMU6fri",
            "usrdb_itenqoda3"
        );

        //DEV
        //$mysqli = new mysqli("localhost", "oxid1", "tunnel71!", "db253297_4" );

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        return $mysqli;
    }

    function getUpdateConnection()
    {
        $mysqli = new mysqli(
            "localhost",
            "itenqoda6",
            "0n3*I66&CG8r",
            "usrdb_itenqoda6"
        );

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        return $mysqli;
    }

}


?>