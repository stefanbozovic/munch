<?php
require "../dbBroker.php";
require "../model/proizvod.php";


$status = Proizvod::uzmiPoslednji($conn);

if ($status) {
    while ($red = $status->fetch_array()) { 
        echo $red["akcija_id"];
    }
} else {
    echo $status;
    echo 'Failed';
}
