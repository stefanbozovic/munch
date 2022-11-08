$("#dodajAkcijeForm").submit(function (event) {
    event.preventDefault();
    const $form = $(this);

    const $inputs = $form.find("input, select, button");
    const serializedData = $form.serialize();

    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
      json[name] = value;
      return json;
    }, {});
    console.log(obj);
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
        $inputs.prop("disabled", false); //oslobodjavamo inpute 
      } else console.log("Akcija nije dodata " + response);
      console.log(response);
    });
  
    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Nastala je sledeca greska: " + textStatus, errorThrown);
    });
});

