<!DOCTYPE html >
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>B1G1 World - New Version - Changing the World !</title>
	<link rel="stylesheet" type="text/css" href="StyleSheets/MainPageStyle.css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsAYjYn6pcqjwGrdneXsdaOjaas2aIutI&sensor=false"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
	<script type="text/javascript">
    //<![CDATA[
	
	   //declares variables
       var map;
	   var poly = null;
	   var path;
	   var polylinelist = [];
	   var business = 'Images/Map Icon - Business.png';
	   var project = 'Images/Map Icon - Project.png';
	   var worthy = 'Images/Map Icon - Worthy Cause.png'; 
	   
    function load() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(1.361372, 103.822861),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
	  
  // var polyOptions = {
   //strokeColor: '#FF0000',
   //strokeColor: get_random_color(),
  // strokeOpacity: 1.0,
   //strokeWeight: 3
  // }
   
  // poly = new google.maps.Polyline(polyOptions);
  // poly.setMap(map);
	
  $(document).ready(function(){
                /* call the php that has the php array which is json_encoded */
								  
                //business information
				$.getJSON('businessInfo.php', function(data) {
                        /* data will hold the php array as a javascript object */
                        $.each(data, function(key, val) {
						
						latLng = new google.maps.LatLng(val.Blat,  val.Blong); 
					    
					   // Creating a marker and putting it on the map
						var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						icon:business
						});
						
						google.maps.event.addListener(marker, 'click', (function(){
						return function() {
						
						bizLatLong = new google.maps.LatLng(val.Blat,  val.Blong);
						
			            //alert(val.uid);
						
						$.getJSON('business_ProjectsInfo.php?id='+val.uid, function(data) {
                        /* data will hold the php array as a javascript object */
						
						//clear polyline
						clearLines();
                        
						$.each(data, function(key, val) {
						
						latLng = new google.maps.LatLng(val.BPlat,  val.BPlong); 
					
						poly = new google.maps.Polyline({
						strokeColor: get_random_color(),
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  
						path = poly.getPath();
						path.push(bizLatLong);
						path.push(latLng);
						poly.setMap(map);						
						
						//pushing the line to array
						polylinelist.push(poly);
						
					   // Creating a marker and putting it on the map
						var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						icon:project
					});
					
						}); //for each 2
						
						}); //get JSON 2
						
						//andrew function please work...
						//Execute SQL
						 //var results = displayInfo(val.uid,'biz');
						 //document.getElementById('tempdiv').innerHTML = results;
						 
						 displayInfo(val.uid,'biz');
						
							} // return function 
							})	(marker));  
                        }); //for each	
                }); //get JSON
				
			   //project information
				$.getJSON('projectsInfo.php', function(data) {
					/* data will hold the php array as a javascript object */
					$.each(data, function(key, val) {
					
					latLng = new google.maps.LatLng(val.Plat,  val.Plong); 
					
				   // Creating a marker and putting it on the map
					var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					icon:project
				});
				  
						google.maps.event.addListener(marker, 'click', (function(){
					return function() {
										
					projLatLong = new google.maps.LatLng(val.Plat,  val.Plong);
					
					//alert(val.projid);
					
					$.getJSON('projects_businessInfo.php?id='+val.projid, function(data) {
					/* data will hold the php array as a javascript object */
					
					//clear polyline
					clearLines();
					
					$.each(data, function(key, val) {
					
					latLng = new google.maps.LatLng(val.PBlat,  val.PBlong); 
				
					poly = new google.maps.Polyline({
					strokeColor: get_random_color(),
					strokeOpacity: 1.0,
					strokeWeight: 2
				  });
				  
					var path = poly.getPath();
					path.push(projLatLong);
					path.push(latLng);
					poly.setMap(map);
					
					//pushing the line to array
					polylinelist.push(poly);
					
				   // Creating a marker and putting it on the map
					var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					icon:business
				});
				
					}); //for each 2
					
					}); //get JSON 2
					
						//andrew function please work...
						//Execute SQL
						// var results = displayInfo1(val.projid,'proj');
						// document.getElementById('tempdiv').innerHTML = results;
						
						displayInfo1(val.projid,'proj');
					
						} // return function 
						})	(marker));  
					}); //for each
			}); //get JSON
			
				//worthy causes information
				$.getJSON('worthyCauseInfo.php', function(data) {
					/* data will hold the php array as a javascript object */
					$.each(data, function(key, val) {
					
					latLng = new google.maps.LatLng(val.Wlat,  val.Wlong); 
					
				   // Creating a marker and putting it on the map
					var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					icon:worthy
				});
				  
						google.maps.event.addListener(marker, 'click', (function(){
					return function() {
					
					worthyLatLong = new google.maps.LatLng(val.Wlat,  val.Wlong);
					
					//alert(val.Wcid);
					
					$.getJSON('worthy_projectsInfo.php?id='+val.Wcid, function(data) {
					/* data will hold the php array as a javascript object */
					
					//clear polyline
					clearLines();
						
					$.each(data, function(key, val) {
					
					latLng = new google.maps.LatLng(val.WPlat,  val.WPlong); 
				
					poly = new google.maps.Polyline({
					strokeColor: get_random_color(),
					strokeOpacity: 1.0,
					strokeWeight: 2
				  });
				  
					var path = poly.getPath();
					path.push(worthyLatLong);
					path.push(latLng);
					poly.setMap(map);	

					polylinelist.push(poly);					
					
				   // Creating a marker and putting it on the map
					var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					icon:project
				});
				
					}); //for each 2
					
					}); //get JSON 2
					
					    //andrew function please work...
						//Execute SQL
						// var results = displayInfo(val.uid,'biz');
						// document.getElementById('tempdiv').innerHTML = results;
						
						displayInfo2(val.Wcid,'worthy');
					
						} // return function 
						})	(marker));  
					}); //for each
			}); //get JSON
	});	 //ready function	
	}  // load function
		
			//please work - sending info over
			function displayInfo(id,type) {
				var xmlhttp;
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
								xmlhttp.open("GET","CompanyInformation.php?id="+id+"&type="+type,true);
								xmlhttp.send();	
			}
			
			//please work - sending info over
			function displayInfo1(id,type) {
				var xmlhttp;
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
									//document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
									document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
								}
							}
								xmlhttp.open("GET","ProjectsInfomation.php?id="+id+"&type="+type,true);
								xmlhttp.send();	
			}
			
			//please work - sending info over
			function displayInfo2(id,type) {
				var xmlhttp;
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
									//document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
									document.getElementById("tempdiv").innerHTML=xmlhttp.responseText;
								}
							}
								xmlhttp.open("GET","WorthyInformation.php?id="+id+"&type="+type,true);
								xmlhttp.send();	
			}
	
	  // set random color for polyline
	  function get_random_color() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.round(Math.random() * 15)];
		}
		return color;
	}
	
	// Clearing of polylines
	function clearLines()
	{ 
		for(var i=0; i<polylinelist.length; i++)
		{
			var line = polylinelist[i];
			line.setMap(null);
		}	
	}
    //]]>

  </script>
  </head>
  <body onload="load()">
	<table width="100%" height="600" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="93" colspan="3" class="style4"><img src="Images/logo.png" width="320" height="88"></td>
	  </tr>
	 <tr>
		<td width="1191" height="594" valign="top">
  <div id="map" style="width: 100%; height: 580px;">  </div></td><td width="12" valign="top"><br>
    </div>
		</td>
  <td width="440" valign="top"><br>
    <div class="style2 style3" id="tempdiv"> 
	Welcome to B1G1. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantm, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugie.<br>
        <br>
    Ed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora. <br>
        <br>
    Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugie.</div></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="style4">&nbsp;</td>
  </tr>
	</table>
</body>
</html>