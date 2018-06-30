<?php

  // --------------------------
  // newPDOConnection.php
  // universal PDO creation script
  // stores SQL user credentials, and initialises conn variable
  // which is used to store PDO objects in every request script
  // --------------------------


  // initialise n9469010's SQL credentials.
  // for a more secure connection, these credentials
  // should be encrypted and stored externally.
  //   ---
  // initialises server name, username, password and database name
	$servername = "fastapps04.qut.edu.au";
	$username = "n9469010";
	$password = "password";
	$dbname = "n9469010";

  //initialise conn as a new PDO object
  //uses initialised credentials to establish connection
	$conn = new PDO("mysql:host=".$servername.";dbname=".$dbname,$username,$password);
	
  //sets error handling attributes for PDO object conn
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
?>