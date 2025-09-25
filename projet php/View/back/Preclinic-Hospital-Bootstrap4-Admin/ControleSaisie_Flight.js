/*document.addEventListener("DOMContentLoaded", function () {
  var formulaire = document.getElementById("form");
  formulaire.addEventListener("submit", function (e) {
      e.preventDefault(); // Empêche l'envoi du formulaire par défaut
      
      
  });
});*/
 function validld(){
    var lieuD = document.getElementById("lieuD").value;
      var erreurlieuD = document.getElementById("erreurlieuD");
      var succeslieuD = document.getElementById("succeslieuD");
      if (!/^[A-Za-z]+$/.test(lieuD) || lieuD.length < 1) {
          erreurlieuD.textContent = "lieuD invalide";
          erreurlieuD.style.color = "red";
          succeslieuD.textContent = ""; 
      } else {
          erreurlieuD.textContent = " ";
          succeslieuD.textContent = "lieuD valide";
          succeslieuD.style.color = "green";
      }
 }
 function validla(){
    var lieuA = document.getElementById("lieuA").value;
      var erreurlieuA = document.getElementById("erreurlieuA");
      var succeslieuA = document.getElementById("succeslieuA");
      if (!/^[A-Za-z]+$/.test(lieuA) || lieuA.length < 1) {
          erreurlieuA.textContent = "lieuA invalide";
          erreurlieuA.style.color = "red";
          succeslieuA.textContent = ""; 
      } else {
          erreurlieuA.textContent = "";
          succeslieuA.textContent = "lieuA valide";
          succeslieuA.style.color = "green";
      }
 }

function validerNumberp() {
    var numberp = document.getElementById("numberp").value;
    var erreurnumberp = document.getElementById("erreurnumberp");
    var succesnumberp = document.getElementById("succesnumberp");

    if (/^[1-9][0-9]?$/.test(numberp)){
        erreurnumberp.textContent = "";
        succesnumberp.textContent = "Number of persons valide";
        succesnumberp.style.color = "green";
    } else {
        erreurnumberp.textContent = "invalide";
        erreurnumberp.style.color = "red";
        succesnumberp.textContent = "";
    }
}
function validerbillet() {
    var billet = parseInt(document.getElementById("billet").value);
    var erreurbillet = document.getElementById("erreurbillet");
    var succesbillet = document.getElementById("succesbillet");

    if (!isNaN(billet) && billet >= 1 && billet <= 1000) {
        erreurbillet.textContent = "";
        succesbillet.textContent = "Ticket is valid";
        succesbillet.style.color = "green";
    } else {
        erreurbillet.textContent = "Invalid Ticket";
        erreurbillet.style.color = "red";
        succesbillet.textContent = "";
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