<?php
	include ('dataBaseInfo.php');
	$conn = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
 @mysql_select_db($database) or
   die("could not select database: " . mysql_error());
	include 'DGILGI_Manager.php';
	$dgilgi_manager = new DGILGI_Manager(560); 
	$allLgiImpacts = $dgilgi_manager->get_lgi_string();
		
		echo 'Leveraged giving impact: '.number_format($allLgiImpacts).' beneficiaries impacted';
		echo '<br/>';
		echo 'Leadership: Inspired '.number_format(get_total_num_of_companies_string(560,0)).' others to give';
		
		
		
/// fuinction to count Leradership count
function get_total_num_of_companies_string($userId, $totalCnt) {
	global $totalCnt;
        $sql = "SELECT invitee FROM invite_relations i WHERE i.uid='".$userId."'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		$totalCnt = $totalCnt + $count;
		while($row = mysql_fetch_assoc($result)) {          
		  get_total_num_of_companies_string($row['invitee'],$totalCnt);
       }
	   
	   return $totalCnt;
	}
?>