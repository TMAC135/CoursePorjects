


<!--html part-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style>
		#floating-panel{
			position: relative;
			left: 7px;;
			width: 150px;
			height: 230px;
			background-color: ghostwhite;
		}
		#map{
		position: absolute;
      	width: 80%;
        height: 80%;
        /*margin-left: 30%;*/
		}	
		</style>
	</head>
	<body>
		<div id="map">			
		</div>
		<div id="floating-panel">
			<!--contends of the float panel-->
			<form id="myForm" action = "tianx253.php" method="get">
			<!--radio-->
			<input type="radio" name="categories" value="art_gallery" />Arts<br>
			<input type="radio" name="categories" value="restaurant" />Food<br>
			<input type="radio" name="categories" value="doctor"/>Doctor<br>
			<input type="radio" name="categories" value="clothing_store"/>Clothing Store<br>
			<input type="radio" name="categories" value="shopping_mall"/>Shop Mall<br>
			<input type="radio" name="categories" value="travel_agency"/>Travel<br>
			<input type="radio" name="categories" value="university"/>University<br>
			<!--label-->
			<label>Radius(M):</label><br>
			<!--slider-->
			<input type="range" name="slider" id="slider" min="0" max="3000" step="100" value="<?php
			echo $_GET['slider'];
			?>"
				onchange="updateText(this.value);"/><br>
			<input type="text" value="<?php if(isset($_GET['slider'])) echo $_GET['slider']?>
			" id="showText" name='showText' disabled="true"/><br>
	
			<!--hidden input for the latitude and longitude-->
			<input type="hidden" id="lati" name="lati" value="<?php echo $_GET['lati']?>" />
			<input type="hidden" id="long" name="long" value="<?php echo $_GET['long']?>" />
			<!--submit button-->
			<input type="submit" id="submit" /><br>
			</form>
		</div>

        <!--php part-->
  <?php
	ini_set('display_errors', 'On');
    error_reporting(E_ALL);

	//echo $_GET['lati'];
	//var_dump(isset($_GET['slider']));
	//var_dump(isset($_GET['categories']));
	//var_dump($_GET['categories'] == undefined);
	// if(is_null($_GET['categories'])){
	// 	exit();
	// }
	
	$lat = [];
	$lng = [];
	$name = [];
	$icon = [];
	$categories = null;
	if(isset($_GET['slider'])){
		if(!is_null($_GET['categories']) && $_GET['lati'] !== '' && $_GET['long'] !== ''){
			//echo 'haha';
			$categories = $_GET['categories'];
			$lati = $_GET['lati'];
			$long = $_GET['long'];
			$radius = $_GET['slider'];
			// echo $categories;
			// echo $lati;
			// echo $long;

			//https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=44.98176901546037,-93.23955046859282&radius=1000&type=restaurant&key=AIzaSyCiKgZ43xvIdGUtvv1TCZgMOzjwNC1X290

			$jsonurl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lati.','.$long.'&radius='.$radius.'&type='.$categories."&key=AIzaSyCiKgZ43xvIdGUtvv1TCZgMOzjwNC1X290";
			// $jsonurl = 	"https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=44.98176901546037,-93.23955046859282&radius=1000&type=restaurant&key=AIzaSyCiKgZ43xvIdGUtvv1TCZgMOzjwNC1X290";

			// var_dump($jsonurl);
			$str = file_get_contents($jsonurl,0,null,null);
			// var_dump($str);
			$json = json_decode($str);
			// $arr = $json->results;
			// var_dump($json->results);
			// var_dump($arr[0]);

			// store the results in the corresponding array in php
			foreach ($json->results as $res) {
				$lat[] = $res->geometry->location->lat;
				$lng[] = $res->geometry->location->lng;
				$name[] = $res->name;
				$icon[] = $res->icon;
			}
			// var_dump($lat);
			// var_dump($icon);

		}


	}
	
?>  
		
		<!--javascript code-->
		<script>
//show the value when we slide the slider
			function updateText(val){
				document.getElementById("showText").value=val;
			}

//map part
			var map;
			var querymarker;
			var infowindow;
			var json;
			function initMap(){
				//the initial position is around the University of Minnesota
				map = new google.maps.Map(document.getElementById('map'), {
			    zoom: 15,
			    center: {lat: 44.977276, lng: -93.232266}
			  });
			    // This event listener calls addMarker() when the map is clicked.
				  google.maps.event.addListener(map, 'click', function(event) {
				    addMarker(event.latLng, map);
				    
				    //assign the lat and lng to the lati and long for the input type,we keep override these values
				    document.getElementById("lati").value = event.latLng.lat();
				    document.getElementById("long").value = event.latLng.lng();				    
				  });

				 

				  //get the array from php array
				  var lat = <? echo json_encode($lat); ?>;
				  var lng = <? echo json_encode($lng); ?>;
				  var name = <? echo json_encode($name); ?>;
				  var icon = <? echo json_encode($icon); ?>;
				  var categories = <? echo json_encode($categories); ?>;
				  // alert(lat == '');
				  if(lat !== '' && categories !== null){
				  	createMarker(lat,lng,name,icon);//plot the marker for the nearby places
				  }else{
				  	alert("you need to put a marker on the map and select the category on the form");
				  }
			}

			// Adds a marker to the map.
			function addMarker(location, map) {
			  // Add the marker at the clicked location, and add the next-available label
			  // from the array of alphabetical characters.
			  // alert(typeof location);
			  querymarker = new google.maps.Marker({
			    position: location,
			    map: map
			  });
			  
//			  alert(typeof location);
//			  alert(location);
			  console.log(location.lng());
			}

			var directionsService;
			var directionsDisplay;
			
			//function to place markers given the arrays
			function createMarker(lat,lng,name,icon){
				var marker=[];
				var infowindow = [];
				for(var i=0;i<lat.length;i++){
					infowindow[i] = new google.maps.InfoWindow({
						    content: name[i]+"<br>"+lat[i]+"<br>"+lng[i]
						  });

				    var image = {
				      url: icon[i],
				      size: new google.maps.Size(71, 71),
				      origin: new google.maps.Point(0, 0),
				      anchor: new google.maps.Point(17, 34),
				      scaledSize: new google.maps.Size(25, 25)
				    };

				    marker[i] = new google.maps.Marker({
				      map: map,
				      icon: image,
				      title: name[i],
				      position: {'lat':lat[i],'lng':lng[i]}
				    });

				    // marker[i].addListener('click',function(){
				    // 	// infowindow[i].open(map, marker[i]);
				    // 	createInfo(map,marker[i],infowindow[i]);
				    // });
					directionsService = new google.maps.DirectionsService;
  					directionsDisplay = new google.maps.DirectionsRenderer;
  					directionsDisplay.setMap(map);
				    google.maps.event.addListener(marker[i], 'click', createInfo(map,marker[i],infowindow[i]));
				    google.maps.event.addListener(marker[i], 'click', addRoute(lat[i],lng[i]));
				}

					var querymarker = new new google.maps.Marker({
				      map: map,
				      title: 'this is the query marker',
				      position: {'lat':parseFloat(document.getElementById("lati").value),'lng':parseFloat(document.getElementById("long").value)}
				    });
			}
			//create the information box
			function createInfo(map,marker,info){
				return function(){
					info.open(map,marker);
				}
			}
			//plot the route
			function addRoute(lat,lng){
				return function(){
				directionsService.route({
			    origin:new google.maps.LatLng(document.getElementById("lati").value,document.getElementById("long").value),
			    destination:new google.maps.LatLng(lat,lng),
			    // origin:"chicago",
			    // destination:"new york",
			    travelMode: google.maps.TravelMode.WALKING
			  }, function(response, status) {
			  			// display.setDirections(response);

			    if (status === google.maps.DirectionsStatus.OK) {
			      // initMap();	
			      // directionsDisplay.setMap(null);
			      // display.setMap(map);
			      // display.setDirections({routes: []});
			      // delete the previous route first
			      directionsDisplay.set('directions', null);
			      directionsDisplay.setDirections(response);
			    } /*else {
			      window.alert('Directions request failed due to ' + status);
			    }*/
			  });
			}

			}

		</script>

		<!--outer google map api-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVZDR85EzFhJGc74hP1VAvwolIcOEtce4&signed_in=true&callback=initMap"
        async defer></script> 
        
	</body>
</html>

