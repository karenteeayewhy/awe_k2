<?php
require("dataBaseInfo.php");

header("Content-type: text/javascript");

$id = $_GET["id"];

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
 
 //Business_project lat long
$query = "select distinct contribution.project_id, proj_latlong.lat, proj_latlong.long from contribution
inner join project
on contribution.project_id = project.projid
inner join proj_latlong
on project.projid = proj_latlong.projid
where contributer_id = ".$id." 
and project_live =1 and project_approved = 1 and project_delete = 0";

$result = mysql_query($query);

    $results = array();
    while($row = mysql_fetch_assoc($result))
    {
       $results[] = array(	   
          'project_id' => $row['project_id'],			  
          'BPlat' => $row['lat'],
          'BPlong' => $row['long']
       );
    }
    echo json_encode($results);

?>