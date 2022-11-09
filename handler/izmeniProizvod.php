<?php
require "../dbBroker.php";
require "../model/proizvod.php";

if (isset($_POST['Naziv'])  && isset($_POST['Cena']) && isset($_POST['Akcija']))
{
    $status = Proizvod::izmeni( $_POST['Id'], $_POST['Naziv'], $_POST['Cena'], $_POST['Akcija'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
