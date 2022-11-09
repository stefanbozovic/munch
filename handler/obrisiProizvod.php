<?php
require "../dbBroker.php";
require "../model/proizvod.php";

$status = Proizvod::obrisiPoIndeksu($_POST['Id'], $conn);
if ($status) {
    echo 'Success';
} else {
    echo $status;
    echo 'Failed';
}