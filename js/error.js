function validateForms() {

    let z = document.forms["form"]["denied"].value;
    if (z == "") {
      alert("please select faculty:");
      return false;
    }
  }