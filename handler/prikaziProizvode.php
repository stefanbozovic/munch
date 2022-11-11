<?php

require "../dbBroker.php";
require "../model/proizvod.php";
session_start();

$result = Proizvod::ucitaj($conn);
if (!$result) {
    echo "Greška kod upita<br>";
    die();
}
if ($result->num_rows == 0) {
    echo "Nema upisanih proizvoda";
    die();
}

?>

<?php  while ($red = $result->fetch_array()) { ?>
    <tr>
        <td><?php echo $red["proizvod_id"] ?></td>
        <td><?php echo $red["naziv_proizvoda"] ?></td>
        <td><?php echo $red["cena"] ?> din</td>
        <td><?php echo $red["naziv"]." (". $red["procenat_popusta"]."%)"?></td>
        <td><?php echo $red["cena"]*(1-$red["procenat_popusta"]/100)?> din</td>
        <td>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeniProizvod"
                    onclick="otvoriIzmeniProizvodSaPodacima(<?php echo $red["proizvod_id"] ?>,'<?php echo $red["naziv_proizvoda"] ?>',<?php echo $red["cena"] ?>,<?php echo $red["akcija_id"] ?>)">
                Izmeni 
            </button>
        </td>
        <td>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisiProizvod"
            onclick="otvoriObrisiProizvodSaPodacima(<?php echo $red["proizvod_id"] ?>,'<?php echo $red["naziv_proizvoda"] ?>',<?php echo $red["cena"] ?>,<?php echo $red["akcija_id"] ?>)">
                Obriši 
            </button>
        </td>
    </tr>
<?php
} ?>
