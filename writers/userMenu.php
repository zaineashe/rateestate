<?php 

  session_start();

  include "../libraries/newPDOConnection.php";
  
	echo "<div id='userMenu'>";
  
  if (isset($_SESSION["UserID"])) {
    $usernameSql = $conn->prepare("SELECT Username FROM users WHERE UserID=:Userid");
	  $usernameSql->bindValue(':Userid',filter_var($_SESSION["UserID"],FILTER_SANITIZE_STRING));
    $usernameSql->execute();

	  if ($usernameSql->rowCount()>0) {
		  while ($usernameRow = $usernameSql->fetch(PDO::FETCH_ASSOC)) {
		    echo "<b style='font-size:18px;'>".$usernameRow["Username"]."</b>&nbsp;";
      }
    } else {
      echo "<br/>";
    }
    
    echo "<a href='logout.php' class='userLink'>Logout</a>&nbsp;";
  } else {
    echo "<a href='login.php' class='userLink'>Login</a>&nbsp;";
	  echo "<a href='register.php' class='userLink'>Register</a>";
  }
  

  
  
  echo "</div>";
  
  $conn=null;
  

?>