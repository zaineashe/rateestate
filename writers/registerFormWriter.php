<?php

	echo "<form action='register.php' method='post'>";

		newRenewableInput('text','username','searchBar','Username...');
		echo "<br/><br/>";
		newRenewableInput('email','email','searchBar','Email...');
		echo "<br/><br/>";

	echo "	<div style='float:left;width:50%;z-index=2;'>";
	echo "		<h4>Date of birth : </h4>";
			newRenewableInput('date','date','searchBar','Date of birth...');
			echo "<br/><br/>";

			newRenewableInput('text','firstname','searchBar','First name...');
			echo "<br/><br/>";
			newRenewableInput('lastname','lastname','searchBar','Last name...');
			echo "<br/><br/>";
	echo "	</div>";

	echo "	<div style='float:right;width:50%;z-index=2;'>";
			newRenewableInput('password','password','searchBar','Password...');
			echo "<br/><br/>";
			newRenewableInput('password','passwordConfirm','searchBar','Confirm password...');
			echo "<br/><br/>";
	echo "	</div>";

	echo "	<input type='submit' value='Go' id='searchSubmitInput' class='searchButton' />";
					
	echo "</form>";

?>