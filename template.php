<!doctype html>
<?php
echo '
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
		<title>World of RNG</title>
		<link rel="stylesheet" "type="text/css" href="css/'.$_COOKIE[Theme].'.css?v=0.1">
		<link rel="icon" href="favicon.png">
	</head>
	<body onload="callFunction()">
		<header>
			<div id="title">World of RNG '.$timeleft.'</div>
			<div id="settings">
				<section class="container">
				    <form method="post" action="settings.php">
				    	<input type="submit" name="commit3" value="Settings">
					</form>
				</section>
			</div>

			<div id="refresh">
				<section class="container">
				    <form method="post" action="log.php">
				       	<input type="submit" name="commit3" value="Logout">
				  	</form>
				</section>
			</div>
				        
				   
			<div id="refresh2">
				<section class="container">   
					<form method="post" action="sync.php">
						<input type="submit" name="commit4" value="Refresh">
					</form>
					
				</section>
			</div>
		</header>
		<div id="left">
			<div id="stats">
				'.$statsTemplate.'
			</div>
			<div id="equip">
				'.$equipTemplate.'
				<div class="Character">
				<form method="post"action="sync.php" >
    				<select name="Character"  onchange="this.form.submit();">
        				<option>Select character...</option>
        				'.$options.'
						<option value="EMPTY"></option>
						<option value="CR">New Character</option>
  				 	 </select>
				</form>
				</div>
			</div>
			<div id="inventory">
				'.$inventoryTemplate.'
			</div>
		</div>
		
		<div id="right">
			<div id="social">
				'.$socialTemplate.'
				<div id="result"></div>
			</div>
		</div>
		<div id="middle">
			
		</div>
		<div id="actions">
				'.$actionsTemplate.'
			</div>
	</body>
	<footer class="linksB">
		<br>
		<a href="https://docs.google.com/document/d/1-mFNUtG5JPODgaGGs804xrI9LU587AgsUCHiIXmBTkQ/edit?usp=sharing" target="_blank">Change log (0.9.9.3.1)</b></a>
		<a href="https://github.com/rngGame/RNG/issues" target="_blank">BUGS? SUGGESTIONS?</a>
		<script>
		

		
			if(typeof(EventSource) !== "undefined") {
			    var source = new EventSource("chat_upd.php");
			    source.onmessage = function(event) {
			        document.getElementById("result").innerHTML = event.data ;
			    };
			} else {
			    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
			}

			function hide(a)
			{
				var id = a;
				var tf = "asd" + (id);
				var bt = "button" + (id);
				
			    document.getElementById(tf).style.display="none";
				document.getElementById(bt).onclick=function () { show(a) };


			}
			function show(a)
			{
				var id = a;
				var tf = "asd" + (id);
				var bt = "button" + (id);
				
			    document.getElementById(tf).style.display="block";
				document.getElementById(bt).onclick=function () { hide(a) };

			}
			function showDiv(elem){
			if(elem.value == 0){
     		document.getElementById("backpackWP").style.display = "block";
			document.getElementById("backpackAR").style.display = "block";
			document.getElementById("backpackAC").style.display = "block";
			document.getElementById("backpackIT").style.display = "block";
			document.getElementById("backpackSK").style.display = "block";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";
			document.cookie = "backpack=0";}
  			if(elem.value == 1){
     		document.getElementById("backpackWP").style.display = "block";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "inline";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";
			document.cookie = "backpack=1";}
			if(elem.value == 2){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "block";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "inline";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";
			document.cookie = "backpack=2";}
			if(elem.value == 3){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "block";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "inline";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";
			document.cookie = "backpack=3";}
			if(elem.value == 4){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "block";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "inline";
			document.getElementById("sellSK").style.display = "none";
			document.cookie = "backpack=4";}
			if(elem.value == 5){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "block";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "inline";
			document.cookie = "backpack=5";}
}

		window.onload = function() {
		if(document.getElementById("test").value == 0){
     		document.getElementById("backpackWP").style.display = "block";
			document.getElementById("backpackAR").style.display = "block";
			document.getElementById("backpackAC").style.display = "block";
			document.getElementById("backpackIT").style.display = "block";
			document.getElementById("backpackSK").style.display = "block";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";}
   		 if(document.getElementById("test").value == 1){
     		document.getElementById("backpackWP").style.display = "block";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "inline";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";}
		 if(document.getElementById("test").value == 2){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "block";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "inline";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";}
		 if(document.getElementById("test").value == 3){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "block";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "inline";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "none";}
		 if(document.getElementById("test").value == 4){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "block";
			document.getElementById("backpackSK").style.display = "none";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "inline";
			document.getElementById("sellSK").style.display = "none";}
		if(document.getElementById("test").value == 5){
     		document.getElementById("backpackWP").style.display = "none";
			document.getElementById("backpackAR").style.display = "none";
			document.getElementById("backpackAC").style.display = "none";
			document.getElementById("backpackIT").style.display = "none";
			document.getElementById("backpackSK").style.display = "block";
			document.getElementById("sellWP").style.display = "none";
			document.getElementById("sellAR").style.display = "none";
			document.getElementById("sellAC").style.display = "none";
			document.getElementById("sellIT").style.display = "none";
			document.getElementById("sellSK").style.display = "inline";}
};

   		function submitResult() {
   if ( confirm("Are you sure you wish to sell all selected ?") == false ) {
      return false ;
   } else {
      return true ;
   }
}

		</script>
		
		

	</footer>

</html>


';
?>

		


	

