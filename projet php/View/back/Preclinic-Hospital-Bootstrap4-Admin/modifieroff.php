<?php
// Importations nécessaires
include 'C:/xampp/htdocs/tacheOffres/Controller/OffresC.php';
include 'bars.php';

$error = "";

// create client
$Offres = null;
// create an instance of the controller
$OffresC = new OffresC();


if (
    isset($_POST["nom_offre"]) &&
    isset($_POST["description_offre"]) &&
    isset($_POST["date_debut_validite"]) &&
    isset($_POST["date_fin_validite"]) &&
    isset($_POST["destination"]) &&
    isset($_POST["prix"]) &&
    isset($_POST["nombre_min_passagers"])
) {
    if (
        !empty($_POST["nom_offre"]) &&
        !empty($_POST["description_offre"]) &&
        !empty($_POST["date_debut_validite"]) &&
        !empty($_POST["date_fin_validite"]) &&
        !empty($_POST["destination"]) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["nombre_min_passagers"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        if (isset($_POST["id_offre"])) {
            $Offres = new Offres(
                $_POST["id_offre"],
                $_POST["nom_offre"],
                $_POST["description_offre"],
                $_POST["date_debut_validite"],
                $_POST["date_fin_validite"],
                $_POST["destination"],
                $_POST["prix"],
                $_POST["nombre_min_passagers"]
            );
        
            $OffresC->modifierOffre($Offres, (int)$_POST['id_offre']);
        
            header('Location:listoff.php');
        } else {
            $error = "Missing information";
        }
    }
}



?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Modifier un Offre-Admin</title>
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

    <!--<a href="listoff.php">Back to list </a>-->
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_offre'])) {
        $Offres = $OffresC->showOffres($_POST['id_offre']);
	}
    ?>

<form action="" method="POST" onsubmit="return validateForm();">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Modifier un Offre</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                    <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="id_offre">ID De L'Offre :</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="id_offre" name="id_offre" value="<?php echo isset($Offres['id_offre']) ? $Offres['id_offre'] : ''; ?>" />
                                    <span class="error-message" id="erreurid_offre" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="nom_offre">Nom De L'Offre :</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="nom_offre" name="nom_offre" value="<?php echo isset($Offres['nom_offre']) ? $Offres['nom_offre'] : ''; ?>" />
                                    <span class="error-message" id="erreurnom_offre" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label>Description de L'offre <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="description_offre" name="description_offre" value="<?php echo isset($Offres['description_offre']) ? $Offres['description_offre'] : ''; ?>">
                                    <span class="error-message" id="erreurdescription_offre" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="date_debut_validite">Date Debut :</label>
                                    <div class="cal-icon">
                                        <input id="date_debut_validite" name="date_debut_validite" type="date" value="<?php echo isset($Offres['date_debut_validite']) ? $Offres['date_debut_validite'] : ''; ?>">
                                        <span class="error-message" id="erreurdate_debut_validite" style="color: red"></span>
                                    </div>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="date_fin_validite">Date Fin :</label>
                                    <div class="cal-icon">
                                        <input id="date_fin_validite" name="date_fin_validite" type="date" value="<?php echo isset($Offres['date_fin_validite']) ? $Offres['date_fin_validite'] : ''; ?>">
                                        <span class="error-message" id="erreurdate_fin_validite" style="color: red"></span>
                                    </div>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label>Destination <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="destination" name="destination" value="<?php echo isset($Offres['destination']) ? $Offres['destination'] : ''; ?>">
                                    <span class="error-message" id="erreurdestination" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="nombre_min_passagers">Nombre Des Passagers :</label>
                                </div>
                                <div class="form-group">
                                    <input id="nombre_min_passagers" name="nombre_min_passagers" type="number" value="<?php echo isset($Offres['nombre_min_passagers']) ? $Offres['nombre_min_passagers'] : ''; ?>">
                                    <span class="error-message" id="erreurnombre_min_passagers" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="prix">Prix De L'Offre :</label>
                                </div>
                                <div class="form-group">
                                    <input step="0.01" id="prix" name="prix" type="number" value="<?php echo isset($Offres['prix']) ? $Offres['prix'] : ''; ?>">
                                    <span class="error-message" id="erreurprix" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="m-t-20 text-center">
                            <button input type="submit" class="btn btn-primary submit-btn">Modifier un Offre</button>
                        </div>
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

        var erreurnom = document.getElementById('erreurnom_offre');
        var erreurdescription = document.getElementById('erreurdescription_offre');

        // Validation du champ "nom"
        if (!/^[a-zA-Z\s]+$/.test(nomInput.value.trim())) {
            erreurnom.textContent = 'Le champ "nom" doit contenir uniquement des lettres.';
            return false; // Empêche l'envoi du formulaire
        } else {
            erreurnom.textContent = ''; // Réinitialise le message d'erreur
        }

        // Validation du champ "description"
        if (descriptionInput.value.trim().length < 5 || !/^[a-zA-Z\s]+$/.test(descriptionInput.value.trim())) {
            erreurdescription.textContent = 'Le champ "description" doit avoir au moins 5 caractères et contenir uniquement des lettres.';
            return false; // Empêche l'envoi du formulaire
        } else {
            erreurdescription.textContent = ''; // Réinitialise le message d'erreur
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
    <script src="assets/js/app.js"></script><div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</html>