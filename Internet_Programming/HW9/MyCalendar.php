
<!-- PHP part -->
<?php

// check the session varibles 
session_start();
if( empty($_SESSION['login']) || empty($_SESSION['password']) || empty($_SESSION['name']))
{
	header('Location:login.php');
	exit();
}

?>



<!DOCTYPE html>
<!-- My calender -->
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ran Tian's Calender</title>
		<link rel="stylesheet" type="text/css" href="AdRotator.css" />
		<!--<script src="AdRotator.js"></script>-->

		<style>
			/*style for the up right part*/
			#user{
				position: absolute;
				left:1100px;
				top:10px;
				background-color: aquamarine;
			}
			#userName{
				font-size: larger ;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id = 'user'>
			<label id="userName"> Welcome <?php echo $_SESSION['name']?></label><br><br>
			<a id="logout" href="logout.php" >Logout</a>
		</div>



		<!-- head tille -->
		<div>
			<h1>My Calendar</h1>
		</div>
		<div class="ToolBar">
			<nav>
				<a href="MyCalendar.php">Calendar</a>
				<a href="CalendarInput.php">Input</a>
				<a href='admin.php'>admin</a>
			</nav>
		</div>
		<!-- contend of the calendar -->
		<div id="table">
			<table>
				<!-- header for the calender -->
				<thead>
					<tr>
						<th class="CalendarDay"><span class="dayHeader">WeekDay</span></th>
						<th colspan="2" class="CalendarContend"><span class="dayHeader">Course Details</span></th>
					</tr>
				</thead>
				<!-- Monday -->
				<tr>
					<td class="CalendarDay"><span class="dayHeader">Monday</span></td>
					<!-- CSCI 4131 -->
					<td class="CalendarContend"><span class="italic">11:15-12:30pm</span><br/>
						<a href="https://ay15.moodle.umn.edu/course/view.php?id=13093" target="_blank">CSCI 4131</a><br/>
						<span onmouseover="loadPicture(event,'http://3.bp.blogspot.com/_Gfqu_HqqeaU/SutJ3T_Ek0I/AAAAAAAADSU/KC1adY8OuMU/s400/andersonhall')" onmouseout="deletePictue()">Amunson Hall 350</span>
						<br>
						<!--<button id="button1" onclick="renderImage(event,0)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
				</tr>
				<!-- Tuesday -->
				<tr>
					<td class="CalendarDay"><span class="dayHeader">Tuesday</span></td>
					<!-- EE 8581 -->
					<td class="CalendarContend"><span class="italic">11:15-12:30pm</span><br/>
						<a href="https://ay15.moodle.umn.edu/course/view.php?id=13093" target="_blank">EE 8581</a><br/>
						<span onmouseover="loadPicture(event,'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg')" onmouseout="deletePictue()">Keller Hall 3125</span>	
						<br>
						<!--<button id="button2" onclick="renderImage(event,1)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
					<!-- CSCI 5561 -->
					<td class="CalendarContend"><span class="italic">1:00-2:15pm</span><br/>
						<a href="https://ay15.moodle.umn.edu/course/view.php?id=13093" target="_blank">CSCI 5561</a><br/>
						<span onmouseover="loadPicture(event,'https://cse.umn.edu/wp-content/uploads/2015/05/me_building.jpg')" onmouseout="deletePictue()">Mechanical Engineering 212</span>	
						<br>
						<!--<button id="button3" onclick="renderImage(event,2)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
				</tr>
				<!-- Wednesday -->
				<tr>
					<td class="CalendarDay"><span class="dayHeader">Wednesday</span></td>
					<!-- CSCI 4131 -->
					<td class="CalendarContend"><span class="italic">11:15-12:30pm</span><br/>
						CSCI 4131<br/>
						<span onmouseover="loadPicture(event,'http://3.bp.blogspot.com/_Gfqu_HqqeaU/SutJ3T_Ek0I/AAAAAAAADSU/KC1adY8OuMU/s400/andersonhall')" onmouseout="deletePictue()">Amunson Hall 350</span>	
						<br>
						<!--<button id="button4" onclick="renderImage(event,0)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
					<!-- EE 5393 -->
					<td class="CalendarContend"><span class="italic">2:30-3:45pm</span><br/>
						EE 5393<br/>
						<span onmouseover="loadPicture(event,'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg')" onmouseout="deletePictue()">Keller Hall 3230</span>
						<br />
						<!--<button id="button5" onclick="renderImage(event,1)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
				</tr>
				<!-- Thursday -->
				<tr>
					<td class="CalendarDay"><span class="dayHeader">Thursday</span></td>
					<!-- EE 8581 -->
					<td class="CalendarContend"><span class="italic">11:15-12:30pm</span><br/>
						EE 8581<br/>
						<span onmouseover="loadPicture(event,'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg')" onmouseout="deletePictue()">Keller Hall 3125</span>	
						<br>
						<!--<button id="button6" onclick="renderImage(event,1)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
					<!-- CSCI 5561 -->
					<td class="CalendarContend"><span class="italic">1:00-2:15pm</span><br/>
						CSCI 5561<br/>
						<span onmouseover="loadPicture(event,'https://cse.umn.edu/wp-content/uploads/2015/05/me_building.jpg')" onmouseout="deletePictue()">Mechanical Engineering 212</span>
						<br>	
						<!--<button id="button7" onclick="renderImage(event,2)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
				</tr>
				<!-- Friday -->
				<tr>
					<td class="CalendarDay"><span class="dayHeader">Friday</span></td>
					<!-- EE 5393 -->
					<td class="CalendarContend"><span class="italic">2:30-3:45pm</span><br/>
						EE 5393<br/>
						<span onmouseover="loadPicture(event,'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg')" onmouseout="deletePictue()">Keller Hall 3230</span>
						<br>
						<!--<button id="button8" onclick="renderImage(event,1)" ondblclick="deleteMydiv()">picture</button>-->
						<!--<div style="width: 500px;height: 500px;background-color: red;position: absolute;"></div>-->
					</td>
				</tr>
			</table>
			
			<p id="demo">before ajax</p>
		</div>
				
		<!-- Test browser -->
		<p class="italic">*This pasge is tested in Google Chrome</p>
		<p>Pictures are taken from following links:<br>
		https://campusmaps.umn.edu/anderson-hall<br>
		https://arduino.mn/about/<br>
		https://campusmaps.umn.edu/mechanical-engineering<br>
		</p>
		
		<!--this is the AJAX function for the HW7-->
		<script>
			var ajax;
			//Ajax when we mouse hover the address
			function loadPicture(event,url){
//				var url = "https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg";
				ajax = new XMLHttpRequest();
				ajax.open("GET",url,true);
				ajax.send(null);

				ajax.onreadystatechange=function(){
					if(ajax.readyState == 4 && ajax.status == 200){

						renderImage(event,url);
					}
				};
				
							
			}
			//Ajax when we go mouse out the adress
			function deletePictue(){
				ajax = new XMLHttpRequest();
				ajax.open("GET",'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg',true);
				ajax.send(null);

				ajax.onreadystatechange=function(){
					if(ajax.readyState == 4 && ajax.status == 200){

						deleteMydiv();
					}
				};				
			}
			
			
			
			//here is the global element we dynamically add
			var myDiv;
			
			/* Arrays with the data information */
//			var imgList =new Array("image1", "image2", "image3");
			var toolKitNames = new Array("Anderson Hall","Keller Hall","Mechanical Engineering");
			
			
			
			
			function renderImage(subEvent,url)
			{
			    var mainEvent = subEvent ? subEvent : window.event;
			
				var parentNode;
				var action;
				if(url === 'http://3.bp.blogspot.com/_Gfqu_HqqeaU/SutJ3T_Ek0I/AAAAAAAADSU/KC1adY8OuMU/s400/andersonhall'){
					action = 0;
				}else if(url === 'https://c2.staticflickr.com/6/5551/14661941148_9efc34209c_b.jpg'){
					action = 1;
				}else{
					action = 2;
				}
			    
			    //we get the position of the x,y for the button
			    var x_pos = mainEvent.screenX - 100;
			    var y_pos = mainEvent.screenY - 112;
			    
//			    var image = imgList[action] + ".jpg";
				var image = url;
			    
			    
				if(document.getElementById("myDiv") === null)
				{
			    myDiv = document.createElement("div");
			    myDiv.setAttribute("id","myDiv");
			    
			    //set the myDiv style we dynamically create
			    myStyle = myDiv.style;
			    myStyle.position="absolute";
			    myStyle.left=x_pos.toString()+"px";
			    myStyle.top=y_pos.toString()+"px";
			    myStyle.width="500px";
			    myStyle.height="500px";
			    myStyle.backgroundColor="black";
			    myStyle.alignContent="center";
			    myStyle.borderStyle="double";
			    myStyle.borderWidth="medium";
			    
			    
			    //render the image elment and style it within the div element
			    imageNode = document.createElement("img");
			    imageNode.setAttribute("id","image");
			    myDiv.appendChild(imageNode);
			    
			    imageStyle = imageNode.style;
			    imageStyle.width="300px";
			    imageStyle.height="300px";
			    imageStyle.marginTop="70px";
			    imageNode.setAttribute("onclick","deleteMydiv()");//once we click the image, we delete the div element
			    imageNode.setAttribute("src",image);//add the attribute for the src
//			    imageNode.onmouseover=createToolKit(action);
//				document
			    createToolKit(action);
			//  myDiv.appendChild(imageNode);
			    
			       
				bodyNode = document.getElementsByTagName("body");
				bodyNode[0].appendChild(myDiv);
				}
				else
				{
					myDiv = document.getElementById("myDiv");
					imageNode = document.getElementById("image");
					
					myStyle = myDiv.style;
				    myStyle.left=x_pos.toString()+"px";
				    myStyle.top=y_pos.toString()+"px";	
				    
			//	    imageStyle = imageNode.style;
				    imageNode.setAttribute("src",image);		
				}
			}
			
			
			//function to delete the myDiv we create
			function deleteMydiv()
			{
			//	alert(myDiv === null);
				if(myDiv !== null)
				{
					bodyNode = document.getElementsByTagName("body");
					bodyNode[0].removeChild(myDiv);
				}
			}
			
			//I use a div to show the information of the image-toolkit
			function createToolKit(action)
			{
				if(document.getElementById("toolKit") === null)
				{
					toolKitName = document.createElement("div");
					toolKitName.id="toolKit";
				    toolKitStyle = toolKitName.style;
				    toolKitStyle.backgroundColor="greenyellow";
				    toolKitStyle.width="200px";
				    toolKitStyle.height="50px";
				    toolKitStyle.align="center";
				    toolKitStyle.marginLeft="150px";
				    	        
				    toolKitName.innerHTML=toolKitNames[action];
				    myDiv.appendChild(toolKitName);		
				}	
			}
		</script>
	</body>
</html>