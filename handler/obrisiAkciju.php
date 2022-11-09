<?php
require "../dbBroker.php";
require "../model/akcija.php";

$status = Akcija::obrisiPoIndeksu($_POST['Id'], $conn);
if ($status) {
    echo 'Success';
} else {
    echo $status;
    echo 'Failed';
}

