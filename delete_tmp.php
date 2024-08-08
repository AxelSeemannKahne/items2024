<?php


function deleteFilesFromDirectory($ordnername)
{

    echo "Lösche " . $ordnername . "<br>";


    if (is_dir($ordnername)) {

        if ($dh = opendir($ordnername)) {

            while (($file = readdir($dh)) !== false) {

                if ($file != "." and $file != "..") {

                    unlink("" . $ordnername . "" . $file . "");
                }
            }
            closedir($dh);
        }
    }
}


$basedir = $_SERVER['DOCUMENT_ROOT'];

//Funktionsaufruf - Directory immer mit endendem / angeben
deleteFilesFromDirectory($basedir . "/shop/tmp/");
deleteFilesFromDirectory($basedir . "/shop/tmp/container/");
deleteFilesFromDirectory($basedir . "/shop/tmp/modules/");
deleteFilesFromDirectory($basedir . "/shop/tmp/template_cache/");


?>