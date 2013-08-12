<?php
require("phpsqlajax_dbinfo.php");

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
$query = "select * from btg_latlong
where cid in (select value from profile_values
where uid in (select profile_values.uid from profile_values
inner join users_roles
on profile_values.uid = users_roles.uid
where fid=1 and value <> 0 and 
rid in (6,9,13,14,15))
and fid = 1)";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(
          'cid' => $row['cid'],
          'lat' => $row['lat'],
          'long' => $row['long']
       );
    }
    echo json_encode($results);

?>