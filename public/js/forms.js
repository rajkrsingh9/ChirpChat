document.getElementById("userType").addEventListener("change", function () {
  var userType = this.value;
  var spocFields = document.getElementById("spocFields");
  var collegeName = document.getElementById("collegeName");
  var collegeId = document.getElementById("collegeId");
  var designation = document.getElementById("designation");
  var address = document.getElementById("address");
  var city = document.getElementById("city");
  var state = document.getElementById("state");
  var zipCode = document.getElementById("zipCode");
  var authLetter = document.getElementById("authLetter");

  if (userType === "spoc") {
    collegeName.setAttribute("required", "required");
    collegeId.setAttribute("required", "required");
    designation.setAttribute("required", "required");
    address.setAttribute("required", "required");
    city.setAttribute("required", "required");
    state.setAttribute("required", "required");
    zipCode.setAttribute("required", "required");
    authLetter.setAttribute("required", "required");
    spocFields.style.display = "block";
  } else {
    collegeName.removeAttribute("required");
    collegeId.removeAttribute("required");
    designation.removeAttribute("required");
    address.removeAttribute("required");
    city.removeAttribute("required");
    state.removeAttribute("required");
    zipCode.removeAttribute("required");
    authLetter.removeAttribute("required");
    spocFields.style.display = "none";
  }
});

function searchFun() {
  let filter = document.getElementById("myInput").value.toUpperCase();
  let myTable = document.getElementById("myTable");

  let tr = myTable.getElementsByTagName("tr");

  for (var i = 0; i < tr.length; i++) {
    let td = tr[i].getElementsByTagName("td")[1];

    if (td) {
      let textvalue = td.textContent || td.innerHTML;

      if (textvalue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
