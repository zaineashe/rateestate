<?php 

	if (isset($_SESSION['UserID'])) {
		 echo "<script type='text/javascript'>document.location.href='searchPage.php'</script>";
	}

	function checkUser() {
		if (isset($_POST["username"]) && isset($_POST["password"])) {
			
			$loginUsername = $_POST["username"];
			$loginPassword = $_POST["password"];

			include "../requests/checkUserCredentials.php";
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
			<div id="registerForm" style="background-color:transparent;border-width:0px;width:70%;">
				<h2>Log in to RateEstate</h2>

				<?php checkUser() ?>

				<?php include '../writers/loginFormWriter.php'; ?>

             </div>
			 <br/><br/>
				
        </div>
    </div> 

    <?php include "../writers/footer.php"; ?>

</body>
</html>