<?php
require("dataBaseInfo.php");

header("Content-type: text/javascript");

// Opens a connection to a MySQL server
//$connection=mysql_connect ("localhost:3306", "dbadmin", "Wa92Me5P");
//if (!$connection) {
//  die('Not connected : ' . mysql_error());
//}

// Set the active MySQL database
//$db_selected = mysql_select_db("buy1give1free_new", $connection);
//if (!$db_selected) {
//  die ('Can\'t use db : ' . mysql_error());
//}

$conn = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
 @mysql_select_db($database) or
   die("could not select database: " . mysql_error());
 
 //worthy causes lat long
$query = "select wcnew.uid, wcnew.wcid, wcnew_latlong.lat, wcnew_latlong.long from wcnew
inner join users_roles
on wcnew.uid = users_roles.uid
inner join wcnew_latlong
on wcnew_latlong.uid = wcnew.wcid
inner join users
on wcnew.uid = users.uid
where rid = 5 and status = 1";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(	   
	      'Wuid' => $row['uid'],
	      'Wcid' => $row['wcid'],			  
          'Wlat' => $row['lat'],
          'Wlong' => $row['long']
       );
    }
    echo json_encode($results);

mysql_close($conn);
?>