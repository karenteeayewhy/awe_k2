<!DOCTYPE html>

<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>T2 App Test 2</title> 
  <style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif
}
-->
  </style>
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
</head> 
<body bgcolor=#CCCCCC>
<table width="100%" height="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="93" colspan="3" bgcolor="#232323"><img src="logo.png" width="320" height="88"></td>
  </tr>
  <tr>
  <td width="1191" height="594" valign="top">
  <div id="map" style="width: 100%; height: 580px;">  </div></td><td width="12" valign="top"><br>
    </div>
  

<script type="text/javascript">
  
//Information to display when the markers are clicked. We are temporarility hardcoding the data.

 var displayCode1 = '<p class="style2"><img src="astala.png" width="100" height="39"><br><br>About Us : To provide online services that makes our client technologies operate easier and enhance their income through the Asalta online solutions.<br>  <br>Member Since : 26/04/2010<br>Last Giving : 02/04/2013<br>Industy : Web Development and IT Services<br>Supported Cases : World Youth International, Isha <br>Foundation , <a href="https://www.b1g1.com/buy1give1/businessstory?companyID=100119" target="_blank">View More &gt;&gt;</a><br><br>Last Giving Activity : Gave 40 Trees to nurture the environment.<br><br>Direct Giving Impact : 2,131 Beneficiaries impacted.<br><br>Leveraged Giving Impact : - Benefeciaries impacted.<br><br>Leadersip : Insipired 0 other to give<br><a href="#" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;"><br><img src="FB.png" width="109" height="25"></a> <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"><img src="TW.png" width="109" heigt"25"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}'; 

 var displayCode2 = '<p class="style2"><img src="https://www.b1g1.com/buy1give1/sites/default/files/company/btg-482-company_logo.png"><br><br>About Us : Share the Happiness : Green Syndrome applies B1G1 (Buy 1 Give 1) system for all the businesses.<br>  <br>Member Since : 22/12/2010<br>Last Giving : 03/08/2013<br>Industy : Online Shopping, Gifts<br>Supported Cases : Midday Meals, New Ways <a href="https://www.b1g1.com/buy1give1/businessstory?companyID=482" target="_blank">View More &gt;&gt;</a><br><br>Last Giving Activity : Gave 120 trees to nurture the environment.<br><br>Direct Giving Impact : 24,931 beneficiaries impacted. <br><br>Leveraged Giving Impact : 45,977 Benefeciaries impacted.<br><br>Leadersip : Insipired 3 other to give<br><a href="#" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;"><br><img src="FB.png" width="109" height="25"></a> <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"><img src="TW.png" width="109" heigt"25"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}'; 
 
 var displayCode3 = '<p class="style2"><img src="https://www.b1g1.com/buy1give1/sites/default/files/company/btg-780543-company_primary_image.png"><br><br>About Us : Balance Central’s mission is to share Rekindled Ancient Wisdom (RAW) with as many people as possible by providing a safe and comfortable environment for people to be heard and to become conscious of their thoughts and beliefs. With conscious awareness - self healing will occur.<br>  <br>Member Since : 28/04/2011<br>Last Giving : 04/08/2013<br>Industy : Health Services<br>Supported Cases : B1G1 Giving, Every Home Global Concern , <a href="https://www.b1g1.com/buy1give1/businessstory?companyID=780543" target="_blank">View More &gt;&gt;</a><br><br>Last Giving Activity : Gave 47,450 people access to clean water for a day.<br><br>Direct Giving Impact : 1,166,195 beneficiaries impacted. <br><br>Leveraged Giving Impact : - Benefeciaries impacted.<br><br>Leadersip : Insipired 0 other to give<br><a href="#" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href), \'facebook-share-dialog\', \'width=626,height=436\'); return false;"><br><img src="FB.png" width="109" height="25"></a> <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"><img src="TW.png" width="109" heigt"25"> </a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}'; 

//End of code

					//Function to query SQL
					function displayInfo(id,type)
					{
					if (window.XMLHttpRequest)
					  {// code for IE7+, Firefox, Chrome, Opera, Safari
					  xmlhttp=new XMLHttpRequest();
					  }
					else
					  {// code for IE6, IE5
					  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					xmlhttp.onreadystatechange=function()
					  {
					  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
						document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
						}
					  }
					xmlhttp.open("GET","testSQL.php?id="+id+"&type="+type,true);
					xmlhttp.send();
					}

//Locations to be mapped and inputting the codes. [4] is the ID , [5] is the type of marker
    var locations = [
      ['Astla Technology', -33.890542, 151.274856, 4, '560', 'biz'],
      ['Green Syndrome Inc', -33.923036, 151.259052, '560', 'biz'],
      ['Balance Central', -34.028249, 151.157507, 3, '901', 'biz'],
      ['Green Syndrome Inc', -33.80010128657071, 151.28747820854187, 2, '560', 'biz'],
      ['Balance Central', -33.950198, 151.259302, 1, '901', 'biz']
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
          
          //Execute SQL
		  var results = displayInfo(locations[i][4],locations[i][5]);
          document.getElementById('tempdiv').innerHTML = results;
		  
          //Display the Company Info on right.
		  //document.getElementById('tempdiv').innerHTML = locations[i][4];
		  
        }
      })(marker, i));
    }
  </script>
  </td>
  <td width="440" valign="top"><br>
    <div class="style2 style3" id="tempdiv"> Welcome to B1G1. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantm, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugie.<br>
        <br>
    Ed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora. <br>
        <br>
    Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugie.</div></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" bgcolor="#232323">&nbsp;</td>
  </tr>
</table>
</body>
</html>