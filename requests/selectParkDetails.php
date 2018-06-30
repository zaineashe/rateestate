<?php

  function toRad($toConvert) {
    return $toConvert*pi()/180;
  }

  include "../libraries/newPDOConnection.php";
    
	$sql = $conn->prepare("SELECT * FROM Parks WHERE ID = :Id");
  $sql->bindValue(':Id',filter_var($_GET["id"],FILTER_SANITIZE_STRING));
	$sql->execute();
  
  $output="";

	if ($sql->rowCount()>0) {
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='selectableFrame' style='cursor:default;text-align:right;'>";
      echo "<div class='floatWrapper'>";
      echo "<div id='parkRatingWrapper'></div>";
      echo "<h1 style='text-align:center;'>".$row["Name"]."</h1>";
      include "../writers/rateStars.php";
      echo "<div style='float:right;'>";
      echo "<b style='font-size:20px;'>".$row["Street"]."<br/>".$row["Suburb"]."</b>";
      echo "<p>Park ID: ".$row["ParkID"]."<br/>";
			echo "N: ".$row["Northing"].", E: ".$row["Easting"]."<br/>";
			echo $row["Latitude"].", ".$row["Longitude"]."</p></div>";

			echo"</div><div class='clear'></div></div>";
		}
	} else {
    echo "<br/><h4 class='selectableFrame' style='cursor:default;'>No results found. Please try a <a href='searchPage.php'>different search</a>.</h4>";
	}

	$conn=null;

?>

