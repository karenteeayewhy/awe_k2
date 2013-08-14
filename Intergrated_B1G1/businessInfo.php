<?php
require("dataBaseInfo2.php");

header("Content-type: text/javascript");

$conn = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
 @mysql_select_db($database) or
   die("could not select database: " . mysql_error());
 
 //business lat long
$query = "select profile_values.uid, profile_values.value cid, btg_latlong.lat, btg_latlong.long from profile_values
inner join users_roles
on profile_values.uid = users_roles.uid
inner join btg_latlong
on btg_latlong.cid = profile_values.value
inner join users
on profile_values.uid = users.uid
where fid=1 and value <> 0 and 
rid in (6,9,13,14,15) and status = 1";

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

mysql_close($conn);
?>