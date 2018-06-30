<?php

  echo "<b id='reviewError'></b>";
  if ($_GET['id']) {
      if (isset($_SESSION['UserID'])) {
	    echo "<div class='floatWrapper'>";
	    echo "<form action='javascript:void(0);'>";
	    echo "<textarea id='reviewText' type='text' placeholder='Write a review...' required></textarea> ";    
	    echo "<br/><br/>";
	    echo "<input type='submit' onclick='submitReview(".$_SESSION['UserID'].", ".$_GET['id'].", \"reviewText\");' style='float:right;' class='searchButton'/>";
  	  echo "</form>";
	    echo "</div><div class='clear'></div>";
    } else {
	    echo "<a href='login.php' >Sign in to leave a review</a>";
    }
  } else {
    echo '<b>Find a park to start reviewing</b>';
  }



?>