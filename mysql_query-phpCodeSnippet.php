<?php
if (session_status() != PHP_SESSION_ACTIVE) {
session_start();
}

$protocol = ((!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

if (!isset($_SESSION['maids_page'])){
	$_SESSION['maids_page']=$CurPageURL;
}

global $wpdb;

$result = $wpdb->get_results( "SELECT ID, NAME, IMAGE_LOCATION, NATIONALITY, AVAILABILITY, DATE_AVAILABLE, CURRENT_RESIDENCE, REMARKS, REMARKS_HEADING FROM datatable");
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
body {font-family: Arial;}
</style>
<body>
<div class="table_container">
<table style="background-color:rgba(0, 0, 0, 0);" cellpadding=5 cellspacing=5>
<?php
foreach ($result as $row) {
	echo "<tr>	
	<td width=20%>
	<center>
	<img class='img_med' src='". $row->IMAGE_LOCATION ."';/>
	<a href=maid-profile?ID=" . $row->ID . " class='button'>Maid Profile</a><br>
	</center></td>	
	<td width=30%><table class='tablerec'>
	<tr><td style='font-weight:bold'>Name: " . $row->NAME . "</td></tr>
	<tr><td><b>Nationality:</b> " . $row->NATIONALITY . "</td></tr>
	<tr><td><b>Availability:</b> " . $row->AVAILABILITY . "</td></tr>
	<tr><td><b>Available Date:</b> " . $row->DATE_AVAILABLE . "</td></tr>
	<tr><td><b>Current Residence:</b> " . $row->CURRENT_RESIDENCE . "</td></tr>
	</table></td>
	
	<td align=left width=50%>
	<h4>" . $row->REMARKS_HEADING . "</h4><br>" . $row->REMARKS . "</td></tr>
	<tr><td style='border-bottom:1px solid #C0C0C0;padding:1px; width:100%' colspan=3>&nbsp;</td></tr>";
}
?>
</table></div>
</html>