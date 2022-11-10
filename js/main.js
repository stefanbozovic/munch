//DODAVANJE AKCIJA
$("#dodajAkcijeForm").submit(function (event) {
    event.preventDefault();
    const $form = $(this);

    const $inputs = $form.find("input, select, button");
    const serializedData = $form.serialize();

    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
      json[name] = value;
      return json;
    }, {});
    $inputs.prop("disabled", true);
  
    request = $.ajax({
      url: "handler/dodajAkciju.php",
      type: "post",
      data: serializedData,
    });
  
    request.done(function (response, textStatus, jqXHR) {
      if (response === "Success") {
        alert("Akcija je dodata");
        $form[0].reset();//brisemo sve iz forme
        $inputs.prop("disabled", false); //oslobodjamo inpute 
        osveziRedoveAkcije(obj); 
      } else console.log("Akcija nije dodata " + response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
    });
});

function dodajRedAkcije(obj) {
  $.get("handler/uzmiPoslednjuAkciju.php", function (data) {
    $("#tabelaAkcija tbody").append(`
      <tr>
          <td>${data}</td>
          <td>${obj.Naziv}</td>
          <td>${obj.ProcenatPopusta}</td>
          <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#izmeni">
                  Izmeni 
              </button>
          </td>
          <td> <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#obrisi">
                      Obrisi 
              </button> 
          </td>
      </tr>
    `);
  });
};
function osveziRedoveAkcije(obj) {
  $("#tabelaAkcija tbody").empty();
  $.ajax({
    type:"GET",
    url:"handler/prikaziAkcije.php",
    dataType: "html",
    success: function (data){
      $("#tabelaAkcija tbody").html(data);
    }
  })
};
  
//IZMENA AKCIJA
function otvoriModalIzmeniSaPodacima(i,n,p){
  $("#izmeni").find("#id")[0].value = i;
  $("#izmeni").find("#naziv")[0].value = n;
  $("#izmeni").find("#procenat_popusta")[0].value = p;
};

$("#izmeniAkcijeForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);

  const $inputs = $form.find("input, select, button");
  const serializedData = $form.serialize();

  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/izmeniAkciju.php",
    type: "post",
    data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      alert("Akcija je izmenjena");
      $form[0].reset();//brisemo sve iz forme
      $inputs.prop("disabled", false); //oslobodjamo inpute 
      osveziRedoveAkcije(obj); 
      $("#izmeni").modal("toggle");
    } else console.log("Akcija nije izmenjena " + response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});

function izmeniRed(obj) {
  let tds = $(`#tabelaAkcija tbody #tr-${obj.Id} td`).get();
  tds[1].textContent = obj.Naziv;
  tds[2].textContent = obj.ProcenatPopusta;
}


//BRISANJE AKCIJA
function otvoriModalObrisiSaPodacima(i,n,p){
  $("#obrisi").find("#id")[0].value = i;
  $("#obrisi").find("#naziv")[0].value = n;
  $("#obrisi").find("#procenat_popusta")[0].value = p;
};

$("#obrisiAkcijeForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);

  const $inputs = $form.find("input");
  const serializedData = $form.serialize();

  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/obrisiAkciju.php",
    type: "post",
    data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      alert("Akcija je obrisana");
      osveziRedoveAkcije(obj); 
      $("#obrisi").modal("toggle");
    } else 
    {
      alert("Akcija ne moze biti obrisana zbog ogranicenja akcija_fk");
      
    }
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});


//DODAVANJE PROIZVODA
$("#dodajProizvodeForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);

  const $inputs = $form.find("input, select, button");
  const serializedData = $form.serialize();

  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/dodajProizvod.php",
    type: "post",
    data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      alert("Proizvod je dodat");
      $form[0].reset();//brisemo sve iz forme
      $inputs.prop("disabled", false); //oslobodjamo inpute 
      osveziRedoveProizvoda(obj); 
    } else console.log("Proizvod nije dodat " + response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});

function osveziRedoveProizvoda(obj) {
  $("#tabelaProizvoda tbody").empty();
  $.ajax({
    type:"GET",
    url:"handler/prikaziProizvode.php",
    dataType: "html",
    success: function (data){
      $("#tabelaProizvoda tbody").html(data);
    }
  })
};

//IZMENA PROIZVODA
function otvoriIzmeniProizvodSaPodacima(i,n,c,a){
  $("#izmeniProizvod").find("#id")[0].value = i;
  $("#izmeniProizvod").find("#naziv")[0].value = n;
  $("#izmeniProizvod").find("#cena")[0].value = c;
  $("#izmeniProizvod").find("#akcija")[0].value=a;
};

$("#izmeniProizvodeForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);

  const $inputs = $form.find("input, select, button");
  const serializedData = $form.serialize();

  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/izmeniProizvod.php",
    type: "post",
    data: serializedData,
  });
  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      alert("Proizvod je izmenjen");
      $form[0].reset();//brisemo sve iz forme
      $inputs.prop("disabled", false); //oslobodjamo inpute 
      osveziRedoveProizvoda(obj);
      $("#izmeniProizvod").modal("toggle");
    } else console.log("Proizvod nije izmenjen " + response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});

//BRISANJE PROIZVODA
function otvoriObrisiProizvodSaPodacima(i,n,c,a){
  $("#obrisiProizvod").find("#id")[0].value = i;
  $("#obrisiProizvod").find("#naziv")[0].value = n;
  $("#obrisiProizvod").find("#cena")[0].value = c;
  $("#obrisiProizvod").find("#akcija")[0].value = a;
};


$("#obrisiProizvodeForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);

  const $inputs = $form.find("input");
  const serializedData = $form.serialize();

  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/obrisiProizvod.php",
    type: "post",
    data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      alert("Proizvod je obrisan");
      osveziRedoveProizvoda(obj); 
      $("#obrisiProizvod").modal("toggle");
    } else 
    {
      alert("Proizvod ne moze biti obrisan");
    }
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});


function pretraziAkcije() {
  var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelaAkcija");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];

      if (td1 || td2 || td3 || td4) {
          txtValue1 = td1.textContent || td1.innerText;
          txtValue2 = td2.textContent || td2.innerText;
          txtValue3 = td3.textContent || td3.innerText;
          txtValue4 = td4.textContent || td4.innerText;

          if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 ||
              txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
      }
  }
}

function pretraziProizvode() {
  var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelaProizvoda");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];

      if (td1 || td2 || td3 || td4) {
          txtValue1 = td1.textContent || td1.innerText;
          txtValue2 = td2.textContent || td2.innerText;
          txtValue3 = td3.textContent || td3.innerText;
          txtValue4 = td4.textContent || td4.innerText;

          if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 ||
              txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
      }
  }
}


