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
        dodajRed(obj); 
      } else console.log("Akcija nije dodata " + response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
    });
});


function dodajRed(obj) {
  
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
  }