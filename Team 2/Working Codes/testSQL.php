<html>
<head><title>Test SQL</title></head>
<body>
<style type="text/css">
<!--
.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
}

body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
}

img.border {
			display: block;
			padding:8px;
			border:solid;
			border-color: #dddddd #aaaaaa #aaaaaa #dddddd;
			border-width: 1px 2px 2px 1px;
			background-color:white;
		}
-->
</style>
<br /><p><span class="style1">Company Information</span></p>


<?php



$id=$_GET["id"];
$type=$_GET["type"];



// Create connection to the b1g1 database
//$con=mysql_connect("localhost","fareslay","97697932",true) or 
$con=mysqli_connect("localhost","fareslay","97697932","fareslay_b1g1");
//$conn = mysql_connect("localhost","buy1give1free","MYsql.is.magic!8158",true) or
         
//    die("Could not connect: " . mysql_error());
	
//change to your database name
//	@mysql_select_db("fareslay_b1g1") or
//		 die("counld not select database: " . mysql_error());

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 
  
include "DGILGI_Manager.php";

//Execute the SQL if type is a Business
if($type=='biz')
{
	
	// [DATA EXTRACT] Extracting the first round of Data
	
		$result = mysqli_query($con,"SELECT cid, CC_CompanyInfo.uid, company_name, JoinedDate, Latest_Contribution_date, 
		TotalGivingAmount, profile_values.fid, profile_values.value AS logoURL FROM `CC_CompanyInfo` INNER JOIN profile_values ON 
		CC_CompanyInfo.uid=profile_values.uid WHERE CC_CompanyInfo.uid=" . $id . " AND profile_values.fid=59");


		// Writing it out into a table.
		echo "<table border='0' a>";

		while($row = mysqli_fetch_array($result))
		  {
		  echo "<tr><td align=left rowspan=\"4\"><img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/company/" . $row['logoURL'] . "\"></td>";
		  echo "<td align=right>Company Name : </td><td>" . $row['company_name'] . "</td></tr>";
		  echo "<tr><td align=right>Joined Date : </td><td>" . $row['JoinedDate'] . "</td></tr>";
		  echo "<tr><td align=right>Latest Contribution Date : </td><td>" . $row['Latest_Contribution_date'] . "</td></tr>";
		  echo "<tr><td valign=top align=right>Total Giving Amount : </td><td valign=top>" . $row['TotalGivingAmount'] . "</td></tr>";
		  }
		echo "</table>";
		// echo "<a href=\"#\" onclick=\"window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;\"><br><img src=\"FB.png\" width=\"109\" height=\"25\"></a> <a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"en\"><img src=\"TW.png\" width=\"109\" heigt\"25\"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}";
	
	
	//  [DATA EXTRACT] Extracting the second round of Data
		$result = mysqli_query($con,"SELECT p.project_phrase_active, c.noofbeneficiaries AS amt, DATE_FORMAT( FROM_UNIXTIME( c.contribution_paid_tob1g1 ) ,  '%D %M %Y' ) AS last_giving_date
									FROM project p
									INNER JOIN contribution c ON p.projID = c.project_ID
									WHERE c.contributer_ID = " . $id . "
									AND contribution_status <>  'unsuccessful'
									AND contribution_status <>  'unconfirmed'
									AND contribution_status <>  'cancelled'
									ORDER BY c.contributionID DESC 
									LIMIT 1");

	

		// Writing it out into a table.
		while($row = mysqli_fetch_array($result)){
			echo "<br/>";
			echo "Last Giving Date : ".$row['last_giving_date']."<Br/>";
			echo "<Br/>Latest Activity : ".$row['amt']." ".$row['project_phrase_active'].".";
		}
		
	//  [DATA EXTRACT] Extracting the third round of Data
		$result = mysqli_query($con,"SELECT SUM( c.noofbeneficiaries ) AS dgi
									FROM contribution c
									WHERE contribution_status <>  'unsuccessful'
									AND contribution_status <>  'unconfirmed'
									AND contribution_status <>  'cancelled'
									AND contributer_id =" . $id);

		// Writing it out into a table.
		while($row = mysqli_fetch_array($result)){
			echo "<Br/>";
			echo "<Br/>Direct Giving Impact : ".$row['dgi']." beneficiaries impacted.";
			echo "<Br/>";
		}
		
		
mysqli_close($con);
}  
?>
</p>
</body>
</html>
