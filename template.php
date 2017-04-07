<!doctype html>
<?php
echo '
<html>
	<head>
		<meta charset="utf-8">
		<title>World of RNG</title>
		<link rel="stylesheet" type="text/css" href="css/'.$_COOKIE[Theme].'.css">
		<link rel="icon" href="favicon.png">
	</head>
	<body>
		<header>
			<div id="title">World of RNG</div>
			<div id="settings">
				<section class="container">
				 	<p class="submit">
				    	<form method="post" action="settings.php">
				        	<input type="submit" name="commit3" value="Settings">
				     	</form>
				    </p>
				</section>
			</div>

			<div id="refresh">
				<section class="container">
				    <p class="submit">
				    	<form method="post" action="log.php">
				        	<input type="submit" name="commit3" value="Logout">
				     	</form>
				    </p>
				</section>
			</div>
				        
				   
			<div id="refresh2">
				<section class="container">
					<p class="submit">    
						<form method="post" action="sync.php">
							<input type="submit" name="commit4" value="Refresh">
						</form>
					</p>
				</section>
			</div>
		</header>
		<div id="stats">
			'.$statsTemplate.'
		</div>
		<div id="equip">
			'.$equipTemplate.'
		</div>
		<div id="social">
			'.$socialTemplate.'
		</div>
		<div id="actions">
			'.$actionsTemplate.'
		</div>
		<div id="inventory">
			'.$inventoryTemplate.'
		</div>
	</body>
	<footer>
		<br>
		<a href="https://docs.google.com/document/d/1-mFNUtG5JPODgaGGs804xrI9LU587AgsUCHiIXmBTkQ/edit?usp=sharing" target="_blank">Change log (0.9.5pre) !!!GAME BROKEN!!</b></a><br>
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

		</script>
	</footer>
</html>



';