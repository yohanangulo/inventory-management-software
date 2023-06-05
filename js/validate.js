const stock = document.querySelector("#id_stock");
const ageInput = document.querySelector('#id_age')

// validate available stock
if (stock) stock.addEventListener("keypress", (e) => validate(e));

// Validate age in add-seller.php
if (ageInput) ageInput.addEventListener('keypress', e => validate(e))

function validate(evt) {
  var theEvent = evt || window.event;
  if (theEvent.type === "paste") {
    key = event.clipboardData.getData("text/plain");
  } else {
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }

  if (stock) regex = /[0-9\.]/;
  else if (ageInput) regex = /[0-9]/

  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }


  if (stock && stock.value.includes(".") && key == ".") theEvent.preventDefault();
  if (ageInput && ageInput.value.length > 1) theEvent.preventDefault();
}

