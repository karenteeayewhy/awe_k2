<!DOCTYPE html >
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>B1G1 World - New Version - Changing the World !</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsAYjYn6pcqjwGrdneXsdaOjaas2aIutI&sensor=false"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
	<script type="text/javascript">
    //<![CDATA[
	
	   //declares variables
       var map;
	   var poly;
	   var business = 'Icon/Map Icon - Business.png';
	   var project = 'Icon/Map Icon - Project.png';
	   var worthy = 'Icon/Map Icon - Worthy Cause.png'; 
	   
    function load() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(3.046890, 101.582359),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
	  
 //  var polyOptions = {
   //strokeColor: '#FF0000',
 //  strokeColor: get_random_color(),
 //  strokeOpacity: 1.0,
 //  strokeWeight: 3
//   }
   
 //  poly = new google.maps.Polyline(polyOptions);
 //  poly.setMap(map);
	
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
						
						//Execute SQL
						//var results = SendInfo("119");
						//SendInfo("119");
						
						bizLatLong = new google.maps.LatLng(val.Blat,  val.Blong);
						
			            alert(val.uid);
						
						$.getJSON('business_ProjectsInfo.php?id='+val.uid, function(data) {
                        /* data will hold the php array as a javascript object */
						
                        $.each(data, function(key, val) {
						
						latLng = new google.maps.LatLng(val.BPlat,  val.BPlong); 
					
					 // var path = poly.getPath();	
			    	// path.push(bizLatLong);
			     	// path.push(latLng);
					
						poly = new google.maps.Polyline({
						strokeColor: get_random_color(),
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  
						var path = poly.getPath();
						path.push(bizLatLong);
						path.push(latLng);
						poly.setMap(map);
						
					   // Creating a marker and putting it on the map
						var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						icon:project
					});
					
					//alert(val.projID);
						}); //for each 2
						
						}); //get JSON 2
						
						//document.getElementById('map').innerHTML = results;
					
							  // var path = poly.getPath();
    
							// Because path is an MVCArray, we can simply append a new coordinate
							// and it will automatically appear
							  //  path.push(event.latLng);

							// Add a new marker at the new plotted point on the polyline.
							//var marker = new google.maps.Marker({
							//position: event.latLng,
							//map: map
						   //});
							} // return function 
							path.clear();
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
						//Execute SQL
						//var results = SendInfo("119");
						//SendInfo("119");
						
						bizLatLong = new google.maps.LatLng(val.Blat,  val.Blong);
						
			            alert(val.uid);
						
						$.getJSON('business_ProjectsInfo.php?id='+val.uid, function(data) {
                        /* data will hold the php array as a javascript object */
						
                        $.each(data, function(key, val) {
						
						latLng = new google.maps.LatLng(val.BPlat,  val.BPlong); 
					
					 //   var path = poly.getPath();
					//	path.push(bizLatLong);
					//	path.push(latLng);
						
						poly = new google.maps.Polyline({
						strokeColor: get_random_color(),
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  
						var path = poly.getPath();
						path.push(bizLatLong);
						path.push(latLng);
						poly.setMap(map);
						
					   // Creating a marker and putting it on the map
						var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						icon:project
					});
					
						//path.clear();
					//alert(val.projID);
						}); //for each 2
						
						}); //get JSON 2
						
						//document.getElementById('map').innerHTML = results;
					
							  // var path = poly.getPath();
    
							// Because path is an MVCArray, we can simply append a new coordinate
							// and it will automatically appear
							  //  path.push(event.latLng);

							// Add a new marker at the new plotted point on the polyline.
							//var marker = new google.maps.Marker({
							//position: event.latLng,
							//map: map
						   //});
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
						//Execute SQL
						//var results = SendInfo("119");
						//SendInfo("119");
						
						bizLatLong = new google.maps.LatLng(val.Blat,  val.Blong);
						
			            alert(val.uid);
						
						$.getJSON('business_ProjectsInfo.php?id='+val.uid, function(data) {
                        /* data will hold the php array as a javascript object */
						
                        $.each(data, function(key, val) {
						
						latLng = new google.maps.LatLng(val.BPlat,  val.BPlong); 
					
					   // var path = poly.getPath();
						// path.push(bizLatLong);
						// path.push(latLng);
						
						poly = new google.maps.Polyline({
						strokeColor: get_random_color(),
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  
						var path = poly.getPath();
						path.push(bizLatLong);
						path.push(latLng);
						poly.setMap(map);		
						
					   // Creating a marker and putting it on the map
						var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						icon:project
					});
					
						//path.clear();
					//alert(val.projID);
						}); //for each 2
						
						}); //get JSON 2
						
						//document.getElementById('map').innerHTML = results;
					
							  // var path = poly.getPath();
    
							// Because path is an MVCArray, we can simply append a new coordinate
							// and it will automatically appear
							  //  path.push(event.latLng);

							// Add a new marker at the new plotted point on the polyline.
							//var marker = new google.maps.Marker({
							//position: event.latLng,
							//map: map
						   //});
							} // return function 
							})	(marker));  
                        }); //for each
                }); //get JSON
        });	 //ready function	
        }  // load function
		
			//please work - sending info over
			function SendInfo(id) {
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
									document.getElementById("map").innerHTML=xmlhttp.responseText;
								}
							}
								xmlhttp.open("GET","phpsqlajax_genxml2_Copy_Copy.php?id="+id,true);
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
    //]]>

  </script>
  </head>
  <body onload="load()">
    <div id="map" style="width: 1000px; height: 600px"></div>
  </body>
</html>