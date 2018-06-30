<?php

	echo "<div style='font-size:16px;'>";

	if ($_POST["parkid"]) {
		
		include "../libraries/newPDOConnection.php";
    		
    $sql = $conn->prepare("SELECT AVG(Rating) AS Rate FROM ratings WHERE ParkID = :Id;");
    $sql->bindValue(':Id',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));
		$sql->execute();

		if ($sql->rowCount()>0) {
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				for ($i=0;$i<ceil($row['Rate']);$i+=1) {
				echo "<img src='../images/bigstar.png' />";
        }
			}
		} else {
			echo "This park has not been rated yet!";
		}

    $conn = null;

	} else {
		echo "Error: Cannot find park ID";
	}

	echo "</div>"

?>