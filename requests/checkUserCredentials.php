<?php
  
	echo "<div id='searchError'>";

	include "../libraries/newPDOConnection.php";
	
	$sql = $conn->prepare("SELECT * FROM users WHERE Username=:Username;");
  $sql->bindValue(':Username',filter_var($loginUsername,FILTER_SANITIZE_STRING));
	$sql->execute();
  
	if ($sql->rowCount()>0) {
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {    
      if ($row['UserPassword'] != hash('sha256',$loginPassword.$row['Salt'])) {
        echo "Incorrect password<br/>";
      } else {
        $_SESSION["UserID"] = $row["UserID"];
        echo "<script type='text/javascript'>document.location.href='searchPage.php'</script>";
      }
		}
	} else {
    echo "Account does not exist<br/>";
	}

	echo "</div>";

	$conn=null;

?>