<?php
require("dataBaseInfo.php");

header("Content-type: text/javascript");

$id = $_GET["id"];

$conn = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
 @mysql_select_db($database) or
   die("could not select database: " . mysql_error());
 
 //Projects_business lat long
$query = "select profile_values.uid, profile_values.value cid, btg_latlong.lat, btg_latlong.long
from contribution
inner join users_roles
on contribution.contributer_id = users_roles.uid
inner join profile_values
on contribution.contributer_id = profile_values.uid
inner join btg_latlong
on btg_latlong.cid = profile_values.value
inner join users
on profile_values.uid = users.uid
where rid in (6,9,13,14,15) and project_id=".$id." and fid = 1 and status = 1
group by contributer_id";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(	   
          'PBuid' => $row['uid'],	
		  'PBcid' => $row['cid'],		  
          'PBlat' => $row['lat'],
          'PBlong' => $row['long']
       );
    }
    echo json_encode($results);
	
mysql_close($conn);
?>