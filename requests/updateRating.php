<?php 

	if ($_POST['id'] && $_POST['parkid'] && $_POST['rating']) {
		include "../libraries/newPDOConnection.php";
    
    $sql = $conn->prepare("SELECT ID FROM ratings WHERE UserID = :Id AND ParkID = :Parkid;");
    $sql->bindValue(':Id',filter_var($_POST['id'],FILTER_SANITIZE_STRING));
    $sql->bindValue(':Parkid',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));
		$sql->execute();

		//check if rating already exists
		if ($sql->rowCount()>0) {
			//update existing rating
      $innersql = $conn->prepare("UPDATE ratings SET Rating = :Rating WHERE UserID = :Id AND ParkID = :Parkid;");  
		} else {
			//insert new rating
			$innersql = $conn->prepare("INSERT INTO ratings (ID, UserID, ParkID, Rating) VALUES (NULL, :Id, :Parkid, :Rating);");
		}

    $innersql->bindValue(':Rating',filter_var($_POST['rating'],FILTER_SANITIZE_STRING));
    $innersql->bindValue(':Id',filter_var($_POST['id'],FILTER_SANITIZE_STRING));
    $innersql->bindValue(':Parkid',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));

		//if update or insert are successful
		if ($innersql->execute() == TRUE) {
			echo "Thank you for rating!";
		} else {
			echo "Error: Query failed";
		}

		$conn=null;

	} else {
		echo "Error: POST request failed";
	}


?>