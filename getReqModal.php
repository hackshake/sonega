<?php
session_start();
$uname=$_SESSION['id'];
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
  die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
  die(mysqli_error($conn));
if(!mysqli_select_db($conn,'game'))
  die(mysqli_error());
$req=$_GET['q'];
//$info_query=mysqli_query()
echo "<div id='imgModal' class='modal fade' role='dialog'>";
      echo "<div class='modal-dialog'>";
      //Modal content begins here
      echo "<div class='modal-content'>";
      echo "<div class='modal-header'>";
      echo "<button type='button' class='close' data-dismiss='modal'>&times</button>";
      echo "<h4 class='modal-title'>$row[0]&nbsp$row[1]</h4>";
      echo "</div>";
      echo "<div class='modal-body'>";
      echo "<img src='images/".$row[6]."'id='smalldp'/><br><br>";
      echo "<div id='headicon'>";
      echo "<a href='welcome_home.php'><img src='images/".$selfrow[6]."'id='smallicon'/>";
      echo "$selfrow[0]&nbsp$selfrow[1]</a><br>";
      echo "</div>";
      echo "<input type='text' class='form-control' placeholder='Enter comment here' id='comment'>";
      echo "<button type='submit' value='POST' class='btn btn-default'>POST</button>";
      echo "</div>";
      /*echo "<div class='modal-footer'>";
      echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
      echo "</div>";*/
      echo "</div>";
      echo "</div>";
      echo "</div>";
?>