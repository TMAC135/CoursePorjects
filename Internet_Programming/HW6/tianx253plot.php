
<!--parse the Json files-->
<?php
	ini_set('display_errors', 'On');
	echo '<prev>';

	$stringA = file_get_contents("pointsA.json");
	$json_a = json_decode($stringA, true);
	// echo var_dump($json_a);
	// print_r($json_a);
	// echo var_dump(is_array($json_a));//true
	// echo "<hr>";

	$stringB = file_get_contents("pointsB.json");
	$json_b = json_decode($stringB, true);
	// echo var_dump($json_b);
	// print_r($json_b);
	// echo "<hr>";

	$stringCenter = file_get_contents("center.json");
	$json_center = json_decode($stringCenter, true);
	// echo var_dump($json_center);
	// echo "<hr>";

	$location_a = $json_a["locations"];
	$location_b = $json_b["locations"];

	//get the size information for the array
	$num_location = sizeof($location_a);
	$inf_num = sizeof($location_a[0]);

	// echo var_dump($location_a[0]["lat"]);//string 
	// echo sizeof($location_b[0]);//get the size of the array

	$to_javascript = array();//I use array to store the information
	$to_javascript["center"] = $json_center["center"];
	$to_javascript["zoom"] = $json_center["zoom"];
	$to_javascript["pairs"] = array();

	//use a flag array with false to indicate whether the element is been visited
	$flag = array();
	for($x=0;$x<$num_location;$x++){
		$flag[$x] = false;
	}

	for($x=0;$x<$num_location;$x++){
		$to_javascript["pairs"][$x] = array();

		$lat_a = floatval($location_a[$x]["lat"]);
		$lon_a = floatval($location_a[$x]["long"]);
		$name_a = $location_a[$x]["name"];

		$min = 999999999;//initiliza the min variable with a big value
		$min_index = -1;
		for ($y=0; $y < $num_location; $y++) { 
			if($flag[$y] === false){
				$lat_b = floatval($location_b[$x]["lat"]);
				$lon_b = floatval($location_b[$x]["long"]);
				$name_b = floatval($location_b[$x]["name"]);

				$distance = pow($lat_b-$lat_a,2) + pow($lon_b-$lon_a,2);//ignore the sqare root since it doesn't influence the result.
				if($distance < $min){
					$min_index = $y;
					$min = $distance;
				}
			}
		}
		$flag[$min_index] = true;

		//append the pairs in the stored array: $to_javascript
		$to_javascript["pairs"][$x]["lat"] = array($lat_a,$location_b[$min_index]["lat"]);
		$to_javascript["pairs"][$x]["long"] = array($lon_a,$location_b[$min_index]["long"]);
		$to_javascript["pairs"][$x]["name"] = array($name_a,$location_b[$min_index]["name"]);
	}
	// print_r($to_javsascript);
	echo '</prev>';

?>

<!-- HTML part -->
<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>PHP tests</title>
    <!-- I use the php.css to style this file -->
    <link rel="stylesheet" type="text/css" href="php.css">

  </head>
  <body>
  	<h1 class="header">PHP test</h1>
  	<div id="map"></div>
	 <script>
	 	// get the object from the php
		obj = JSON.parse('<?php echo json_encode($to_javascript); ?>');
		// alert(obj.pairs[1]["lat"]);
		// document.writeln(typeof(obj.zoom));
		// document.writeln(typeof(obj.center["lat"]));

        var map;
        function initMap() {
        	// get the center and zoom and initiliza it
			var myLatLng = {lat: parseFloat(obj.center["lat"]), lng: parseFloat(obj.center["long"])};
	        map = new google.maps.Map(document.getElementById('map'), {
	        	center: myLatLng,
	        	zoom: parseFloat(obj.zoom)
	        });
	        
	        // place the marker and draw the polylines here
	        // var geocoder = new google.maps.Geocoder(); // Create a geocoder object
	        pairs = obj.pairs;
	        for(var keys in pairs){
	        	var tmp_lat = pairs[keys]["lat"];
	        	var tmp_lon = pairs[keys]["long"];
	        	var tmp_name = pairs[keys]["name"];

                plotMarker(parseFloat(tmp_lat[0]),parseFloat(tmp_lon[0]),tmp_name[0]);
                plotMarker(parseFloat(tmp_lat[1]),parseFloat(tmp_lon[1]),tmp_name[1]);

                plotLine(tmp_lat,tmp_lon);
					        	
			}        
	        
      	}

      	//this function is used to plot the marker
      	function plotMarker(latitude,longitude,info){
      		var aLL = {lat: latitude, lng:longitude};

      		var marker = new google.maps.Marker({
      			position:aLL,
      			map:map,
      			title:info
      		});

      	}

      	//this function is used to plot the lines
      	function plotLine(obj1,obj2){

		  var lineCoordinates =[
		  	{lat:parseFloat(obj1[0]),lng:parseFloat(obj2[0])},
		  	{lat:parseFloat(obj1[1]),lng:parseFloat(obj2[1])}
		  ];

		  var path = new google.maps.Polyline({
		    path: lineCoordinates,
		    geodesic: true,
		    strokeColor: '#FF0000',
		    strokeOpacity: 1.0,
		    strokeWeight: 2
		  });
		  path.setMap(map);


      	}

	</script>
	<!--add the outer link for the google map-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVZDR85EzFhJGc74hP1VAvwolIcOEtce4&signed_in=true&callback=initMap"
        async defer></script>
  <p class="italic">*This page is tested in Google Chrome</p>
  </body>
</html>