<?php 

	if ($_POST['id'] && $_POST['parkid'] && $_POST['review']) {
  
  
		include "../libraries/newPDOConnection.php";
    
    
    try {
    	$sql = $conn->prepare("INSERT INTO reviews (ReviewID, UserID, ParkID, Review, Date) VALUES (".
                    "NULL, :User, :Park, :Review, NULL);");
      $sql->bindValue(':User',filter_var($_POST['id'],FILTER_SANITIZE_STRING));
      $sql->bindValue(':Park',filter_var($_POST['parkid'],FILTER_SANITIZE_STRING));
      $sql->bindValue(':Review',filter_var($_POST['review'],FILTER_SANITIZE_STRING));

		  //if update or insert are successful
      
      
		  if ($sql->execute() !== TRUE) {
			  echo "Error: Query failed";
		  }
      
      $conn = null;
    
    }
    catch (PDOException $e) {
      echo $e_getMessage();
    }

    

	} else {
		echo "Error: POST request failed";
	}



?>

