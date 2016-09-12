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
$z="";
$c1=$_REQUEST['c1'];
for($i=1;$i<12;$i++)
{
  $val="q".$i;
  if(isset($_REQUEST[$val]))
  {
    if($z=="")
      $z="game".$i."=1";
    else
      $z=$z." or game".$i."=1";
  }
}
if($_REQUEST['c']!=0)
$sql="select userid from interests where $z";
else
$sql="select userid from interests";
$flag=0;
echo "<div class='panel-heading'><h3>Search results</h3></div>";
echo "<table style='width:80%;margin-top:20px'>";
$query=mysqli_query($conn,$sql);
while($arr=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
  if($uname!=$arr['userid'])
  {
    $info_query=mysqli_query($conn,"select * from info where uname='$arr[userid]'");
    $info_array=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
    if($c1!=0)
    {for($i=2;$i<=17;$i++)
    {
      $val="h".$i;
      if(isset($_REQUEST[$val]))
      {
        if($_REQUEST[$val]==$info_array['block'])
        {
          $hostel_query=mysqli_query($conn,"select name from hostels where id='$_REQUEST[$val]'");
          $hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);
          if($flag%4==0)
            echo "<tr>";
          echo" <td style='margin-top:10px'><center><a href='view_profiles.php?search_id=$arr[userid]'><img src=\"images\\$info_array[image]\" style='width:100px;height:100px;border-radius:5px'><h5>$info_array[fname]&nbsp$info_array[lname]</h5></a>";
          if($info_array['room']!=0)
            echo"$hostel_array[name]&nbsp$info_array[room]";
          echo "<br><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#reqModal' onclick='show(\"$info_array[uname]\",\"$info_array[fname]\")'>Game Request</button></center></td>";
          if($flag%4==3)
            echo "</tr><br>";
          $flag=$flag+1;
      
        }
      }}}
      else
      {
        $hostel_query=mysqli_query($conn,"select name from hostels where id='$info_array[block]'");
          $hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);
        if($flag%4==0)
            echo "<tr>";
          echo"<td style='margin-top:10px'><center><a href='view_profiles.php?search_id=$arr[userid]'><img src=\"images\\$info_array[image]\" style='width:100px;height:100px;border-radius:5px'><h5>$info_array[fname]&nbsp$info_array[lname]</h5></a>";
          if($info_array['room']!=0)
            echo"$hostel_array[name]&nbsp$info_array[room]";
          echo "<br><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#reqModal' onclick='show(\"$info_array[uname]\",\"$info_array[fname]\")'>Game Request</button></center></td>";
          if($flag%4==3)
            echo "</tr><br>";
          $flag=$flag+1;
      }
    }
  }
  /*if($flag==3)
    break;*/
//}

?>