<?php
session_start();
ob_start();
?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">  
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("button").click(function(){
        $.post("PHP/point.php",
        {
          name: "STR",
        },
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});
</script>
<?php

include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);



?>
<button>Send an HTTP POST request to a page and get the result back</button>


<div id="result"></div>



<?php


if(isset($_POST['submit'])){
echo "HELLO";
}




?>