<?php
// Importations nécessaires
include 'C:/xampp/htdocs/tacheOffres/Controller/AvisC.php';
include 'C:/xampp/htdocs/tacheOffres/Model/Avis.php';

$error = "";
$successMessage = "";

$offresC=new OffresC();
$offres=$offresC->showOffres($idOffre);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["Offres"]) && isset($_POST["search"]))
		$id_offre=$_POST['Offres'];
		$list=$d->showavis($idOffre);
	}


// Création d'une instance du contrôleur
$AvisCC = new AvisC();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["idoffre"]) &&
        isset($_POST["id_utilisateur"]) &&
        isset($_POST["note"]) &&
        isset($_POST["avis"]) &&
        !empty($_POST["idoffre"]) &&
        !empty($_POST["id_utilisateur"])&&
        !empty($_POST["note"]) &&
        !empty($_POST["avis"])
    ) {
        $Avis = new Avis(
            null,
            $_POST["idoffre"] ,
            $_POST["id_utilisateur"] ,
            $_POST["note"] ,
            $_POST["avis"] 
        );

        $AvisCC->ajouteravis($Avis);
        $successMessage = "Avis ajoutée avec succès.";
    } else {
        $error = "Informations manquantes.";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Avis </title>
</head>

<body>

    <a href="listavis.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <label for="idoffre">Selectionnez ID de l'offre:</label>
				<select name="idoffre" id="idoffre">
					<?php
						foreach ($offres as $Offres){
							echo '<option value="' . $Offres['id_offre'] . '">' .$Offres['nom_offre'] . "</option>";
						}
					?>
                    <input type="submit" value="Afficher les avis" name="search">
        </form>		
            </tr>
            <tr>
                <td><label for="id_utilisateur">ID de l'utilisateur :</label></td>
                <td>
                    <input type="number" id="id_utilisateur" name="id_utilisateur" />
                    <span id="erreurid_utilisateur" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="note">Note :</label></td>
                <td>
                    <input type="number" id="note" name="note" />
                    <span id="erreurnote" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="avis">Avis :</label></td>
                <td>
                    <input type="text" id="avis" name="avis" />
                    <span id="erreuravis" style="color: red"></span>
                </td>
            </tr>

            <td>
                <input type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
</body>

</html>