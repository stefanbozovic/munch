$("#dodajForm").submit(function (event) {
    event.preventDefault();
    const $form = $(this);
    const $inputs = $form.find("input, select, button");
    const $serializedData = $form.serialize();

    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
      json[name] = value;
      return json;
    }, {});
    console.log(obj);
    $inputs.prop("disabled", true);
  
});