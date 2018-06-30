<?php 

  session_start();

	if ($_POST["parkid"] && $_SESSION['UserID']) {
		
		include "../libraries/newPDOConnection.php";
    
    $sql = $conn->prepare("SELECT Rating FROM ratings WHERE ParkID = :Parkid AND UserID = :UserID;");
    $sql->bindValue(':Parkid',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));
    $sql->bindValue(':UserID',filter_var($_SESSION['UserID'],FILTER_SANITIZE_STRING));
		$sql->execute();

		if ($sql->rowCount()>0) {
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				for ($i=0;$i<ceil($row['Rating']);$i+=1) {
					echo "   <img class='shadowImage' src='../images/starprevious.png'/>";
				}
			}
		}
    $conn = null;
	}

?>