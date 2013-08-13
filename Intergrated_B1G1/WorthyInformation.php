<html>
	<head>
		<title>Worthy Information</title>
		<link rel="stylesheet" type="text/css" href="StyleSheets/DisplayInformationStyle.css">
	</head>
<body>
<br />
	<p><span class="style1">Worthy Information</span></p>

<?php

require("dataBaseInfo.php");
 
$id=$_GET["id"];
$type=$_GET["type"];
  
 $con = mysql_connect("localhost",$username,$password,true) or
         die("Could not connect: " . mysql_error());
 //change to your database name
@mysql_select_db($database) or
   die("could not select database: " . mysql_error());

//Execute the SQL if type is a projects
if($type=='worthy')
{
	
	// [DATA EXTRACT] Extracting the Data
		$result = mysql_query("select logo_url, key_org_name, org_type, org_countries_reg1, org_countries_reg2, org_countries_reg3, org_tax_benefits, org_phone, org_website, org_full_time, org_volunteers, org_year_founded, fin_audited from wcnew
inner join users_roles on wcnew.uid = users_roles.uid
inner join users on wcnew.uid = users.uid
where rid = 5 and status = 1 and wcid = ". $id ."");
		
if(mysql_num_rows($result)==0) {
	
	echo "<b>Error : Four Oh Four</b><br/>";	
	echo "<b>The Worthy Cause information for this item is currently being updated. Sorry for any inconvenience caused.</b>";	
} else {
		
		// Writing it out into a table.

		while($row = mysql_fetch_array($result))
		  {
		  if($row['logo_url']==null) {	
			echo "&nbsp;";
		} else{
			echo "<img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/WC/" . $row['logo_url'] . "\"alt='Four Oh Four'\">";
		}
		
		if($row['key_org_name']==null) {	
			echo "&nbsp;";
		} else{
			echo "<Br/>Key Organization Name :" . $row['key_org_name'] . "";
		}
		
		if($row['org_type']==null) {	
			echo "&nbsp;";
		} else{
			echo "<Br/>Organization Type :" . $row['org_type'] . "";
		}
		
		if($row['org_phone']==null) {	
			echo "&nbsp;";
		} else{
			echo "<Br/>Organization Phone :" . $row['org_phone'] . "";
		}
		
		if($row['org_website']==null) {	
			echo "&nbsp;";
		} else{
			echo "<Br/>Organization Website:". $row['org_website'] . "";
		}
	
		//  echo "<tr><td align=left rowspan=\"4\"><img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/WC/" . $row['logo_url'] . "\"></td>";
		//  echo "<td align=right>Key Organization Name :</td><td>" . $row['key_org_name'] . "</td></tr>";
		//  echo "<tr><td align=right>Organization Type :</td><td>" . $row['org_type'] . "</td></tr>";
		//  echo "<tr><td align=right>Organization Phone :</td><td>" . $row['org_phone'] . "</td></tr>";
		//  echo "<tr><td valign=top align=right>Organization Website:</td><td valign=top>" . $row['org_website'] . "</td></tr>";
		  }
		
		// echo "<a href=\"#\" onclick=\"window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;\"><br><img src=\"FB.png\" width=\"109\" height=\"25\"></a> <a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"en\"><img src=\"TW.png\" width=\"109\" heigt\"25\"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}";
	
	//  [DATA EXTRACT] Extracting the worthy Data 
		$result6 = mysql_query("select logo_url, key_org_name, org_type, org_countries_reg1, org_countries_reg2, org_countries_reg3, org_tax_benefits, org_phone, org_website, org_full_time, org_volunteers, org_year_founded, fin_audited from wcnew
inner join users_roles on wcnew.uid = users_roles.uid
inner join users on wcnew.uid = users.uid
where rid = 5 and status = 1 and wcid = ". $id ."");
	
		// Writing it out
		if(mysql_num_rows($result6)==0) {
		} 
		else {
			while($row = mysql_fetch_array($result6)){
				
				if($row['org_tax_benefits']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Tax Benefits : ".$row['org_tax_benefits']."<Br/>";	
				}
				if($row['org_countries_reg1']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Countries 1 : ".$row['org_countries_reg1']."<Br/>";
				}
				
				if($row['org_countries_reg2']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Countries 2 : ".$row['org_countries_reg2']."<Br/>";	
				}
				
				if($row['org_countries_reg3']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Countries 3 : ".$row['org_countries_reg3']."<Br/>";
				}
				
				if($row['org_full_time']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Full Time : ".$row['org_full_time']."<Br/>";	
				}		

				if($row['org_volunteers']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Volunteers : ".$row['org_volunteers']."<Br/>";	
				}

				if($row['org_year_founded']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Organization Year Founded : ".$row['org_year_founded']."<Br/>";	
				}	
				
				if($row['fin_audited']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Audited : ".$row['fin_audited']."<Br/>";	
				}				
			}
		}
		
mysql_close($con);
	  }
	 }  
?>
	</body>
</html>