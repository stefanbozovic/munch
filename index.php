
<?php

require "dbBroker.php";
require "model/proizvod.php";
require "model/akcija.php";
session_start();

if (isset($_COOKIE['zuto'])){
  echo "<h2 id='ZutoVrednost'>" . $_COOKIE['zuto'] . "</h2>";
}
else{
  setcookie("zuto", 0);
  echo "<h2 id='ZutoVrednost'>" . $_COOKIE['zuto'] . "</h2>";
}

$resultAkcija0 = Akcija::ucitaj($conn);
if (!$resultAkcija0) {
    echo "Greška kod upita<br>";
    die();
}
if ($resultAkcija0->num_rows == 0) {
    echo "Nema upisanih akcija";
    die();
}

$result = Proizvod::ucitaj($conn);
if (!$result) {
    echo "Greška kod upita<br>";
    die();
}
if ($result->num_rows == 0) {
    echo "Nema upisanih proizvoda";
    die();
}

$resultAkcija = Akcija::ucitaj($conn);
if (!$resultAkcija) {
    echo "Greška kod upita<br>";
    die();
}
if ($resultAkcija->num_rows == 0) {
    echo "Nema upisanih akcija";
    die();
}

$resultAkcija2 = Akcija::ucitaj($conn);
if (!$resultAkcija2) {
    echo "Greška kod upita<br>";
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg mb-3">
  <div class="container-md">
  <a class="navbar-brand" href="index.php"> 
    <img class="munchlogo" src="assets/images/munchmallow_logo.png" alt="logo proizvoda Munchmallow">
    </a>
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav  nav-pills mb-3  me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end" id="pills-tab" role="tablist">
        <li class="nav-item me-1 "  role="presentation">
          <button class="nav-link active mobileresponsive" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Početak</button>
        </li>
        <li class="nav-item me-1 " role="presentation">
          <button class="nav-link mobileresponsive" id="pills-akcije-tab" data-bs-toggle="pill" data-bs-target="#pills-akcije" type="button" role="tab" aria-controls="pills-akcije" aria-selected="false">Akcije</button>
        </li>
        <li class="nav-item me-1 " role="presentation">
          <button class="nav-link mobileresponsive" id="pills-proizvodi-tab" data-bs-toggle="pill" data-bs-target="#pills-proizvodi" type="button" role="tab" aria-controls="pills-proizvodi" aria-selected="false">Proizvodi</button>
        </li>
        <li class="nav-item me-1 d-flex justify-content-center" role="presentation">
          <button type="button" id="btn-zuto" class="btn btn-zuto " data-bs-toggle="button" autocomplete="off" aria-pressed="true" onclick="zutoSvetlo();"> 
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.01 20c-5.065 0-9.586-4.211-12.01-8.424 2.418-4.103 6.943-7.576 12.01-7.576 5.135 0 9.635 3.453 11.999 7.564-2.241 4.43-6.726 8.436-11.999 8.436zm-10.842-8.416c.843 1.331 5.018 7.416 10.842 7.416 6.305 0 10.112-6.103 10.851-7.405-.772-1.198-4.606-6.595-10.851-6.595-6.116 0-10.025 5.355-10.842 6.584zm10.832-4.584c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 1c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4z"/></svg>     
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-md">
<div class="tab-content" id="pills-tabContent">
  
<!-- HOME -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="d-flex justify-content-between  mb-5 mt-5">  
      <h1>Dobrodošli u komandnu tablu</h1>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="card velikekartice  text-bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Uređujte akcije</h5>
            <p class="card-text">Dodajte nove akcije, izmenite ili obrišite postojeće.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card velikekartice text-bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Uređujte proizvode</h5>
            <p class="card-text">Dodajte nove proizvode, izmenite ili obrišite postojeće.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="card malekartice text-bg-light mb-3" >
          <div class="card-header">Novo</div>
          <div class="card-body">
            <h5 class="card-title">Sortiranje</h5>
            <p class="card-text">Klikom na naziv kolone možete sortirati tabelu.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card malekartice text-bg-light mb-3">
          <div class="card-header">Savet</div>
          <div class="card-body">
            <h5 class="card-title">Žuto svetlo</h5>
            <p class="card-text">Klikom na dugme u gornjem desnom uglu možete uključiti žuto svetlo.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card malekartice text-bg-light mb-3" >
          <div class="card-header">Misao dana</div>
          <div class="card-body">
            <h5 class="card-title">Živimo taj sladak život!</h5>
            <p class="card-text">-Ljubitelji naših proizvoda.</p>
          </div>
        </div>
      </div>
    </div>
    
  </div>
<!-- AKCIJE -->
  <div class="tab-pane fade" id="pills-akcije" role="tabpanel" aria-labelledby="pills-akcije-tab" tabindex="0">
      <div class="d-flex justify-content-between  mb-5 mt-5">  
          <h1>Akcije</h1>
          <div class="input-group flex-nowrap w-250">
            <span class="input-group-text" id="addon-wrapping">
            <svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </span>
            <input type="text" id="myInputA" class="btn bg-light border pretaziborder" placeholder="Pretraži akcije" aria-describedby="addon-wrapping" onkeyup="pretraziAkcije()">
          </div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodaj">
            Dodaj novu akciju
          </button>
      </div>
      <div class="modal fade" id="dodaj" tabindex="-1" aria-labelledby="dodajLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
          <div class="modal-content">
            <form  action="#" method="post" id="dodajAkcijeForm">
              <div class="modal-header">
              <h1 class="modal-title fs-5" id="dodajLabel">Dodaj novu akciju</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                  <label for="naziv" class="form-label">Naziv</label>
                  <input type="text" class="form-control" name="Naziv" id="naziv" required>
              </div>
              <div class="mb-3">
                  <label for="procenat_popusta" class="form-label">Procenat popusta</label>
                  <input type="number" class="form-control" name="ProcenatPopusta" id="procenat_popusta" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
              <button  id="btnDodaj"  type="submit" class="btn btn-primary">Dodaj</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="izmeni" tabindex="-1" aria-labelledby="izmeniLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
          <div class="modal-content">
          <form action="#" method="post" id="izmeniAkcijeForm">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="izmeniLabel">Izmeni akciju</h1>
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
                      <input type="text" class="form-control" name="Naziv" id="naziv" required>
                  </div>
                  <div class="mb-3">
                      <label for="procenat_popusta" class="form-label">Procenat popusta</label>
                      <input type="number" class="form-control" name="ProcenatPopusta" id="procenat_popusta" required>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
              <button id="btnIzmeni" type="submit" class="btn btn-success btn-block btn-warning"> Izmeni
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="obrisi" tabindex="-1" aria-labelledby="obrisiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
          <div class="modal-content">
          <form action="#" method="post" id="obrisiAkcijeForm"> 
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="obrisiLabel">Obriši akciju</h1>
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
                      <label for="procenat_popusta" class="form-label">Procenat popusta</label>
                      <input type="number" class="form-control bg-light" name="ProcenatPopusta" id="procenat_popusta" readonly>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
              <button id="btnObrisi" type="submit" class="btn btn-success btn-block btn-danger" >Obriši
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <p class="text-muted">
        <span class="badge rounded-pill text-bg-secondary">?</span>
        Klikom na naziv kolone možete izvršiti sortiranje.
      </p>
      <table class="table table-hover sortable" id="tabelaAkcija">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Naziv</th>
            <th scope="col">Procenat popusta</th>
            <th scope="col">Izmeni</th>
            <th scope="col">Obriši</th>
          </tr>
        </thead>
        <tbody>
            <?php while ($red = $resultAkcija0->fetch_array()) { ?>
              <tr id="tr-<?php echo $red["akcija_id"] ?>">
                  <td><?php echo $red["akcija_id"] ?></td>
                  <td><?php echo $red["naziv"] ?></td>
                  <td><?php echo $red["procenat_popusta"] ?></td>
                  <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni" 
                      onclick="otvoriIzmeniAkcijuSaPodacima(<?php echo $red["akcija_id"] ?>,'<?php echo $red["naziv"] ?>',<?php echo $red["procenat_popusta"] ?>)">
                          Izmeni 
                      </button>
                  </td>
                  <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi"
                      onclick="otvoriObrisiAkcijuSaPodacima(<?php echo $red["akcija_id"] ?>,'<?php echo $red["naziv"] ?>',<?php echo $red["procenat_popusta"] ?>)">
                          Obriši 
                      </button> 
                  </td>
              </tr>
          <?php
          } ?>
        </tbody>
      </table>
  </div>
<!-- PROIZVODI -->
  <div class="tab-pane fade" id="pills-proizvodi" role="tabpanel" aria-labelledby="pills-proizvodi-tab" tabindex="0">
    <div class="d-flex justify-content-between mb-5 mt-5">
      <h1>Proizvodi</h1>
      <div class="input-group flex-nowrap w-250">
        <span class="input-group-text" id="addon-wrapping">
        <svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        </span>
        <input type="text" id="myInputP" class="btn bg-light border pretaziborder" placeholder="Pretraži proizvode" aria-describedby="addon-wrapping" onkeyup="pretraziProizvode()">
      </div>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodajP">
        Dodaj novi proizvod
      </button>
    </div>
    <div class="modal fade" id="dodajP" tabindex="-1" aria-labelledby="dodajLabel" aria-hidden="true">
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
                <input type="text" class="form-control" name="Naziv" id="naziv" required>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena</label>
                <input type="number" class="form-control" name="Cena" id="cena" required>
            </div>
            <div class="mb-3">
                <label for="akcija" class="form-label">Akcija(id)</label>
                <select class="form-select" aria-label="Default select example" name="Akcija" id="akcija"  required> 
                  <option selected value="">Izaberi vrstu akcije:</option>
                  <?php while ($red = $resultAkcija->fetch_array()) { ?>
                    <option value="<?php echo $red["akcija_id"] ?>"><?php echo $red["naziv"] ?> <?php echo $red["procenat_popusta"] ?></option>
                  <?php
                  } ?>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
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
                      <input type="number" class="form-control" name="Cena" id="cena">
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
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
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
            <h1 class="modal-title fs-5" id="obrisiLabel">Obriši proizvod</h1>
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
                  <input type="number"  class="form-control bg-light" name="Cena" id="cena" readonly>
              </div>
              <div class="mb-3">
                  <label for="akcija" class="form-label">Akcija</label>
                  <input type="text" class="form-control bg-light" name="Akcija" id="akcija" readonly>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
            <button id="btnObrisiP" type="submit" class="btn btn-success btn-block btn-danger" >Obriši
            </button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <p class="text-muted">
      <span class="badge rounded-pill text-bg-secondary">?</span>
      Klikom na naziv kolone možete izvršiti sortiranje.
    </p>
    <table id="tabelaProizvoda" class="table table-hover sortable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Naziv</th>
          <th scope="col">Cena</th>
          <th scope="col">Akcija i popust</th>
          <th scope="col">Cena sa popustom</th>
          <th scope="col">Izmeni</th>
          <th scope="col">Obriši</th>
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
                        Obriši 
                    </button>
              </td>
            </tr>
        <?php
        } ?>
      </tbody>
    </table>
  </div>

  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>