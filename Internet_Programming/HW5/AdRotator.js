
/*
 * Here are the javascript codes for part 1
 */

//here is the global element we dynamically add
var myDiv;

/* Arrays with the data information */
var imgList =new Array("image1", "image2", "image3");
var toolKitNames = new Array("Anderson Hall","Keller Hall","Mechanical Engineering");

// this varibale is used to work for double click the button
var clicked = false;

function renderImage(subEvent,action)
{
	if(clicked === false)
	{
	    var mainEvent = subEvent ? subEvent : window.event;

		var parentNode
	    
	    //we get the position of the x,y for the button
	    var x_pos = mainEvent.screenX -20;
	    var y_pos = mainEvent.screenY -80;
	    
	    var image = imgList[action] + ".jpg";
	    
	    
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
	    imageNode.onmouseover=createToolKit(action);
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
		clicked = true;
}else{
	deleteMydiv();
	clicked = false;
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



/*
 * Here are the javascript code for the part 2
 */

adImageList=new Array("oscar.jpg", "ice.jpg", "bowl.jpg");

var count = 1;//the global value we keep track of to determine which image to show
var interval = 5;
var curtime = 0;
var bannerImage = document.getElementById("adPicture");

var setGrayElement;
var setBlueElement;
var setOrangeElement;
//alert(bannerImage === null)
//bannerImage.setAttribute("src",adImageList[0]);
//bannerImage.src=adImageList[1];
var rotateImage;

//set up for the toolkit div we create
var AdAdToolKitNames=new Array("A Night at the Oscars<br>Sat, Feb 27 5-11pm",
		"Ice Extravaganza<br>Mon, Feb 29 11:00AM","Beach Bowl<br>Fri, Mar 4 7-10pm");
var AdToolKit = document.createElement("div");
AdToolKitStyle = AdToolKit.style;
AdToolKitStyle.width="150px";
AdToolKitStyle.height="50px";
AdToolKitStyle.backgroundColor="fuchsia";
AdToolKitStyle.align="center";
AdToolKitStyle.position="absolute";
AdToolKitStyle.left="600px";
AdToolKitStyle.top="420px";
AdToolKitStyle.display="none";
document.getElementsByClassName("banner")[0].appendChild(AdToolKit);

//when we first load in ,we need to initiliza the first image
init();

//initiliza for rotating the image
function init(){
	rotateImage = setInterval(function(){showAdImage()},1000);
}

function showAdImage()
{
//	count %= 3; 
//	console.log(count);
//	alert(count/3);
//	alert(bannerImage === null);
	curtime++;
	if(curtime === interval){
		bannerImage.setAttribute("src",adImageList[count]);
//		var setGrayElement;
//		var setBlueElement;
		AdToolKit.innerHTML=AdAdToolKitNames[count];
		if(count === 0)
		{
			setGrayElement = document.getElementById("bulletButton3");
			setBlueElement = document.getElementById("bulletButton1");
			interval = 5;
			count = 1;
		}else if(count === 1)
		{
			setGrayElement = document.getElementById("bulletButton1");
			setBlueElement = document.getElementById("bulletButton2");
			interval = 7;
			count = 2;
		}else
		{
			setGrayElement = document.getElementById("bulletButton2");
			setBlueElement = document.getElementById("bulletButton3");
			interval = 3;
			count = 0;
		}
		curtime=0;
		setGrayElement.setAttribute("src","bullet_gray.png");
		setBlueElement.setAttribute("src","bullet_blue.png");
	}
//	console.log(adImageList[count]);
//	console.log(count);		
//	count++;		
}

//previous button function
function preButton()
{
	clearInterval(rotateImage);
//	alert(--count);
//	count--;
//alert(count);
//	var setGrayElement;
//	var setBlueElement;
	var cur;
	if(count === 0)
	{
		cur = 1;
		count=2;
		interval = 7;
		setBlueElement=document.getElementById("bulletButton2");
		setGrayElement=document.getElementById("bulletButton3");
	}else if(count === 1)
	{
		cur = 2;
		count = 0;
		interval = 3;
		setBlueElement=document.getElementById("bulletButton3");
		setGrayElement=document.getElementById("bulletButton1");
	}else
	{
		cur = 0;
		count = 1;
		interval = 5;
		setBlueElement=document.getElementById("bulletButton1");
		setGrayElement=document.getElementById("bulletButton2");
	}
	curtime = 0;
//	alert(count);
//	clearInterval(rotateImage);
	bannerImage.setAttribute("src",adImageList[cur]);
	setGrayElement.setAttribute("src","bullet_gray.png");
	setBlueElement.setAttribute("src","bullet_blue.png");
	init();
//	rotateImage = setInterval(function(){showAdImage()},1000);
}

//next button function
function nextButton()
{
//	count--;
//	var setGrayElement;
//	var setBlueElement;	
	var cur;
	if(count === 0)
	{
		cur = 0;
		count=1;
		interval = 5;
		setBlueElement=document.getElementById("bulletButton1");
		setGrayElement=document.getElementById("bulletButton3");
	}else if(count === 1)
	{
		cur = 1;
		count = 2;
		interval = 7;
		setBlueElement=document.getElementById("bulletButton2");
		setGrayElement=document.getElementById("bulletButton1");
	}else
	{
		cur = 2;
		count = 0;
		interval = 3;
		setBlueElement=document.getElementById("bulletButton3");
		setGrayElement=document.getElementById("bulletButton2");
	}
	curtime = 0;
	
	//reset the funciton
	bannerImage.setAttribute("src",adImageList[cur]);
	setGrayElement.setAttribute("src","bullet_gray.png");
	setBlueElement.setAttribute("src","bullet_blue.png");
	clearInterval(rotateImage);
	init();
}

//this is the function when hover on the next and previous button
function showOrangeButton(num)
{

	var elt;
	if(num === 1)
	{
		elt = document.getElementById("prevOrange");
		if(elt.src !=="prev_orange.png")
		{
			elt.src="prev_orange.png";
		}
	}else{
		elt = document.getElementById("nextOrange");
		if(elt.src !=="next_orange.png")
		{
			elt.src="next_orange.png";
		}		
	}
	
}

function deleteOrangeButton(num)
{

	var elt;
	if(num === 1)
	{
		elt = document.getElementById("prevOrange");
		if(elt.src !=="prev_blue.png")
		{
			elt.src="prev_blue.png";
		}
	}else{
		elt = document.getElementById("nextOrange");
		if(elt.src !=="next_blue.png")
		{
			elt.src="next_blue.png";
		}		
	}
	
}

//this is the function when we click the bullet button
function bulletButton(num)
{
//	var setGrayElement;
//	var setBlueElement;	
	var cur = num;
	if(num === 0)
	{
		count=1;
		interval = 5;
		var tmp = setBlueElement;
		setBlueElement=document.getElementById("bulletButton1");
		setGrayElement = tmp;	
		
	}else if(num === 1)
	{
		count=2;
		interval = 7;
		var tmp = setBlueElement;
		setBlueElement=document.getElementById("bulletButton2");
		setGrayElement = tmp;
		
	}else{
		count=0;
		interval = 3;
		var tmp = setBlueElement;
		setBlueElement=document.getElementById("bulletButton3");
		setGrayElement = tmp;		
	}
	curtime = 0;
	
	//reset the funciton
	bannerImage.setAttribute("src",adImageList[cur]);
	setGrayElement.setAttribute("src","bullet_gray.png");
	setBlueElement.setAttribute("src","bullet_blue.png");
	clearInterval(rotateImage);
	init();	
}

//this function is used to change the image of bullet button once we hover the button
function mouseOverEvent(num)
{
//	var element = document.getElementById("bulletButton"+num);
	setOrangeElement= document.getElementById("bulletButton"+num);
//	alert("button"+num);
//	alert(element.getAttribute("src"));
	if(setOrangeElement.getAttribute("src") === "bullet_gray.png")
	{
		setOrangeElement.setAttribute("src","bullet_orange.png");
	}
}

//this function is used to change the image of bullet button once we hover out the button
function mouseOverOut(num)
{
	if(setOrangeElement.getAttribute("src") !== "bullet_blue.png")
	{
		setOrangeElement.setAttribute("src","bullet_gray.png");
	}
}

//this function is used to show the corresponding URL in the banner 
function showURL()
{
	var curURL;
	if(count === 0)
	{
		curURL = "http://sua.umn.edu/events/calendar/event/14616/";
	}else if(count === 1)
	{
		curURL = "http://sua.umn.edu/events/calendar/event/14601/";
	}else{
		curURL="http://sua.umn.edu/events/calendar/event/14617/";
	}
	window.open(curURL);
}

//this function is used to show the toolkit of a image
function showAdToolKit()
{
	var cur;
	if(count === 0)
	{
		cur = 2;
		
	}else if(count === 1)
	{
		cur = 0;
	}else{
		cur = 1;
	}
	
	AdToolKit.innerHTML=AdAdToolKitNames[cur];
	AdToolKitStyle.display="inline-block";
	
}

function deleteAdToolKit()
{
	AdToolKitStyle.display="none";
}





