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
        osveziRedoveAkcije(); 
      } else console.log("Akcija nije dodata " + response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
    });
});

function osveziRedoveAkcije() {
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
function otvoriIzmeniAkcijuSaPodacima(i,n,p){
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
    console.error("Nastala je sledeća greška: " + textStatus, errorThrown);
  });
});

function izmeniRed(obj) {
  let tds = $(`#tabelaAkcija tbody #tr-${obj.Id} td`).get();
  tds[1].textContent = obj.Naziv;
  tds[2].textContent = obj.ProcenatPopusta;
}


//BRISANJE AKCIJA
function otvoriObrisiAkcijuSaPodacima(i,n,p){
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
      alert("Akcija ne može biti obrisana zbog ograničenja: akcija_fk");
      
    }
  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeća greška " + textStatus, errorThrown);
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
    console.error("Nastala je sledeća greška: " + textStatus, errorThrown);
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
    console.error("Nastala je sledeća greška: " + textStatus, errorThrown);
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
      alert("Proizvod ne može biti obrisan");
    }
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
  });
});


function pretraziAkcije() {
  var inputA, filterA, tableA, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
  inputA = document.getElementById("myInputA");
  filterA = inputA.value.toUpperCase();
  tableA = document.getElementById("tabelaAkcija");
  tr = tableA.getElementsByTagName("tr");

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

          if (txtValue1.toUpperCase().indexOf(filterA) > -1 || txtValue2.toUpperCase().indexOf(filterA) > -1 ||
              txtValue3.toUpperCase().indexOf(filterA) > -1 || txtValue4.toUpperCase().indexOf(filterA) > -1) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
      }
  }
}

function pretraziProizvode() {
  var inputP, filterP, tableP, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
  inputP = document.getElementById("myInputP");
  filterP = inputP.value.toUpperCase();
  tableP = document.getElementById("tabelaProizvoda");
  tr = tableP.getElementsByTagName("tr");

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

          if (txtValue1.toUpperCase().indexOf(filterP) > -1 || txtValue2.toUpperCase().indexOf(filterP) > -1 ||
              txtValue3.toUpperCase().indexOf(filterP) > -1 || txtValue4.toUpperCase().indexOf(filterP) > -1) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
      }
  }
}

var zutoActive=0;
$( document ).ready(function() {
  zutoJeUkljuceno(document.getElementById("ZutoVrednost").innerHTML);
});

function zutoJeUkljuceno(defaultno){
  if(defaultno==1){
    zutoActive=0;
    $('.btn-zuto')[0].click();
  }
  else{
    zutoActive=0;
    $('body').css({'background-color': '#e6f7fe '});
  }
}
function zutoSvetlo(){
  if(zutoActive==1){//ako je ukljuceno iskljuci
    $('body').css({'background-color': '#e6f7fe '});
    zutoActive=0;
    document.cookie = "zuto=0";
    $('.btn-zuto').toggleClass("active");
  } 
  else{//ako je iskljuceno ukljuci
    $('body').css({'background-color': '#fff7e5'});
    zutoActive=1;
    document.cookie = "zuto=1";
    $('.btn-zuto').toggleClass("active");
    
  }
}