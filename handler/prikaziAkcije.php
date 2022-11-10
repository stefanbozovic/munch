<?php
require "../dbBroker.php";
require "../model/akcija.php";
session_start();

$result = Akcija::ucitaj($conn);
if (!$result) {
    echo "Greska kod upita<br>";
    die();
}
if ($result->num_rows == 0) {
    echo "Nema upisanih akcija";
    die();
}

?>

<?php  while ($red = $result->fetch_array()) { ?>
    <tr id="tr-<?php echo $red["akcija_id"] ?>">
        <td><?php echo $red["akcija_id"] ?></td>
        <td><?php echo $red["naziv"] ?></td>
        <td><?php echo $red["procenat_popusta"] ?> din</td>
        <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni" 
            onclick="otvoriModalIzmeniSaPodacima(<?php echo $red["akcija_id"] ?>,'<?php echo $red["naziv"] ?>',<?php echo $red["procenat_popusta"] ?>)">
                Izmeni 
            </button>
        </td>
        <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi"
            onclick="otvoriModalObrisiSaPodacima(<?php echo $red["akcija_id"] ?>,'<?php echo $red["naziv"] ?>',<?php echo $red["procenat_popusta"] ?>)">
                Obrisi 
            </button> 
        </td>
    </tr>
<?php
} ?>
    