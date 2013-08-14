<html>
	<head>
		<title>Projects Information</title>
		<link rel="stylesheet" type="text/css" href="StyleSheets/DisplayInformationStyle.css">
	</head>
<body>
<br />
	<p><span class="style1">Projects Information</span></p>

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
if($type=='proj')
{
	
	// [DATA EXTRACT] Extracting the Data
		$result = mysql_query("select pic1URL, proj_title, proj_story, proj_country, proj_catid_1, proj_catid_2, proj_beneficiary_id_1, proj_beneficiary_id_2 from project
where project_live =1 and project_approved = 1 and project_delete = 0 and projid = ". $id ."");
		
if(mysql_num_rows($result)==0) {
	
		echo "<b>Error : Four Oh Four</b><br/>";	
		echo "<b>The Project information for this item is currently being updated. Sorry for any inconvenience caused.</b>";
} else {
		
		// Writing it out into a table.

		while($row = mysql_fetch_array($result))
		  {
		  
		  if($row['pic1URL']==null){
			echo "&nbsp;";
		  }	
			 else {			
				echo "<img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/project/" . $row['pic1URL'] . "\"alt='Four Oh Four'\">";
		  }
		
			echo "&nbsp;";
		  
		  if($row['proj_title']==null){
			echo "&nbsp;";
		  }		  
		  else {
			echo "<BR/>Project Title :" . $row['proj_title'] . "";
		  }
		  
		  if($row['proj_country']==null){
			echo "&nbsp;";
		  }		  
		  else {
			echo "<BR/>Project Country :" . $row['proj_country'] . "";
		  }
		  
			echo "&nbsp;";
		  
		 // echo "<tr><td align=left rowspan=\"4\"><img class=\"border\" src=\"https://www.b1g1.com/buy1give1/sites/default/files/project/" . $row['pic1URL'] . "\"></td>";
		 // echo "<td align=right>&nbsp;</td><td>&nbsp;</td></tr>";
		// echo "<tr><td align=right>Project Title :</td><td>" . $row['proj_title'] . "</td></tr>";
		//  echo "<tr><td align=right>Project Country :</td><td>" . $row['proj_country'] . "</td></tr>";
		//  echo "<tr><td valign=top align=right>&nbsp;</td><td valign=top>&nbsp;</td></tr>";
		  }

		// echo "<a href=\"#\" onclick=\"window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;\"><br><img src=\"FB.png\" width=\"109\" height=\"25\"></a> <a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"en\"><img src=\"TW.png\" width=\"109\" heigt\"25\"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}";
	
	//  [DATA EXTRACT] Extracting the projects Data 
		$result6 = mysql_query("select pic1URL, proj_title, proj_story, proj_country, proj_catid_1, proj_catid_2, proj_beneficiary_id_1, proj_beneficiary_id_2 from project
where project_live =1 and project_approved = 1 and project_delete = 0 and projid = ". $id ."");
	
		// Writing it out
		if(mysql_num_rows($result6)==0) {
		} 
		else {
			while($row = mysql_fetch_array($result6)){
				
				if($row['proj_story']==null) {
					
				} 
				else {
					echo "<Br/>";
					echo "<BR/>Story : ".$row['proj_story']."<Br/>";	
				}
				
				if($row['proj_catid_1']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Category 1 : ".$row['proj_catid_1']."<Br/>";
				}
				
				if($row['proj_catid_2']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Category 2 : ".$row['proj_catid_2']."<Br/>";	
				}
				
				if($row['proj_beneficiary_id_1']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Beneficiary 1 : ".$row['proj_beneficiary_id_1']."<Br/>";
				}
				
				if($row['proj_beneficiary_id_2']==null) {
					
				}
				else {
					echo "<Br/>";
					echo "Beneficiary 2 : ".$row['proj_beneficiary_id_2']."<Br/>";	
				}				
			}
		}
		
mysql_close($con);
	  }
	 }  
?>
	</body>
</html>