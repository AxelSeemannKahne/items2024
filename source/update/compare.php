<?php


namespace update;

include("update.php");

$compare = new Compare();
$compare->compareTables('oxobject2seodata');

class Compare
{


    public function compareTables($table)
    {

        $mysqliGet = (new Update)->getLiveConnection();
        $data1 = (new Update)->getTableContentAndFields($mysqliGet, $table, "");
        $mysqliGet->close();

        $mysqliSet = (new Update)->getUpdateConnection();
        $data2 = (new Update)->getTableContentAndFields($mysqliSet, $table, "");
        $mysqliSet->close();
        $this->outputDiff($data1, $data2, $table);
    }

    public function outputDiff($data1, $data2, $table)
    {

        $table_live = $data1;
        $table_update = $data2;

        foreach ($table_live['fields'] as $key => $row) {
            unset ($table_update['fields'][$row]);
        }

        echo "<pre>";
        echo "In der neuen Tabelle " . $table . " des UPDATE-Systems befinden sich die folgenden Felder, die auf dem LIVE-System noch nicht existierten:<br>";
        print_r($table_update['fields']);
        echo "</pre>";

        unset ($table_update);
        unset ($table_live);

        $table_live = $data1;
        $table_update = $data2;
        foreach ($table_update['fields'] as $key => $row) {
            unset ($table_live['fields'][$row]);
        }

        echo "<pre>";
        echo "In der alten Tabelle " . $table . " des LIVE-Systems befinden sich die folgenden Felder, die es auf dem UPDATE-System noch nicht gibt:<br>";
        print_r($table_live['fields']);
        echo "</pre>";

    }
}


?>