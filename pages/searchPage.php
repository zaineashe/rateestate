<?php ?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>RateEstate: Search Parks</title>

    <?php include "../libraries/functionLibrary.php"?>

</head>
<body onload="resizeHandler();" onresize="resizeHandler()">

    <div id="globalContainer" style="align-content:center;">

        <div id="thumbnail">

            <?php include "../writers/userMenu.php"; ?>

            <div id="searchDiv">
                <img id="titleIcon" src="../images/title.png" /><br/>
				
				<form id="searchForm" action="searchResults.php" method="get">

					<input id="searchBar" type="search" placeholder="Search Parks..." name="parkname" required/><br/><br/>
                
					<div id="searchDetails">
						Suburb: 
						<select id='searchSuburb' name="suburb">
							<?php include "../requests/selectSuburbs.php" ?>
						</select>
						<br/><br/>
						Within <input id="searchDistance" type="number" name="distance" required/> km of me (leave blank for any distance)<br/><br/>

						With a rating of 
						<select id='searchRating' name='rating'>
							<option value=''> --- </option>
							<option value='1'> 1 </option>
							<option value='2'> 2 </option>
							<option value='3'> 3 </option>
							<option value='4'> 4 </option>
							<option value='5'> 5 </option>
						</select>
						stars (leave blank to omit from search)<br/><br/>


						<div style="text-align:center;position:relative;">
                    		<input type="button" onclick="submitSearch();" value="Search" id="searchSubmitInput" class="searchButton" />
						</div>
					</div>

					<input type="text" id="searchLat" style="visibility:hidden;" name="lat" />
					<input type="text" id="searchLong" style="visibility:hidden;" name="long" />

				</form>

            </div>
        </div>

        <div id="content" style="width:50%;display:inline-block;margin-left:20%;margin-right:20%;">
            <p class='selectableFrame' style='cursor:default;'>
                <b style='color:yellow;'>Brisbane's Local park review website</b><br/><br/>
                With our service, you can browse, rate and review parks far and wide within the local Brisbane area.<br/><br/>
                Using our extensive parkland database, RateEstate can provide a platform for you to voice your opinions about park critique.<br/><br/>
                To find a park near you, fill out the search form above.<br/><br/>
                To start rating and reviewing, you will need to create an account <br/><br/>
                If you already have an account, just search for a park to start reviewing.<br/><br/>
                <h4 style="color:red;">This site is currently in development. Page layouts are subject to change, and some features may not be accessible as of yet.</h4>
            </p>
            <br/><br/>
        </div>
    </div>

    <?php include "../writers/footer.php" ?>

</body>
</html>