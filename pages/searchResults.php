<?php ?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>RateEstate: Search Parks</title>

    <?php include "../libraries/functionLibrary.php"?>

</head>
<body onresize="resizeHandler()">

    <?php include "../writers/header.php" ?>

    <div id="globalContainer">
		
		<div id="mapApi">
			<div id="mapFrame"></div>
		</div>

		<script async defer
			src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyADMomjrQtp-D50Ih2vMN09FvYp7-mY9Qk&callback=loadMapResults">
		</script>

        <div id="content">
            <br/>
            <div id="frameContainer">
                <?php include "../requests/selectParks.php"; ?>
            </div>
            <br/><br/>
        </div>
    </div>

    <?php include "../writers/footer.php" ?>

</body>
</html>