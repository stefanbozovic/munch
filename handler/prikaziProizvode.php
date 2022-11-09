<?php

require "../dbBroker.php";
require "../model/proizvod.php";
session_start();

$result = Proizvod::ucitaj($conn);
if (!$result) {
    echo "Greska kod upita<br>";
    die();
}
if ($result->num_rows == 0) {
    echo "Nema upisanih proizvoda";
    die();
}

?>

  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Naziv</th>
      <th scope="col">Cena</th>
      <th scope="col">Akcija i popust</th>
      <th scope="col">Cena sa popustom</th>
      <th scope="col">Izmeni</th>
      <th scope="col">Obrisi</th>
    </tr>
  </thead>
  <tbody>
    <?php  while ($red = $result->fetch_array()) { ?>
        <tr>
            <td><?php echo $red["proizvod_id"] ?></td>
            <td><?php echo $red["naziv_proizvoda"] ?></td>
            <td><?php echo $red["cena"] ?> din</td>
            <td><?php echo $red["naziv"]." (". $red["procenat_popusta"]."%)"?></td>
            <td><?php echo $red["cena"]*(1-$red["procenat_popusta"]/100)?> din</td>
            <td>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeniProizvod">
                    Izmeni 
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisiProizvod">
                    Obrisi 
                </button>
           </td>
        </tr>
    <?php
    } ?>
  </tbody>
    