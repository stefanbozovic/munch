<?php
require "../dbBroker.php";
require "../model/akcija.php";


$status = Akcija::uzmiPoslednju($conn);

if ($status) {
    while ($red = $status->fetch_array()) { 
        echo $red["akcija_id"];
    }
} else {
    echo $status;
    echo 'Failed';
}
