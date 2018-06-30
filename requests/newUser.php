<?php

	echo "<div id='searchError'>";

	if ($registerPassword == $registerPasswordConfirm) {

		include "../libraries/newPDOConnection.php";
	
		$sql = $conn->prepare("SELECT UserID FROM users WHERE Username = :Username;");
    $sql->bindValue(':Username',filter_var($registerUsername,FILTER_SANITIZE_STRING));
		$sql->execute();

		if ($sql->rowCount()>0) {
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				echo " - Username taken<br/>";
			}
		} else {
			
			$sql2 = $conn->prepare("SELECT UserID FROM users WHERE Email = :Email;");
			$sql2->bindValue(':Email',filter_var($registerEmail,FILTER_SANITIZE_STRING));
		  $sql2->execute();

			if ($sql2->rowCount()>0) {
				while ($row2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
					echo " - Email taken<br/>";
				}
			} else {
        $saltValue = generateSalt(14);        
				$registersql = $conn->prepare("INSERT INTO users VALUES".
                       "(NULL, :Username, :Email, :Firstname, ".
                       ":Lastname, :Date, SHA2(CONCAT(:Password, :Saltvalue),0), :Saltvalue);");
                       
        $registersql->bindValue(':Username',filter_var($registerUsername,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Email',filter_var($registerEmail,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Firstname',filter_var($registerFirstname,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Lastname',filter_var($registerLastname,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Date',filter_var($registerDate,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Password',filter_var($registerPassword,FILTER_SANITIZE_STRING));
        $registersql->bindValue(':Saltvalue',filter_var($saltValue,FILTER_SANITIZE_STRING));
		  

				if ($registersql->execute() === TRUE) {
          
          echo "<script type='text/javascript'>document.location.href='login.php'</script>";
          
				} else {
					echo " - error ".$registerSql."<br/>".$conn->error;

				}
			}
		}


		$conn=null;
	} else {
		echo " - Passwords do not match <br/>";
	}

	echo "</div>";
	
 
?>