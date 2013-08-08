<?php
require("phpsqlajax_dbinfo.php");

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost:3306", "dbadmin", "Wa92Me5P");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

//$conn = mysql_connect("localhost",$username,$password,true) or
 //        die("Could not connect: " . mysql_error());
 //change to your database name
// @mysql_select_db($database) or
 //  die("counld not select database: " . mysql_error());

// Select all the rows in the markers table
$query = "select * from btg_latlong
where cid in (select value from profile_values
where uid in (select profile_values.uid from profile_values
inner join users_roles
on profile_values.uid = users_roles.uid
where fid=1 and value <> 0 and 
rid in (6,9,13,14,15))
and fid = 1)";

$query1 = "select * from proj_latlong
where projid in (select project_id from contribution
where contributer_id in (
select distinct contributer_id from contribution
where project_id in (
select projid from project 
where project_live =1 and project_approved = 1)
and contribution_status <> 'unconfirmed'
and company_id = 119 and contributer_id in (SELECT uid from users_roles
where rid in (6,9,13,14,15))))";

$result = mysql_query($query);

$result1 = mysql_query($query1);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

echo "<?xml version='1.0' ?>";
header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  //echo '<marker ';
  //echo 'cid="' . parseToXML($row['cid']) . '" ';
  //echo 'address="' . parseToXML($row['address']) . '" ';
  //echo 'cid="' . $row['cid'] . '" ';
  //echo 'lat="' . $row['lat'] . '" ';
  //echo 'lng="' . $row['long'] . '" ';
  // echo 'type="' . $row['lat'] . '" ';
  //echo '/>';
  
  echo '<marker>';
 
  echo '<cid>' . $row['cid'];
  echo '</cid>';
  
  //echo $temp_cid = $row['cid'];
  
  echo '<lat>' . $row['lat'];
  echo '</lat>';
 
  echo '<lng>' . $row['long'];
  echo '</lng>';
 
  
 // echo '<projects>';
  
  //while ($row = @mysql_fetch_assoc($result1)){
  
 // echo '<project>';
  
 // echo '<projID>' . $row['projID'];
  
 // echo '<lat>' . $row['lat'];
 // echo '</lat>';
  
  //echo '<lng>' . $row['long'];
 // echo '</lng>';
  
 // echo '</projID>';
  
//  echo '</project>';
  
 // }
 // echo '</projects>';
  
  
  echo '</marker>';
}

// End XML file
echo '</markers>';

?>