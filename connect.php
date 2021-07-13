<?php date_default_timezone_set("Africa/Lagos");
$date=date("d M Y, h:ia");
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection was successfully established!";
/*$con = mysqli_connect("kfgk8u2ogtoylkq9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com","iinnyuxdwgusikfv:j4u57gdety96mp1i","j4u57gdety96mp1i","jawsdb-rugged-85760");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

