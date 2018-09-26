//function that throws an alert when the home page button is clicked
	function HomeButtonClicked(){
		alert("Clicked!");
	}

//function that changes the color of a div
	function Div1ColorClicked(){
		bgColor = document.getElementById("txtDiv1").value;
		document.getElementById("div1").style.backgroundColor = bgColor;
	}