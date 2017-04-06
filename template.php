<?php
echo '
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>World of RNG</title>
		<link rel="stylesheet" type="text/css" href="css/$_COOKIE[Theme].css">;
		<link rel="icon" href="favicon.png">
	</head>
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
		<div id="wrapper">
			<div id="first">
	</header>
	<body>
		<div id="wrapper">
			<div id="first">
	</body>
</html>



';