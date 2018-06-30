<?php
	function checkRegistration() {
		if (isset($_POST["username"]) && isset($_POST["email"]) 
		&& isset($_POST["date"]) && isset($_POST["firstname"])
		&& isset($_POST["lastname"]) && isset($_POST["password"])
		&& isset($_POST["passwordConfirm"])) {
			

			$registerUsername = $_POST["username"];
			$registerEmail = $_POST["email"];
			$registerDate = $_POST["date"];
			$registerFirstname = $_POST["firstname"];
			$registerLastname = $_POST["lastname"];
			$registerPassword = $_POST["password"];
			$registerPasswordConfirm = $_POST["passwordConfirm"];

			include "../requests/newUser.php";
		}
	}

?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>RateEstate: Search Parks</title>

    <?php include "../libraries/functionLibrary.php"?>

</head>
<body onresize="resizeHandler()">

    <?php include "../writers/header.php"; ?>

	<?php 

		if (isset($_SESSION['UserID'])) {
			echo "<script type='text/javascript'>document.location.href='searchPage.php'</script>";
		}

	?>

    <div id="registerBackground">
        <div id="globalContainer">

            <div id="registerForm" style="width:90%;background-color:transparent;border:none;">
				<h2>Register for RateEstate</h2>
				<?php checkRegistration();?>
				<?php include '../writers/registerFormWriter.php' ?>

            </div>
			<br/><br/><br/><br/>
        </div>
    </div> 

    <?php include "../writers/footer.php"; ?>

</body>
</html>