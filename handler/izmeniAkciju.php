<?php
require "../dbBroker.php";
require "../model/akcija.php";

if (isset($_POST['Naziv'])  && isset($_POST['ProcenatPopusta']))
{
    $status = Akcija::izmeni( isset($_POST['Id']), $_POST['Naziv'], $_POST['ProcenatPopusta'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
