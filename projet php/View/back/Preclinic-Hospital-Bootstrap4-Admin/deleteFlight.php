<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/FlightC.php';

$flight = new FlightC();
$flight->deleteFlight($_GET["id"]);

// Notification message
$successMessage = "Flight deleted successfully.";

// Redirect with success message
header("Location:listFlight2.php?successMessage=$successMessage");
exit(); // Ensure that no further code is executed after the redirect

if (isset($_GET['successMessage'])) {
    $successMessage = $_GET['successMessage'];
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var successMessage = document.getElementById("successMessage");
            successMessage.textContent = "' . $successMessage . '";
            successMessage.style.display = "block";

            setTimeout(function() {
                successMessage.style.display = "none";
            }, 5000);
        });
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
	.success-bow{
		position: fixed;
		bottom: 20px;
		left:50%;
		transform: translateX(-50%);
		background-color: #4CAF50;
		color:#fff;
		padding: 10px 20px;
		border-radius: 5px;
		z-index:9999;
		display:none;
	}
</style> 

<body>
    <div id="error">
        <?php echo $error; ?>
    </div>
    <div class="success-bow" id="successMessage"></div>
</body>
</html>