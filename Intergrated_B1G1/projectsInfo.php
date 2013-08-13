<?php
require("dataBaseInfo2.php");

header("Content-type: text/javascript");

$conn = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
 @mysql_select_db($database) or
   die("could not select database: " . mysql_error());
 
 //projects lat long
$query = "select proj_latlong.projid, proj_latlong.lat, proj_latlong.long from proj_latlong
where projid in (
select projID from project
where project_live =1 and project_approved = 1 and project_delete = 0)";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(	   
	      'projid' => $row['projid'],			  
          'Plat' => $row['lat'],
          'Plong' => $row['long']
       );
    }
    echo json_encode($results);

mysql_close($conn);
?>