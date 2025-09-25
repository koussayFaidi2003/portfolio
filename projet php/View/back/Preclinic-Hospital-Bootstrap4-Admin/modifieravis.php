<?php
// Importations bécessaires
include 'C:/xampp/htdocs/tacheOffres/Controller/AvisC.php';
include 'C:/xampp/htdocs/tacheOffres/Model/Avis.php';
include 'bars.php';
$error = "";

// create client
$Avis = null;
// create an instance of the controller
$AvisC = new AvisC();


if (
    isset($_POST["idoffre"]) &&
    isset($_POST["id_utilisateur"]) &&
    isset($_POST["note"]) &&
    isset($_POST["avis"]) 
) {
    if (
        !empty($_POST["idoffre"]) &&
        !empty($_POST["id_utilisateur"])&&
        !empty($_POST["note"]) &&
        !empty($_POST["avis"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $Avis = new Avis(
            null,
            $_POST["idoffre"],
            $_POST["id_utilisateur"],
            $_POST["note"] ,
            $_POST["avis"] 
        );
        var_dump($Avis);
        
        $AvisC->modifieravis($Avis, $_POST['id_avis']);

        header('Location:listavis.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Modifier un Avis-Admin</title>
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
    <button><a href="listavis.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_avis'])) {
        $Avis = $AvisC->showavis($_POST['id_avis']);
        
    ?>
        <form action="" method="POST" onsubmit="return validateForm();">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Modifier un Avis</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                    <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="id_offre">ID De L'Avis :</label>
                                </div>
                                <div class="form-group">
                                    <input type="number" id="id_avis" name="id_avis" value="<?php echo isset($Avis['id_avis']) ? $Avis['id_avis'] : ''; ?>" />
                                    <span class="error-message" id="erreurid_avis" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="idoffre">ID De L'Offre :</label>
                                </div>
                                <div class="form-group">
                                    <input type="number" id="idoffre" name="idoffre" value="<?php echo isset($Avis['idoffre']) ? $Avis['idoffre'] : ''; ?>" />
                                    <span class="error-message" id="erreuridoffre" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="id_utilisateur">ID de L'Utilisateur <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group">
                                    <input type="number" id="id_utilisateur" name="id_utilisateur" value="<?php echo isset($Avis['id_utilisateur']) ? $Avis['id_utilisateur'] : ''; ?>">
                                    <span class="error-message" id="erreurid_utilisateur" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="note">Note :</label>
                                    <div class="cal-icon">
                                        <input id="note" name="note" type="number" value="<?php echo isset($Avis['note']) ? $Avis['note'] : ''; ?>">
                                        <span class="error-message" id="erreurnote" style="color: red"></span>
                                    </div>
                                </div>
                            </tr>
                        </div>
                        <div class="col-sm-6">
                            <tr>
                                <div class="form-group">
                                    <label for="avis">Avis De L'Utilisateur :</label>
                                </div>
                                <div class="form-group">
                                    <input id="avis" name="avis" type="text" value="<?php echo isset($Avis['avis']) ? $Avis['avis'] : ''; ?>">
                                    <span class="error-message" id="erreuravis" style="color: red"></span>
                                </div>
                            </tr>
                        </div>
                        <div class="m-t-20 text-center">
                            <button input type="submit" class="btn btn-primary submit-btn">Modifier un Avis</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <?php
    }
    ?>
</body>

</html>