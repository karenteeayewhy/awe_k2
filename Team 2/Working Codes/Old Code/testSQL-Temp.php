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
$con=mysqli_connect("localhost","","","");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 

//$result = mysqli_query($con,"SELECT cid, company_name, JoinedDate, Latest_Contribution_date, TotalGivingAmount  FROM `CC_CompanyInfo` WHERE uid=901");

//Execute the SQL if type is a Business
if($type=='biz')
{
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
	mysqli_close($con);
}  
?>
</p>
