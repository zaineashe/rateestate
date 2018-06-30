<?php

// --------------------------------------------------
// functionLibrary.php
// a page included universally by every .php in the pages/ directory
// initialises some universal functions and includes CSS and JS libraries
// --------------------------------------------------

//function that creates a new renewable input
//intakes input type, name, an id, and placeholder text
function newRenewableInput($type,$name,$id,$placeholder) {

  //initialise postValue
	$postValue = '';
  
  //check if variable with name as $name has been set in POST HTTP
	if (isset($_POST[$name])) {
  
    //set postValue to POST request
		$postValue=$_POST[$name];
	}
  
  //echo a new input with the argument values inserted
  //this input form has the 'required' attribute
	echo "	<input id='".$id."' type='".$type."' value='".$postValue."' placeholder='".$placeholder."' name='".$name."' required/>";
}

//generate a random salt code used to encode passwords
//code is length of length argument
function generateSalt($length) {
 
  //initialise saltOut
  $saltOut = "";
  
  //repeat for length argument
  for ($i = 1; $i<=$length; $i+=1) {
  
    //initialise saltChar as an invalid ASCII value
    $saltChar = 58;
    
    //check if ASCII value is invalid. Only valid characters are 1-9, a-z and A-Z
    while (($saltChar>=58 && $saltChar<=64) || ($saltChar>=91 && $saltChar<=96)) {
    
      //set saltChar to a random int value between 48 and 122
      //48 - 122 is ASCII 1-Z 
      $saltChar = round(rand(48,122));
    }
    
    //translate saltChar from ASCII to string and concat to saltOut
    $saltOut = $saltOut.chr($saltChar);
  }
  
  //return the completed salt code
  return $saltOut;
}

// ------------------------------------------------------------------
//this script is called by every .php file in the pages/ directory.
//therefore, this function library is dedicated to importing the stylesheets
//and javascript libraries that each page shares.
// ------------------------------------------------------------------

//include styleSheet.css from libraries directory
echo "<link rel='stylesheet' type='text/css' href='../libraries/styleSheet.css' />";

//include projectScript.js from libraries directory
echo "<script src='../libraries/projectScript.js' type='text/javascript'></script>";


?>