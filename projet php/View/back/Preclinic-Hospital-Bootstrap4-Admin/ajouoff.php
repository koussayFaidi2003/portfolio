<?php
// Importations nécessaires
include 'C:/xampp/htdocs/tacheOffres/Controller/OffresC.php';
include 'bars.php';
$error = "";
$successMessage = "";

// Création d'une instance du contrôleur
$OffresCC = new OffresC();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validation côté serveur
    if (
        isset($_POST["nom_offre"]) &&
        isset($_POST["description_offre"]) &&
        isset($_POST["date_debut_validite"]) &&
        isset($_POST["date_fin_validite"]) &&
        isset($_POST["destination_offre"]) &&
        isset($_POST["prix"]) &&
        isset($_POST["nombre_min_passagers"]) &&
        !empty($_POST["nom_offre"]) &&
        !empty($_POST["description_offre"]) &&
        !empty($_POST["date_debut_validite"]) &&
        !empty($_POST["date_fin_validite"]) &&
        !empty($_POST["destination_offre"]) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["nombre_min_passagers"])
    ) { 
        $Offres = new Offres(
            null,
            $_POST["nom_offre"],
            $_POST["description_offre"],
            $_POST["date_debut_validite"],
            $_POST["date_fin_validite"],
            $_POST["destination_offre"],
            $_POST["prix"],
            $_POST["nombre_min_passagers"]
        );
        var_dump($Offres);
        $OffresCC->ajouterOffre($Offres);
        $successMessage = "Offre ajoutée avec succès!";
        $error = "Offre n'a pas été ajoutée!";
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var successMessage = document.getElementById("successMessage");
            successMessage.textContent = "' . $successMessage . '";
            successMessage.style.display = "block";

            setTimeout(function() {
                successMessage.style.display = "none";
            }, 3000);
        });
    </script>';
    } else {
        $error = "Offre n'a pas été ajoutée!";
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var error = document.getElementById("error");
            error.textContent = "' . $error . '";
            error.style.display = "block";

            setTimeout(function() {
                error.style.display = "none";
            }, 3000);
        });
    </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .success-bow {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 9999;
        display: none;
        font-size: 18px;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: opacity 0.3s ease-in-out;
    }
.error-bow {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #dc3545;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    z-index: 9999;
    display: none;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: opacity 0.3s ease-in-out;
};

</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Ajouter un Offre-Admin</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

    <a href="listoff.php">Back to list </a>
    <hr>

    <div class="success-bow" id="successMessage"></div>
    <div class="error-bow" id="error"></div>

    <form action="../../front/TourNest-master/ajouteravis.php" method="POST">
        <input type="hidden" name="idoffre" value="<?php echo $id_offre; ?>">
    </form>
	<form action="" method="POST" onsubmit="return validateForm();">
		<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Ajouter un Offre</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
										<label for="nom_offre">Nom De L'Offre :</label>
									</div>
									<div class="form-group">
                                        <input type="text" id="nom_offre" name="nom_offre">
                    					<span class="error-message" id="erreurnom_offre" style="color: red"></span>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Description de L'offre <span class="text-danger">*</span></label>
									</div>
									<div class="form-group">
                                        <input type="text" id="description_offre" name="description_offre">
										<span class="error-message" id="erreurdescription_offre" style="color: red"></span>
									</div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
									<label for="date_debut_validite">Date Debut :</label>
                                        <div class="cal-icon">
                                            <input id="date_debut_validite" name="date_debut_validite" type="date">
                    						<span class="error-message" id="erreurdate_debut_validite" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
									<label for="date_fin_validite">Date Fin :</label>
                                        <div class="cal-icon">
                                            <input id="date_fin_validite" name="date_fin_validite" type="date">
                    						<span class="error-message" id="erreurdate_fin_validite" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Destination <span class="text-danger">*</span></label>
									</div>
									<div class="form-group">
                                        <input type="text" id="destination" name="destination_offre">
										<span class="error-message" id="erreurdestination_offre" style="color: red"></span>
									</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
										<label for="nombre_min_passagers">Nombre Des Passagers :</label>
									</div>
									<div class="form-group">
                                        <input  id="nombre_min_passagers" name="nombre_min_passagers" type="number">
                    					<span  class="error-message" id="erreurnombre_min_passagers" style="color: red"></span>
									</div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
										<label for="prix">Prix De L'Offre :</label>
									</div>
									<div class="form-group">
                                        <input step="0.01" id="prix" name="prix" type="number">
                    					<span class="error-message" id="erreurprix" style="color: red"></span>
                                    </div>
                                </div>
								<div class="m-t-20 text-center">
                                <button input type="submit" class="btn btn-primary submit-btn">Créer un Offre</button>
                            </div>
					</div>
				</div>
			</div>
		</div>
	</form>	
    <script>
    function validateForm() {
        var nomInput = document.getElementById('nom_offre');
        var descriptionInput = document.getElementById('description_offre');
        var destinationInput = document.getElementById('destination');

        var erreurnom = document.getElementById('erreurnom_offre');
        var erreurdescription = document.getElementById('erreurdescription_offre');
        var erreuedestination = document.getElementById('erreurdestination_offre');

        // Validation du champ "nom"
        if (!/^[a-zA-Z\s]+$/.test(nomInput.value.trim())) {
            erreurnom.textContent = 'Le champ "nom" doit contenir uniquement des lettres.';
            return false; // Empêche l'envoi du formulaire
        } else {
            erreurnom.textContent = ''; // Réinitialise le message d'erreur
        }

        // Validation du champ "description"
        if ((descriptionInput.value.trim().length < 5) || !/^[a-zA-Z\s]+$/.test(descriptionInput.value.trim())) {
            erreurdescription.textContent = 'Le champ "description" doit avoir au moins 5 caractères et contenir uniquement des lettres.';
            return false; // Empêche l'envoi du formulaire
        } else {
            erreurdescription.textContent = ''; // Réinitialise le message d'erreur
        }
        // Validation du champ "destination"
        if (destinationInput.value.trim().length < 5 || !/^[a-zA-Z\s]+$/.test(destinationInput.value.trim())) {
            erreuedestination.textContent = 'Le champ "destination" doit avoir au moins 5 caractères et contenir uniquement des lettres.';
            return false; // Empêche l'envoi du formulaire
        } else {
            erreuedestination.textContent = ''; // Réinitialise le message d'erreur
        }
    }
</script>
	<div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
