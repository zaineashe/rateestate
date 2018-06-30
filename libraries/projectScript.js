// JavaScript source code

// --------------------------------------------
// projectScript.js
// --------------------------------------------
// library of javascript functions that are called by .php files
// in the pages directory
// includes creation and execution of AJAX files
// and handling of gMaps javascript API.
// --------------------------------------------

//function to call whenever page is resized
//handles resize for thumbnail and map API div
function resizeHandler() {

    //call mapResize, handles map Div width
    mapResize();
    //call thumbnailResize, handles width and height of thumbnail div
    thumbnailResize();
}

//function that handles the width and height of thumbnail
//ensures that thumbnail is always the width of window, and that the height always
//covers 100% of the physical window height
//this handler repeats its functionality for the registerBackground id as well
function thumbnailResize() {

    //checks if thumbnail exists
    if (document.getElementById('thumbnail') != null) {

        //sets the thumbnail height to the window's height
        document.getElementById("thumbnail").style.height = window.innerHeight;

        //sets the minimum height of the thumbnail to 500px, this makes
        //sure that the thumbnail never gets smaller than its content can allow
        document.getElementById("thumbnail").style.minHeight = "500px";
    }

    //check if registerBackground exists
    if (document.getElementById('registerBackground') != null) {

        //if exists, set registerBackground height to the documents physical scroll height
        document.getElementById("registerBackground").style.height = document.documentElement.scrollHeight;

        //sets registerBackgrounds minimum height to 500px to fit content
        document.getElementById("registerBackground").style.minHeight = "500px";
    }
}

//function built to resize map API div
//makes sure that the width of the map is constantly conforming to the size of the client window
function mapResize() {

    //checks if mapFrame exists
    if (document.getElementById('mapFrame') != null) {

        //if mapFrame exists, set width to 100px less than the window width
        //the -100px is there to give the map a small 'youtube' style black border 
        document.getElementById("mapFrame").style.width = window.innerWidth - 100;
    }
}

//function that acts like a PHP GET request
//uses string manipulation to find and parse information in the URL
//argument getName is the name of the variable to find 
//example: getFromURL("parkid=") returns value of _GET['parkid'] in PHP
function getFromURL(getName) {

    //initialise iURL as the current url
    var iURL = window.location.href;

    //initialise newout
    var newout;

    //set newout to a substring of iURL. uses indexof to find where getName is in URL
    //slices url from where getNames value starts, to the end of the URL
    newout = iURL.substring(iURL.indexOf(getName) + getName.length, iURL.length);

    //checks if there are any '&' symbols left in the URL
    //if there are, then that means that there are extra values left in the URL
    //if there arent, then the URL ends with the required value, and no further
    //slicing is needed.
    if (newout.search("&") != -1) {

        //if '&' symbol exists, slice newout down to the index of that symbol
        newout = newout.substring(0, newout.indexOf("&"));
    }

    //return newout, should be a string containing just the required GET value
    return newout;
}


// function to initialise map using Gmaps JS API
// sets up the centred position, using given lat and long values
// also sets up center marker, and info window for that marker
// zoom is the zoom value of the google map. 18 is max zoom, 0 is world map view
// markerName is the text that displays in the center marker's info window
function initMap(zoom, markerName) {

    //initialise URL as the current URL
    var URL = window.location.href;

    //search URL for instances of 'lat=' and 'long=' GET definers
    if (URL.search("lat=") == -1 || URL.search("long=") == -1) {

        //set mapLat and mapLong
        //if lat and long cant be found in URL, set to a default value
        //default value is the brisbane city centre, near southbank and QUT
        var mapLat = -27.4698454;
        var mapLon = 153.0142625;
    } else {

        //set mapLat and mapLon to 'lat=' and 'long=' values from URL
        //use getFromURL function to get lat and long values
        //parse these string values into floats
        mapLat = parseFloat(getFromURL("lat="));
        mapLon = parseFloat(getFromURL("long="));
    }

    //set centre to a google maps LatLng object using mapLat and mapLon
    var centre = new google.maps.LatLng(mapLat, mapLon);

    //initialise new google map, using mapFrame div as a location
    //set attributes: zoom equals the parsed zoom value, center is the centre latlng previously initialised
    var map = new google.maps.Map(document.getElementById("mapFrame"),
        { zoom: zoom, center: centre });

    //set up a new infoWindow to be opened as assigned to center marker
    //set content of infoWindow to be markerName argument
    var infowindow = new google.maps.InfoWindow(
        { content: markerName });

    //set up new marker for center.
    //position attribute is centre latlng object
    //set map attribute to previously established map object
    var marker = new google.maps.Marker(
        { position: centre, map: map });

    //add listeners for the center marker. When moused over, the center marker
    //opens infoWindow, when moused out infoWindow closes
    marker.addListener('mouseover', function () { infowindow.open(map, marker) });
    marker.addListener('mouseout', function () { infowindow.close(map, marker) });

    //return the map object for further manipulation
    return map
}

//function to load map for parkDisplay.php
function loadMapDisplay() {

    //set map to initMap, using zoom value of 18
    //set markerName to the parkname value from URL
    map = initMap(18, getFromURL("parkname=").replace(/%20/g, ' '));

    //call mapResize, to initialise size of map
    mapResize();
}


//function to load map for searchResults.php
//initialises map, then files through each resulting park
//to set extra markers.
function loadMapResults() {

    //initialise map, with 13 zoom and 'You are here' as the markerText
    //set return value as new object locally named map
    map = initMap(13, "You are here")

    //initialise new array called markers
    //this array stores all location markers, and all of those markers
    //corresponding infoWindows. This array will wind up 2-dimensional
    var markers = new Array();

    //start a loop that runs an iteration for each child in the frameContainer div
    for (var i = 0; i < document.getElementById('frameContainer').children.length; i++) {

        //initialise toDissect as the child with id of result_i
        //where i is the id of iteration
        toDissect = document.getElementById('result_' + i).value;

        //set up temporary lat and lon to lat= and long= values in toDissect
        //method here follows getFromURL function, but is custom because its getting from 
        //a string rather than URL
        tempLat = toDissect.substring(toDissect.lastIndexOf("lat=") + 4, toDissect.length);
        tempLat = tempLat.substring(0, tempLat.indexOf("&"));
        tempLon = toDissect.substring(toDissect.lastIndexOf("long=") + 5, toDissect.lastIndexOf("&"));
        
        //perform the same string slice with parkname= in toDissect
        tempName = toDissect.substring(toDissect.lastIndexOf("parkname=") + 9, toDissect.length);

        //for each child in frameContainer, a new marker is set up.
        //these markers are stored in the markers array
        //markers array is two dimensional, each markers[i] value is its own 1d array of length 2 with two objects in it
        markers[i] = new Array(2);

        //initialise new maps marker for 0 value in markers array
        //marker has map object as map attribute. position is a latlng object using tempLat and tempLon, title is the URL value in toDissect
        markers[i][0] = new google.maps.Marker({ position: new google.maps.LatLng(tempLat, tempLon), map: map, title: toDissect });

        //create new infoWindow, stores in 1 value of markers array
        //new infowindow using tempName as its string value
        markers[i][1] = new google.maps.InfoWindow({ content: tempName });

        //automatically opens the new infoWindow
        markers[i][1].open(map, markers[i][0]);

        //creates event listener, when marker is clicked, goes to URL denoted in markers title value
        markers[i][0].addListener('click', function () { document.location.href = "parkDisplay.php" + this.getTitle() });
    }

    //call mapResize
    mapResize();

}

function submitSearch() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(locateRedirect);
    } else {
        locateRedirect(NaN);
    }
}

function locateRedirect(position) {
    var lat;
    var long;
    try {
        lat = position.coords.latitude;
        long = position.coords.longitude;
    } catch (err) {
        lat = "-27.4698454"
        long = "153.0142625"
    }

    document.getElementById("searchLat").value = lat;
    document.getElementById("searchLong").value = long;
    window.setTimeout(function () {document.getElementById("searchForm").submit();},60)
}

function loadUser(urlValues) {
    window.location.href = "parkDisplay.php" + urlValues;
}

function starToRate(starValue) {

    var i;
    for (i = 1; i <= 5; i += 1) {
        var starToChange = document.getElementById("star" + i.toString());
        if (i <= starValue) {
            starToChange.src = "../images/starfull.png";
        } else {
            starToChange.src = "../images/starcase.png";
        }
    }
    document.getElementById("rating").value = starValue;
}

function clearStars() {
    var i;
    for (i = 1; i <= 5; i += 1) {
        var starToChange = document.getElementById("star" + i.toString());
        starToChange.src = "../images/starcase.png";
    }
}

function submitRating(userID, parkID, rating) {
    updateField('updateRating.php', "id=" + userID + "&parkid=" + parkID + "&rating=" + rating, 'rateError');
    window.setTimeout(function () { updateField('parkUserRating.php', "parkid=" + getFromURL("id="), 'userRatingDisplay'); }, 30);
}

function submitReview(ID, parkID, reviewID) {
    var reviewText = document.getElementById(reviewID).value;
    updateField('insertReview.php', "id=" + ID + "&parkid=" + parkID + "&review=" + reviewText, 'reviewError');
    window.setTimeout(function () { clearReview(reviewID); }, 30);
}

function clearReview(reviewID) {
    document.getElementById(reviewID).value = "";
}

function parkDisplayLoop() {

    updateField('parkTotalRating.php', "parkid=" + getFromURL("id="), 'parkRatingWrapper');

    updateField('parkUserRating.php', "parkid=" + getFromURL("id="), 'userRatingDisplay');

    updateField('selectReviews.php', "parkid=" + getFromURL("id="), 'frameContainer');
    
    window.setTimeout(function () { parkDisplayLoop(); }, 3000);
}

function updateField(fileToCall, argumentsToPass, outputToID) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById(outputToID) !== null) {
                document.getElementById(outputToID).innerHTML = this.responseText;
            }
        }
    }

    xhttp.open("POST", "../requests/"+fileToCall, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(argumentsToPass);
}