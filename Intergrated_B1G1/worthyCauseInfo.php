<?php
require("dataBaseInfo2.php");

header("Content-type: text/javascript");

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