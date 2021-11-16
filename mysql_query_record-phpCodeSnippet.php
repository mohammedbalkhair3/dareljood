<?php
$protocol = ((!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$maidsPage = $protocol . $_SERVER['HTTP_HOST'] . "/maids";
 
if (session_status() != PHP_SESSION_ACTIVE) {
	echo("<script>location.href = '".$maidsPage."'</script>");
}

global $wpdb;
$ID= $_GET['ID']; 
$email_request="email_request".$ID;
$result = $wpdb->get_results( "SELECT * FROM datatable WHERE ID=$ID");

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] == $_SESSION['maids_page']) {
    $previous = $previous;
} elseif (isset($_SESSION['maids_page'])) {
	$previous=$_SESSION['maids_page'];
}
else {
	$previous=$maidsPage;
}

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
<?php
if (isset($_SESSION[$email_request]) and $_SESSION[$email_request] == 'success') {
	echo "<div class='success_email'>Request already submitted successfully</div>";
}
?>
<div class="table_container">	
<table class='tbl_rec'>

<?php
$maid_name="";

foreach ($result as $row) {
	$maid_name=$row->NAME;
	$result_record="<tr>	
	<td id='tbl_rec_td1'>
	<img class='img_big' src='". get_home_url() . "/". $row->IMAGE_LOCATION ."';/>
	<br><br>". $row->NAME . "</td>
	<td align=left style='padding: 15px; width:30%'>
	<h4>" . $row->REMARKS_HEADING . "</h4><br>" . $row->REMARKS . "</td>
	<td align=left width=40%>
	<table class='tablerec'>
	<tr><td class='tbl_rec_td3'><b>NATIONALITY:</b> " . $row->NATIONALITY . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>RELIGION:</b> " . $row->RELIGION . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>DATE OF BIRTH:</b> " . $row->DOB . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>AGE:</b> " . $row->AGE . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>ADDRESS:</b> " . $row->ADDRESS . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>MARITAL STATUS:</b> " . $row->MARITAL_STATUS . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>WEIGHT KG:</b> " . $row->WEIGHT_KG . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>HEIGHT CM:</b> " . $row->HEIGHT_CM . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>LANGUAGES:</b> " . $row->LANGUAGES . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>EDUCATIONAL LEVEL:</b> " . $row->EDUCATIONAL_LEVEL . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>WASHING:</b> " . $row->WASHING . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>CLEANING:</b> " . $row->CLEANING . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>BABY SITTING:</b> " . $row->BABY_SITTING . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>COOKING:</b> " . $row->COOKING . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>IRONING:</b> " . $row->IRONING . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>EXPERIENCES:</b> " . $row->EXPERIENCES . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>AVAILABILITY:</b> " . $row->AVAILABILITY . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>DATE AVAILABLE:</b> " . $row->DATE_AVAILABLE . "</td></tr>
	<tr><td class='tbl_rec_td3'><b>CURRENT RESIDENCE:</b> " . $row->CURRENT_RESIDENCE . "</td></tr>
	</table></td>
	<tr><td style='border-bottom:1px solid #C0C0C0;padding:1px; width:100%' colspan=3>&nbsp;</td></tr>";
}
echo "$result_record<tr><td colspan=3>&nbsp;</td></tr>
<tr><td align=center colspan=3 style='font-family: Arial, Helvetica, sans-serif;  font-size: 20px;'><a href='".$previous."' class='button'> < Back</a></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
</table></div>";

if ((!isset($_SESSION[$email_request]) or ($_SESSION[$email_request] != "success")) and !isset($_POST['sendEmailBtn'])) {
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

if (isset($_POST['sendEmailBtn'])){
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
	.$result_record."
	</table></div>
	</body>
	</html>";
	if (wp_mail('mohammed.balkhair@gmail.com', $d_subject, $d_message, $d_headers)) {
		echo "<div class='success_email'>Request successfully submitted</div>";
	}else{
		echo "<div class='fail_email'>Request submission failed. Please try again later</div>";
	}
	$_SESSION[$email_request]='success';
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