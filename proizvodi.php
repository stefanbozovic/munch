<?php

require "dbBroker.php";
require "model/proizvod.php";
require "model/akcija.php";
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

$resultAkcija = Akcija::ucitaj($conn);
if (!$resultAkcija) {
    echo "Greska kod upita<br>";
    die();
}
if ($resultAkcija->num_rows == 0) {
    echo "Nema upisanih akcija";
    die();
}


$resultAkcija2 = Akcija::ucitaj($conn);
if (!$resultAkcija2) {
    echo "Greska kod upita<br>";
    die();
}
if ($resultAkcija2->num_rows == 0) {
    echo "Nema upisanih akcija";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munchmallow</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light mb-3 ">
  <div class="container-md ">
    <a class="navbar-brand" href="index.php"> 
        <img class="munchlogo" src="assets/images/munchmallow_logo.png" alt="logo proizvoda Munchmallow">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 " id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Dobrodosli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="akcije.php">Akcije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="proizvodi.php">Proizvodi</a>
        </li> 
      </ul>
    </div>
  </div>
</nav>
<div class="container-md ">
  <div class="d-flex justify-content-between mb-4 mt-4">
    <h1>Proizvodi</h1>
    <div class="input-group flex-nowrap w-250">
      <span class="input-group-text" id="addon-wrapping">
      <svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </span>
      <input type="text" id="myInput" class="btn bg-light border border-secondary" placeholder="Pretrazi proizvode" aria-describedby="addon-wrapping" onkeyup="pretraziProizvode()">
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodaj">
      Dodaj novi proizvod
    </button>
  </div>


  <div class="modal fade" id="dodaj" tabindex="-1" aria-labelledby="dodajLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
      <div class="modal-content">
      <form action="#" method="post" id="dodajProizvodeForm">
          <div class="modal-header">
          <h1 class="modal-title fs-5" id="dodajLabel">Dodaj novi proizvod</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="naziv" class="form-label">Naziv</label>
              <input type="text" class="form-control" name="Naziv" id="naziv">
          </div>
          <div class="mb-3">
              <label for="cena" class="form-label">Cena</label>
              <input type="text" class="form-control" name="Cena" id="cena">
          </div>
          <div class="mb-3">
              <label for="akcija" class="form-label">Akcija(id)</label>
              <select class="form-select" aria-label="Default select example" name="Akcija" id="akcija">
                <option selected>Izaberi vrstu akcije:</option>
                <?php while ($red = $resultAkcija->fetch_array()) { ?>
                  <option value="<?php echo $red["akcija_id"] ?>"><?php echo $red["naziv"] ?> <?php echo $red["procenat_popusta"] ?></option>
                <?php
                } ?>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
          <button  id="btnDodajP"  type="submit" class="btn btn-primary">Dodaj</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="izmeniProizvod" tabindex="-1" aria-labelledby="izmeniLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
      <div class="modal-content">
        <form action="#" method="post" id="izmeniProizvodeForm">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="izmeniLabel">Izmeni proizvod</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body izmeniovde">
            <div class="row">
                <div class="mb-3">
                    <label for="naziv" class="form-label">Id</label>
                    <input type="text" class="form-control bg-light" name="Id" id="id" readonly >
                </div>
                <div class="mb-3">
                    <label for="naziv" class="form-label">Naziv</label>
                    <input type="text" class="form-control" name="Naziv" id="naziv">
                </div>
                <div class="mb-3">
                    <label for="cena" class="form-label">Cena</label>
                    <input type="text" class="form-control" name="Cena" id="cena">
                </div>
              
                <div class="mb-3">
                    <label for="akcija" class="form-label">Akcija(id)</label>
                    <select class="form-select" aria-label="Default select example" name="Akcija" id="akcija">
                      <option>Izaberi vrstu akcije:</option>
                    
                      <?php while ($red = $resultAkcija2->fetch_array()) { ?>
                        <option value="<?php echo $red["akcija_id"] ?>"><?php echo $red["naziv"] ?> <?php echo $red["procenat_popusta"] ?></option>
                      <?php
                      } ?>
                    </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
            <button id="btnIzmeniP" type="submit" class="btn btn-success btn-block btn-warning"> Izmeni
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="obrisiProizvod" tabindex="-1" aria-labelledby="obrisiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
      <div class="modal-content">
      <form action="#" method="post" id="obrisiProizvodeForm"> 
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="obrisiLabel">Obrisi proizvod</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body obrisiovde">
          <div class="row">
            <div class="mb-3">
                <label for="naziv" class="form-label">Id</label>
                <input type="text" class="form-control bg-light" name="Id" id="id" readonly >
            </div>
            <div class="mb-3">
                <label for="naziv" class="form-label">Naziv</label>
                <input type="text" class="form-control bg-light" name="Naziv" id="naziv" readonly>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena</label>
                <input type="text" class="form-control bg-light" name="Cena" id="cena" readonly>
            </div>
            <div class="mb-3">
                <label for="akcija" class="form-label">Akcija</label>
                <input type="text" class="form-control bg-light" name="Akcija" id="akcija" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
          <button id="btnObrisiP" type="submit" class="btn btn-success btn-block btn-danger" >Obrisi
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <table id="tabelaProizvoda" class="table table-hover">
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
      <?php while ($red = $result->fetch_array()) { ?>
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
                      Obrisi 
                  </button>
            </td>
          </tr>
      <?php
      } ?>
    </tbody>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>