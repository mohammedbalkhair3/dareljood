<?php

global $wpdb;
$ID= $_GET['ID']; 
$result = $wpdb->get_results( "SELECT * FROM datatable WHERE ID=$ID");

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
body {font-family: Arial;}

/* Back button */
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
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #72a2ac;
  color: white;
  padding: 16px 20px;
  font-size: 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* Full-width input fields */
.form-container textarea[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  font-size: 14px;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #555;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

@viewport{
	zoom: 1.0;
	width: extend-to-zoom;
}

@-ms-viewport{
	width: extend-to-zoom;
	zoom: 1.0;
}
</style>
<body>
<div class="table_container"><table style='background-color:rgba(0, 0, 0, 0); border: 1px solid #ccc; width:100%'>

<?php
$maid_name="";

foreach ($result as $row) {
	$maid_name=$row->NAME;
	$result_record="<tr>	
	<td style='font-weight:bold; border-right: 1px solid; padding: 15px; width:30%'><center>
	<img src='". get_home_url() . "/". $row->IMAGE_LOCATION ."' style='width: 300px; height: 300px';/>
	<br><br>". $row->NAME . "</center></td>
	<td align=left style='padding: 15px; width:30%'>
	<h4>" . $row->REMARKS_HEADING . "</h4><br>" . $row->REMARKS . "</td>
	<td align=left width=40%>
	<table style='background-color:rgba(0, 0, 0, 0); border: 0px solid #ccc;'>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>NATIONALITY:</b> " . $row->NATIONALITY . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>RELIGION:</b> " . $row->RELIGION . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>DATE OF BIRTH:</b> " . $row->DOB . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>AGE:</b> " . $row->AGE . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>ADDRESS:</b> " . $row->ADDRESS . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>MARITAL STATUS:</b> " . $row->MARITAL_STATUS . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>WEIGHT KG:</b> " . $row->WEIGHT_KG . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>HEIGHT CM:</b> " . $row->HEIGHT_CM . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>LANGUAGES:</b> " . $row->LANGUAGES . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>EDUCATIONAL LEVEL:</b> " . $row->EDUCATIONAL_LEVEL . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>WASHING:</b> " . $row->WASHING . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>CLEANING:</b> " . $row->CLEANING . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>BABY SITTING:</b> " . $row->BABY_SITTING . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>COOKING:</b> " . $row->COOKING . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>IRONING:</b> " . $row->IRONING . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>EXPERIENCES:</b> " . $row->EXPERIENCES . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>AVAILABILITY:</b> " . $row->AVAILABILITY . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>DATE AVAILABLE:</b> " . $row->DATE_AVAILABLE . "</td></tr>
	<tr><td STYLE='border-top: 1px solid;font-family: Arial, Helvetica, sans-serif;  font-size: 12px;'><b>CURRENT RESIDENCE:</b> " . $row->CURRENT_RESIDENCE . "</td></tr>
	</table></td>
	<tr><td style='border-bottom:1px solid #C0C0C0;padding:1px; width:100%' colspan=3>&nbsp;</td></tr>";
}
echo "$result_record<tr><td colspan=3>&nbsp;</td></tr>
<tr><td align=center colspan=3 style='font-family: Arial, Helvetica, sans-serif;  font-size: 20px;'><a href='#' onclick='history.back(-1);' class='button'> < Back</a></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
</table></div>";

if (!isset($_POST['sendEmailBtn'])) {
?>
<button class="open-button" onclick="openForm()">Interested</button>
<?php
}
?>

<div class="form-popup" id="myForm">
  <form action="" class="form-container" name="myForm" method=post>
    
	<label for="d_name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="d_name" required>
	
    <label for="d_email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="d_email" required>
    
    <label for="d_contactno"><b>Contact Number</b></label>
    <input type="text" placeholder="Enter Contact Number" name="d_contactno" required>
    
    <label for="d_message"><b>Message</b></label>
    <textarea type="text" name="d_message"></textarea>
    
    <button type="submit" class="btn" name="sendEmailBtn">Submit Request</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<?php 
if (isset($_POST['sendEmailBtn'])) {
  $d_name = $_POST['d_name'];
  $d_email = $_POST['d_email'];
  $d_contactno = $_POST['d_contactno'];
  $d_message = $_POST['d_message'];
  $d_subject = 'Maid: '.$maid_name;
  // Content-Type helps email client to parse file as HTML 
  // therefore retaining styles
  $d_headers = 'MIME-Version: 1.0' . "\r\n";
  $d_headers .= 'Content-type:text/html; charset=ISO-8859-1' . "\r\n";
  $d_message = "<html>
  <head>
  	<title>Welcome Dareljood</title>
  </head>
  <body>
 <h4> Hi, </h4>
  	<b>Customer Name: </b>" . $d_name . "<BR>
	<b>Customer Email: </b>" . $d_email . "<BR>
	<b>Customer Contact Number: </b>" . $d_contactno . "<BR>
	<b>Customer Message: </b>\""
	. $d_message . "\"<BR><BR><b><U> Maid Details: </U></b><BR>
	<div class='table_container'><table style='background-color:rgba(0, 0, 0, 0); width:100%'>
	<tr><td style='border-bottom:1px solid #C0C0C0;padding:1px; width:100%' colspan=3>&nbsp;</td></tr>"
	.$result_record.
	"
	</table></div>

  </body>
  </html>";
  if (wp_mail('mohammed.balkhair@gmail.com', $d_subject, $d_message, $d_headers)) {
   echo "Request sucessfully submitted";
  }else{
   echo "Request submission failed. Please try again later";
  }
}
?>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>