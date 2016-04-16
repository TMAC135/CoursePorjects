
<?php

/*https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&type=restaurant&name=cruise&key=AIzaSyCiKgZ43xvIdGUtvv1TCZgMOzjwNC1X290
 */




<input id="slider2" name="slide2" type="range" min="0" max="3000" step="50" value="<?php if(isset($_GET['slide2'])) echo $radius ?> onchange="updateTextInput2(this.value);" />
<br>
<input type=""text" name="sliderbox" id="textInput2" disabled = "true" value="" />


<?php 
	if(isset($_GET['slider2'])){
		if(isset($_GET['category']) && is_array($_GET['category'])){
			foreach($_GET['category'] as $f){
				$a[] = $f;
			}
			$str = implode(',',$a);
			
		}
		$category = $_GET['category'];
		$radius = $_GET['slider2'];
		$limit = $_GET['slider'];
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
		$jsonurl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.','.$lng.'
		radius='.$radius.'type='.$str."key=AIzaSyCiKgZ43xvIdGUtvv1TCZgMOzjwNC1X290";
		
		$json = file_get_contents($jsonurl,0,null,);
		var_dump($json);
		$jsonoutput= json.decode($json);
		
		//pass thtough the jason output
		foreach($jsonoutput->results as $result){
			$lat[]
			$lng=[]
			$name[]
			$icon[]=
		}
		
	}


<?php echo $lng[$y] ?>
