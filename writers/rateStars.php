<?php 


	echo "<div id='ratingDiv'>";
  echo "<b id='rateError'>What did you think?</b><br/><br/>";
  if (isset($_SESSION["UserID"])) {
    echo "<div id='ratingWrapper' onmouseout='clearStars();'>";
    echo "  <form id='ratingForm' method='get'>";
    
    for ($n=1;$n<=5;$n+=1) {
      echo "		<img onmouseover='starToRate(".$n.");' onclick='submitRating(".$_SESSION['UserID'].",".$_GET['id'].",".$n.");' id = 'star".$n."' src='../images/starcase.png'/>";
    }
    
    

	  echo "	<input id='rating' name='rating' type='number' hidden />";
	  echo "  </form>";
    echo "</div>";
    echo "<div id='userRatingDisplay'></div>";
  } else {
    echo "<a href='login.php' >Sign in to rate this park</a>";
  }
	echo "</div>";

?>


