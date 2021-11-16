<?php

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
.button {
  padding: 8px 25px;
  position: static;
  font-size: 18px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #72a2ac;
  border: none;
  border-radius: 15px;
  box-shadow: 0 6px #999;
}

.button:hover {background-color: #3d6c6f}

.button:active {
  box-shadow: 0 5px #666;
  transform: translateY(2px);
}

.table_container { padding: 10px 12px 0px 12px; width:100%  }
.table_container th { background-color:lightblue; color:white; font-weight:bold; border-left: 1px solid white;}
</style>
<body>
<div class="table_container"><table style="background-color:rgba(0, 0, 0, 0);" cellpadding=5 cellspacing=5>

<?php
foreach ($result as $row) {
	echo "<tr>	
	<td width=20%>
	<center>
	<img src='". $row->IMAGE_LOCATION ."' style='width: 200px; height: 200px';/>
	<a href=maid-profile?ID=" . $row->ID . " class='button'>Maid Profile</a><br>
	</center></td>	
	<td width=30%><table style='background-color:rgba(0, 0, 0, 0); border: 0px solid #ccc;'>
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