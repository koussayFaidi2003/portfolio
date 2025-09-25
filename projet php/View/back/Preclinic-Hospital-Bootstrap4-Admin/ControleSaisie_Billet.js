function validerFn() {
    var flightNumber = parseInt(document.getElementById("flightNumber").value);
    var erreurflightNumber = document.getElementById("erreurflightNumber");
    var succesflightNumber = document.getElementById("succesflightNumber");

    if (!isNaN(flightNumber) && flightNumber >= 1 && flightNumber <= 10000) {
        erreurflightNumber.textContent = "";
        succesflightNumber.textContent = "Flight Number valide";
        succesflightNumber.style.color = "green";
    } else {
        erreurflightNumber.textContent = "Invalid Flight Number";
        erreurflightNumber.style.color = "red";
        succesflightNumber.textContent = "";
    }
}
 function validerUs(){
    var UserName = document.getElementById("UserName").value;
      var erreurUserName = document.getElementById("erreurUserName");
      var succesUserName = document.getElementById("succesUserName");
      if (!/^[A-Za-z]+$/.test(UserName) || UserName.length < 1) {
          erreurUserName.textContent = "User Name invalide";
          erreurUserName.style.color = "red";
          succesUserName.textContent = ""; 
      } else {
          erreurUserName.textContent = "";
          succesUserName.textContent = "User Name valide";
          succesUserName.style.color = "green";
      }
 }

function validerSeat_Number() {
    var Seat_Number = parseInt(document.getElementById("Seat_Number").value);
    var erreurSeat_Number = document.getElementById("erreurSeat_Number");
    var succesSeat_Number = document.getElementById("succesSeat_Number");

    if (!isNaN(Seat_Number) && Seat_Number >= 1 && Seat_Number <= 1000){
        erreurSeat_Number.textContent = "";
        succesSeat_Number.textContent = "Seat Number valide";
        succesSeat_Number.style.color = "green";
    } else {
        erreurSeat_Number.textContent = "invalide";
        erreurSeat_Number.style.color = "red";
        succesSeat_Number.textContent = "";
    }
}
function validerPrice() {
    var Price = parseFloat(document.getElementById("Price").value);
    var erreurPrice = document.getElementById("erreurPrice");
    var succesPrice = document.getElementById("succesPrice");

    if (!isNaN(Price) && Price >= 1 && Price <= 4000)  {
        erreurPrice.textContent = "";
        succesPrice.textContent = "Price is valid";
        succesPrice.style.color = "green";
    } else {
        erreurPrice.textContent = "Invalid Price";
        erreurPrice.style.color = "red";
        succesPrice.textContent = "";
    }
}
/*function validerDateD() {
    var dateDValue = new Date(document.getElementById("dateD").value);
    var currentDate = new Date();
    var erreurDateD = document.getElementById("erreurdateD");
    var succesDateD = document.getElementById("succesdateD");

    if (dateDValue < currentDate) {
        erreurDateD.textContent = "La date de début doit être postérieure ou égale à la date actuelle.";
        erreurDateD.style.color = "red";
        succesDateD.textContent = "";
    } else {
        erreurDateD.textContent = "";
        succesDateD.textContent = "Date de début valide";
        succesDateD.style.color = "green";
    }
}*/

function validerDateF() {
    var dateDValue = new Date(document.getElementById("dateD").value);
    var dateFValue = new Date(document.getElementById("dateF").value);
    var erreurDateF = document.getElementById("erreurdateF");
    var succesDateF = document.getElementById("succesdateF");

    if (dateFValue <= dateDValue || dateFValue <= new Date()) {
        erreurDateF.textContent = "La date de fin doit être supérieure à la date de début et à la date actuelle.";
        erreurDateF.style.color = "red";
        succesDateF.textContent = "";
    } else {
        erreurDateF.textContent = "";
        succesDateF.textContent = "Date de fin valide";
        succesDateF.style.color = "green";
    }
}