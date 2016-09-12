<?php
/*$conn=mysqli_connect("mysql8.000webhost.com","a5248758_gamedev","gamedb1","a5248758_game");
if(!$conn)
  die(mysqli_error($conn));
if(!mysqli_select_db($conn,"a5248758_game"))
  die(mysqli_error($conn));*/
  $conn=mysqli_connect("localhost","root","","game");
if(!$conn)
  die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
  die(mysqli_error($conn));

$hint='';
$q=$_REQUEST['q'];
$len=strlen($q);
if($q!="")
{
  $query=mysqli_query($conn,"select uname,fname,lname,image from info");
  while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
  {
    if(stristr($q, substr($row['fname'], 0,$len)) || stristr($q, substr($row['lname'], 0,$len)) || stristr($q, substr($row['uname'], 0,$len)))
    {
      if($hint=='')
      {
        $hint="<div class='livetext'><img src='images/".$row['image']."'width='50' height='50'/><a href=view_profiles.php?search_id=$row[uname] id='live$row[uname]' onmouseover='shade(this.id)' onmouseout='unshade(this.id)'>".$row['fname']."&nbsp".$row['lname']."</a></div>";
        $hint.="<hr><div class='livetext'><a href=\"search.php?search=$q\">Show all search results</a></div>";
        }

      else
        $hint.="<hr>"."<div class='livetext'><img src='images/".$row['image']."'width='50' height='50'/><a href=view_profiles.php?search_id=$row[uname] id='live$row[uname]' onmouseover='shade(this.id)' onmouseout='unshade(this.id)'>".$row['fname']."&nbsp".$row['lname']."</a></div>";
    }
  }
}
echo $hint === "" ? "no suggestion" : $hint;;
?>