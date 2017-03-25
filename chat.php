
<?php
 //<meta http-equiv="refresh" content="20" />
echo "<link rel='stylesheet' type='text/css' href='css/$_COOKIE[Theme].css'>";
?>
<?php
echo "<div id='sidbar'>";
include_once 'PHP/db.php';

?>

<div id="result"></div>

<script>
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("chat_upd.php");
    source.onmessage = function(event) {
        document.getElementById("result").innerHTML = event.data ;
    };
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>