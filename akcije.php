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
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php"> 
    <img class="munchlogo" src="assets/images/munchmallow_logo.png" alt="logo proizvoda Munchmallow">
    </a>
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Dobrodosli</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="proizvodi.php">Proizvodi</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link active" href="akcije.php">Akcije</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dodaj">
  Dodaj novu akciju
</button>


<div class="modal fade" id="dodaj" tabindex="-1" aria-labelledby="dodajLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="dodajLabel">Dodaj novi proizvod</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
        <button type="button" class="btn btn-primary">Dodaj</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="izmeni" tabindex="-1" aria-labelledby="izmeniLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="izmeniLabel">Izmeni proizvod</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
        <button type="button" class="btn btn-primary">Izmeni</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="obrisi" tabindex="-1" aria-labelledby="obrisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="obrisiLabel">Obrisi prozivod</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkazi</button>
        <button type="button" class="btn btn-primary">Obrisi</button>
      </div>
    </div>
  </div>
</div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Naziv</th>
      <th scope="col">Procenat popusta</th>
      <th scope="col">Imeni</th>
      <th scope="col">Obrisi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni">
           Izmeni 
        </button>
      </td>
      <td>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi">
            Obrisi 
      </button>
      </td>
      

    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni">
           Izmeni 
        </button>
      </td>
      <td>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi">
            Obrisi 
      </button>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni">
           Izmeni 
        </button>
      </td>
      <td>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi">
            Obrisi 
      </button>
      </td>
    </tr>
  </tbody>
</table>
    
</body>
</html>