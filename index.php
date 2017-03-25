<?php
session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="css/meniu.css"><link rel="icon" href="favicon.png">
<link rel="icon" href="favicon.png">
</head>
<body>
<header>
World Of RNG
</header>

<?php
if (!isset($_SESSION["User"])){
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<section class="container">
    <div class="login">
      <h1>Login to World Of RNG</h1>
      <form method="post" action="check.php">
        <p><input type="text"  name="login" value="" placeholder="Username" required></p>
        <p><input type="password" name="password" value="" placeholder="Password" required></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
	  <form action="reg.php">
    <input type="submit" value="Register">
</form>
    </div>
  </section>

<body>
</body>
</html>';
}
else {
	echo '
<section class="container">
    <div class="Game">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Game"></p>
      </form>
    </div>
  </section>
	<section class="container">
    <div class="logout">
	      <form method="post" action="log.php">
        <p class="submit"><input type="submit" name="commit" value="Logout"></p>
      </form>
    </div>
  </section>
';}
?>