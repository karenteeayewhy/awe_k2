<?php
require("dataBaseInfo.php");

header("Content-type: text/javascript");

// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost:3306", "dbadmin", "Wa92Me5P");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db("buy1give1free_new", $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

//$conn = mysql_connect("localhost",$username,$password,true) or
 //        die("Could not connect: " . mysql_error());
 //change to your database name
// @mysql_select_db($database) or
 //  die("counld not select database: " . mysql_error());
 
 //business lat long
$query = "select profile_values.uid, profile_values.value cid, btg_latlong.lat, btg_latlong.long from profile_values
inner join users_roles
on profile_values.uid = users_roles.uid
inner join btg_latlong
on btg_latlong.cid = profile_values.value
where fid=1 and value <> 0 and 
rid in (6,9,13,14,15)";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(	   
	      'uid' => $row['uid'],
          'cid' => $row['cid'],			  
          'Blat' => $row['lat'],
          'Blong' => $row['long']
       );
    }
    echo json_encode($results);

?>