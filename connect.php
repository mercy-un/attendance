<?php date_default_timezone_set("Africa/Lagos");
$date=date("d M Y, h:ia");
$cleardb_db = substr($cleardb_url["path"],1);
$con = mysqli_connect("//b3d3c7f1a9ca6a:1018c88b@us-cdbr-east-04.cleardb.com/heroku_cd88e6887f5cf7b?reconnect=true","b3d3c7f1a9ca6a","1018c88b","cleardb_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

