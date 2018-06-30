<?php?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>RateEstate: Search Parks</title>

    <?php include "../libraries/functionLibrary.php"?>

</head>
<body onload="parkDisplayLoop();" onresize="resizeHandler()">

    <div id="globalContainer">

        <?php include '../writers/header.php' ?>

		<div id="mapApi">
			<div id="mapFrame"></div>
		</div>

		<script async defer
			src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyADMomjrQtp-D50Ih2vMN09FvYp7-mY9Qk&callback=loadMapDisplay">
		</script>

        <div id="content">

            <br/><br/><br/><br/>
				<?php include '../requests/selectParkDetails.php'; ?>
            <br/><br/>

            <div id="frameContainer">

			</div>

			<div class="selectableFrame" style="cursor:default;">
				<br/>
				<?php include "../writers/reviewWriter.php"; ?>
				<br/><br/>
			</div>

            <br/><br/>
            <br/><br/>

        </div>
    </div>

    <?php include '../writers/footer.php' ?>



</body>
</html>