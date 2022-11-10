
<?php

require "dbBroker.php";
require "model/akcija.php";
session_start();

if (isset($_COOKIE['zuto'])){
  echo "<h2 id='ZutoVrednost'>" . $_COOKIE['zuto'] . "</h2>";
}
else{
  setcookie("zuto", 0);
  echo "<h2>Cookie is now set to zuto 0 </h2>";
}

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munchmallow</title>
  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Dobrodosli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="akcije.php">Akcije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="proizvodi.php">Proizvodi</a>
        </li> 
        <button type="button" id="btn-zuto" class="btn btn-zuto" data-bs-toggle="button" autocomplete="off" aria-pressed="true" onclick="zutoSvetlo();"> 
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.01 20c-5.065 0-9.586-4.211-12.01-8.424 2.418-4.103 6.943-7.576 12.01-7.576 5.135 0 9.635 3.453 11.999 7.564-2.241 4.43-6.726 8.436-11.999 8.436zm-10.842-8.416c.843 1.331 5.018 7.416 10.842 7.416 6.305 0 10.112-6.103 10.851-7.405-.772-1.198-4.606-6.595-10.851-6.595-6.116 0-10.025 5.355-10.842 6.584zm10.832-4.584c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 1c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4z"/></svg>        </button>
      </ul>
    </div>
  </div>
</nav>
<div class="container-md">
  <div class="d-flex justify-content-between  mb-5 mt-5">  
    <h1>Akcije</h1>
    <div class="input-group flex-nowrap w-250">
      <span class="input-group-text" id="addon-wrapping">
      <svg width="20" height="20" class="DocSearch-Search-Icon" viewBox="0 0 20 20"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </span>
      <input type="text" id="myInput" class="btn bg-light border pretaziborder" placeholder="Pretrazi akcije" aria-describedby="addon-wrapping" onkeyup="pretraziAkcije()">
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
              <input type="text" class="form-control" name="Naziv" id="naziv">
          </div>
          <div class="mb-3">
              <label for="procenat_popusta" class="form-label">Procenat popusta</label>
              <input type="text" class="form-control" name="ProcenatPopusta" id="procenat_popusta">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
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
                  <input type="text" class="form-control" name="Naziv" id="naziv">
              </div>
              <div class="mb-3">
                  <label for="procenat_popusta" class="form-label">Procenat popusta</label>
                  <input type="text" class="form-control" name="ProcenatPopusta" id="procenat_popusta">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
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
          <h1 class="modal-title fs-5" id="obrisiLabel">Obrisi akciju</h1>
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
                  <input type="text" class="form-control bg-light" name="ProcenatPopusta" id="procenat_popusta" readonly>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
          <button id="btnObrisi" type="submit" class="btn btn-success btn-block btn-danger" >Obrisi
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
  
  <p class="text-muted">
    <span class="badge rounded-pill text-bg-secondary">?</span>
    Klikom na naziv kolone mozete izvrsiti sortiranje.
  </p>
  <table class="table table-hover sortable" id="tabelaAkcija">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Naziv</th>
        <th scope="col">Procenat popusta</th>
        <th scope="col">Izmeni</th>
        <th scope="col">Obrisi</th>
      </tr>
    </thead>
    <tbody>
        <?php while ($red = $result->fetch_array()) { ?>
          <tr id="tr-<?php echo $red["akcija_id"] ?>">
              <td><?php echo $red["akcija_id"] ?></td>
              <td><?php echo $red["naziv"] ?></td>
              <td><?php echo $red["procenat_popusta"] ?></td>
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
    </tbody>
  </table>
</div>   
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>