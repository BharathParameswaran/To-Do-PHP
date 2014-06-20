<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>ToodLedo|Contact</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div class="header-wrap">
		<?php $current_page = "contact"; include 'header.php';?>
	</div>
	<section>

		<p class="content_header_contact" > Get in Touch </p>

		<div class="contact_content">
			<h3 class="contact1">Like us on Facebook or Pop in and say HI!</h3>
			<p class = "location">Location</p><p> NewTimes Developers, Palo Alto Santa Clara County, California </p>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:500px;width:600px;"><div id="gmap_canvas" style="height:500px;width:600px;"></div><a class="google-map-code" href="http://www.embed-google-map.com" id="get-map-data">http://www.embed-google-map.com</a> <a class="google-map-data" href="http://www.addlikebutton.net" id="get-map-data">http://www.addlikebutton.net</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(40.7143528,-74.0059731),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(40.7143528, -74.0059731)});infowindow = new google.maps.InfoWindow({content:"<div style='position:relative;line-height:1.34;overflow:hidden;white-space:nowrap;display:block;'><div style='margin-bottom:2px;font-weight:500;'>ToodLedo</div><span>Nus School of Computing <br> 118424 Singapore</span></div>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
			<p class = "location"> Contact</p><p>aish@newtimsdev.com</br> +65 8655 4633 </p>

		</div>

	</section>
</body>
<?php include 'footer.php';?>
</html>



