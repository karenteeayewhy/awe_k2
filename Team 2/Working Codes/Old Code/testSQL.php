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
//$con=mysqli_connect("localhost","fareslay","","fareslay_b1g1");
//$con=mysqli_connect("localhost","buy1give1","20psDQGH","buy1give1free_new");
$conn = mysql_connect("localhost","buy1give1free","MYsql.is.magic!8158",true) or
         
    die("Could not connect: " . mysql_error());
	
	//change to your database name
	@mysql_select_db("buy1give1free_new") or
		 die("counld not select database: " . mysql_error());

// Check connection
include "DGILGI_Manager.php";
//$result = mysqli_query($con,"SELECT cid, company_name, JoinedDate, Latest_Contribution_date, TotalGivingAmount  FROM `CC_CompanyInfo` WHERE uid=901");

//Execute the SQL if type is a Business
if($type=='biz')
{
	
	$result = mysql_query($conn,"SELECT cid, CC_CompanyInfo.uid, company_name, JoinedDate, Latest_Contribution_date, 
	TotalGivingAmount, profile_values.fid, profile_values.value AS logoURL FROM `CC_CompanyInfo` INNER JOIN profile_values ON 
	CC_CompanyInfo.uid=profile_values.uid WHERE CC_CompanyInfo.uid=" . $id . " AND profile_values.fid=59");



	// Writing it out into a table.
	echo "<table border='0' a>";

	while($row = mysql_fetch_array($result))
	  {
	  echo "<tr><td align=left rowspan=\"4\"><img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/company/" . $row['logoURL'] . "\"></td>";
	  echo "<td align=right>Company Name : </td><td>" . $row['company_name'] . "</td></tr>";
	  echo "<tr><td align=right>Joined Date : </td><td>" . $row['JoinedDate'] . "</td></tr>";
	  echo "<tr><td align=right>Latest Contribution Date : </td><td>" . $row['Latest_Contribution_date'] . "</td></tr>";
	  echo "<tr><td valign=top align=right>Total Giving Amount : </td><td valign=top>" . $row['TotalGivingAmount'] . "</td></tr>";
	  }
	echo "</table>";
	// echo "<a href=\"#\" onclick=\"window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;\"><br><img src=\"FB.png\" width=\"109\" height=\"25\"></a> <a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"en\"><img src=\"TW.png\" width=\"109\" heigt\"25\"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}";
	
	// Creating the DGI LGI Object
	$dgilgi_manager = new DGILGI_Manager($id);
    $dgi_summary_string = $dgilgi_manager->get_lgi_or_dgi_summary_string($dgilgi_manager->dgi_summary_arr, $dgilgi_manager->dgi_growth_rate_arr, $dgilgi_manager->dgi_monthly_avg_arr);
    $lgi_summary_string =  $dgilgi_manager->get_lgi_or_dgi_summary_string($dgilgi_manager->lgi_summary_arr, $dgilgi_manager->lgi_growth_rate_arr,  $dgilgi_manager->lgi_monthly_avg_arr);
//     $view_more_links = array(
//             0 => '<br/><a href="?q=dgi_lgi/view_all_causes&target_id=' . $data->cid . '&c_name=' . $data->c_name . '" style="font-weight:normal">View more >></a>',
//             1 => '<a href="?q=dgi_lgi/view_all_dg&target_id=' . $data->cid . '&c_name=' . $data->c_name . '" style="font-weight:normal">View more >></a>',
//             2 => '<a href="?q=dgi_lgi/view_all_lg&target_id=' . $data->cid . '&c_name=' . $data->c_name . '" style="font-weight:normal">View more >></a>',
//     );

	// Testing Publishing
	$supported_causes = $dgilgi_manager->get_supported_causes_string();
    $html .= '<table class="listing">';
    $html .= "<tr><td colspan='2' style='padding-top:0.5ex; border-bottom:1px solid #232323;'><font color='#666666' size='3.1em'>Giving activities:</font></td></tr>";
    $html .= "<tr valign='top'><td style='color:#999999;font-weight:normal;'> Supported causes:</td><td style='color:#666666;font-weight:normal;'>" . $supported_causes . ((strcmp($supported_causes, '-') != 0) ? $view_more_links[0] : '')  . "</td></tr>";
    $html .= "<tr><td style='color:#999999;font-weight:normal;'> Last giving activity:</td><td style='color:#666666;font-weight:normal;'>" . $dgilgi_manager->get_last_activity_string() . "</td></tr>";
    $html .= "<tr><td style='color:#999999;font-weight:normal;'> Direct giving impact:</td><td style='color:#666666;font-weight:normal;'>" . $dgilgi_manager->get_dgi_string() . " <font style='color:#666666;'>micro-giving impacts</font></td></tr>";
    $html .= "<tr><td style='color:#999999;font-weight:normal;'> Leveraged giving impact:</td><td style='color:#666666;font-weight:normal;'>" . $dgilgi_manager->get_lgi_string() . " <font style='color:#666666;'>micro-giving impacts</font></td></tr>";
	
    $html .= "<tr><td style='color:#999999;font-weight:normal;'> Leadership:</td><td style='color:#666666;font-weight:normal;'>Inspired <font style='color:#666666;'>" . get_total_num_of_companies_string($uid,0) . "</font> others to give</td></tr><tr><td>&nbsp;</td></tr>";
	//$dgilgi_manager->get_num_of_companies_string()
    $html .= "</table>";

    $html .= "<table bgcolor='#F2F2F2'>";
    $html .= "<tr>";
    $html .= "<td colspan='2'><h5 style='color:#232323'>&nbsp;Direct Giving Impact Summary (DGI):</h5></td>";
    $html .= "<td><h5 style='color:#232323 '>Monthly Average:</h5></td>";
    $html .= "</tr>";
    $html .= $dgi_summary_string['toString'];
    $html .= (!$dgi_summary_string['isEmpty']) ? "<tr><td colspan='3' align='right'>" . $view_more_links[1] . "&nbsp;&nbsp;&nbsp;</td></tr>" : "";
    $html .= "</table>";

	mysql_close($conn);
}  
?>
</p>
