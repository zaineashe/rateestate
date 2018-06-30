<?php

	if ($_POST['parkid']) {
	
		include "../libraries/newPDOConnection.php";
    
		$sql = $conn->prepare("SELECT * FROM reviews WHERE ParkID = :Id;");
    $sql->bindValue(':Id',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));
		$sql->execute();
		if ($sql->rowCount()>0) {
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				
				echo "<div class='selectableFrame' style='cursor:default;height:initial;min-height:40px;'>";
				echo "<div class='floatWrapper'>";
				echo "<div class='reviewContent'>".$row['Review']."</div>";        
        $innerSQL = $conn->prepare("SELECT Username FROM users WHERE UserID = :Id;");
		    $innerSQL->bindValue(':Id',filter_var($row['UserID'],FILTER_SANITIZE_STRING));
		    $innerSQL->execute();
        echo "<b  style='float:right;'>";
		    if ($innerSQL->rowCount()>0) {
			    while ($innerrow = $innerSQL->fetch(PDO::FETCH_ASSOC)) {
				    echo $innerrow['Username'];
          }
		    } else {
            echo "Username not found";
        }
        
        echo "</b><br/> &nbsp;";   
        echo "<br/><i style='float:right;'><br/>".$row['Date']."</i>";
				echo "</div><div class='clear'></div></div>";

			}
		} else {
			echo "No reviews so far...";
		}
  
		$conn = null;

	} else {
		echo "Error: HTTP header failed to send";
	}


?>
