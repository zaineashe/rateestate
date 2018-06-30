<?php

	echo "<form action='login.php' method='post'>";

	newRenewableInput('text','username','searchBar','Username...');
	echo "<br/><br/>";


	newRenewableInput('password','password','searchBar','Password...');
	
	echo "	<div style='text-align:center;position:relative;'>";
	echo "		<input type='submit' value='Go' id='searchSubmitInput' class='searchButton' />";
	echo "	</div>";
	echo "</form>";

?>
