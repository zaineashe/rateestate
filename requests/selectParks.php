<?php

  function toRad($toConvert) {
    return $toConvert*pi()/180;
  }

  

  include "../libraries/newPDOConnection.php";
    
	$sqlString = "SELECT * FROM parks WHERE 1=1";
  
  if (!empty($_GET["parkname"])) {
    $sqlString = $sqlString . " AND Name LIKE :Parkname";
  }
  
  if (!empty($_GET["suburb"])) {
    $sqlString = $sqlString . " AND Suburb = :Suburb";
  }
    
  $sql = $conn->prepare($sqlString);  
  
  if (!empty($_GET["parkname"])) {
  $sql->bindValue(':Parkname',filter_var('%'.$_GET['parkname'].'%',FILTER_SANITIZE_STRING));
  }
  
  if (!empty($_GET["suburb"])) {
  $sql->bindValue(':Suburb',filter_var($_GET['suburb'],FILTER_SANITIZE_STRING));
  }
	$sql->execute();
  $n=0;
  $output="";

	if ($sql->rowCount()>0) {
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    
      $lat1 = $_GET["lat"];
      $lon1 = $_GET["long"];
      $lat2 = $row["Latitude"];
      $lon2 = $row["Longitude"];
      
      $earthRadius = 6371;
      
      $rad1 = toRad($lat1);
      $rad2 = toRad($lat2);
      $delLat = toRad($lat2 - $lat1);
      $delLon = toRad($lon2 - $lon1);
         
      $a = sin($delLat/2) * sin($delLat/2) + cos($rad1) * cos($rad2) * sin($delLon/2) * sin($delLon/2);
       
      $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
      
      $d = $earthRadius * $c;     
      
      $display_currentPark = 0;
      
      if (empty($_GET["distance"])) {
        $display_currentPark=1;
      } else {
        if ($d <= $_GET["distance"]) {
          $display_currentPark=1;
        }
      }
      
      if ($display_currentPark == 1) { 
      
        $parkRating=0;
        
        $innerSQL = $conn->prepare("SELECT AVG(Rating) AS Rate FROM ratings WHERE ParkID = :Parkid;");
        $innerSQL->bindValue(':Parkid',filter_var($row['ID'],FILTER_SANITIZE_STRING));
		    $innerSQL->execute();

		    if ($innerSQL->rowCount()>0) {
			    while ($innerRow = $innerSQL->fetch(PDO::FETCH_ASSOC)) {
				    $parkRating=ceil($innerRow['Rate']);
			    }
		    }
        
        $display_currentPark=0;
        
        if (empty($_GET["rating"])) {
          $display_currentPark=1;
        } else {
          if ($parkRating == $_GET["rating"]) {
            $display_currentPark=1;
          }
        }
        
        if ($display_currentPark==1) {
          $output = $output."<button id='result_".$n."' value='?id=".$row["ID"]."&lat=".$row["Latitude"]."&long=".$row["Longitude"]."&parkname=".$row['Name'].
                    "' onclick='loadUser(this.value);' class='selectableFrame'>";
          $output = $output."<h1>".$row["Name"]."<br/>";
			    $output = $output.$row["Street"].", ";
			    $output = $output.$row["Suburb"]."</h1>";
        
          for ($i=0;$i<$parkRating;$i+=1) {
				      $output = $output."<img src='../images/starfull.png' />";
			    }
        
          $output = $output."</button>";
          $n+=1;
        }
         
        
      }
		}
	}
  
  if ($output == "") {
    echo "<br/><h4 class='selectableFrame' style='cursor:default;'>No results found. Please try a <a href='searchPage.php'>different search</a>.</h4>";
  } else {
    echo $output;
  }

	$conn = null;

?>
