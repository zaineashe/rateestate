<?php

  include "../libraries/newPDOConnection.php";
	
	$sql = $conn->prepare("SELECT DISTINCT Suburb FROM parks ORDER BY Suburb ASC");
	$sql -> execute();

  echo "<option value=''>---</option>";
	if ($sql->rowCount()>0) {
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo "<option value='".$row["Suburb"]."'>".$row["Suburb"]."</option>";
		}
	} else {
		echo "ERR - No results.";
	}

	$conn=null;

?>