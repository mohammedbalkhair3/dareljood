<?php

$pg=1;
if (isset($_SESSION['maids_pg_num'])){
	$pg=(int)$_SESSION['maids_pg_num'];
}
$protocol = ((!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$maidsPage = $protocol . $_SERVER['HTTP_HOST'] . "/maids/?pg=".$pg;
 
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
body {font-family: Arial;}
</style>
<body>

<?php
if (isset($_SESSION[$email_request]) and $_SESSION[$email_request] == 'success') {
	echo "<div class='div_container'><p style='background-color: lightgreen'>Request already submitted successfully</p></div>";
}
$maid_name="";

foreach ($result as $row) {
	$maid_name=$row->NAME;
	$result_record="
  <div class=\"div_container\">
	<div class=\"div_sub_container\">
		<img style=\"width: 350px; height: 350px;\" src=\"" . get_home_url() . "/". $row->IMAGE_LOCATION . "\"/>
		<p>" . $row->NAME . "</p>
	</div>
	<div class=\"div_sub_container\">
  	<h4>" . $row->REMARKS_HEADING . "</h4>
    <p>" . $row->REMARKS . "</p>
    </div>
    <div class=\"div_sub_container\">
		<table>
		<tr>	
			<th>Nationality:</th>
			<td>" . $row->NATIONALITY . "</td>
		</tr>
		<tr>	
			<th>Religion:</th>
			<td>" . $row->RELIGION . "</td>
		</tr>
		<tr>	
			<th>Date of Birth:</th>
			<td>" . $row->DOB . "</td>
		</tr>
		<tr>	
			<th>Age:</th>
			<td>" . $row->AGE . "</td>
		</tr>
		<tr>	
			<th>Address:</th>
			<td>" . $row->ADDRESS . "</td>
		</tr>
		<tr>	
			<th>Marital Status:</th>
			<td>" . $row->MARITAL_STATUS . "</td>
		</tr>
		<tr>	
			<th>Weight(KG):</th>
			<td>" . $row->WEIGHT_KG . "</td>
		</tr>
		<tr>	
			<th>Height(CM):</th>
			<td>" . $row->HEIGHT_CM . "</td>
		</tr>
		<tr>	
			<th>Languages:</th>
			<td>" . $row->LANGUAGES . "</td>
		</tr>
		<tr>	
			<th>Educational Level:</th>
			<td>" . $row->EDUCATIONAL_LEVEL . "</td>
		</tr>
		<tr>	
			<th>Washing:</th>
			<td>" . $row->WASHING . "</td>
		</tr>
		<tr>	
			<th>Cleaning:</th>
			<td>" . $row->CLEANING . "</td>
		</tr>
		<tr>	
			<th>Baby Sitting:</th>
			<td>" . $row->BABY_SITTING . "</td>
		</tr>
		<tr>	
			<th>Cooking:</th>
			<td>" . $row->COOKING . "</td>
		</tr>
		<tr>	
			<th>Ironing:</th>
			<td>" . $row->IRONING . "</td>
		</tr>
		<tr>	
			<th>Experiences:</th>
			<td>" . $row->EXPERIENCES . "</td>
		</tr>
		<tr>	
			<th>Availability:</th>
			<td>" . $row->AVAILABILITY . "</td>
		</tr>
		<tr>	
			<th>Date Available:</th>
			<td>" . $row->DATE_AVAILABLE . "</td>
		</tr>
		<tr>	
			<th>Current Residence:</th>
			<td>" . $row->CURRENT_RESIDENCE . "</td>
		</tr>
		</table>
   </div>
   <div class=\"div_line\"></div>
</div>";

}
echo "$result_record";
?>

<div class="div_container">
	<p><a href='<?php echo $previous; ?>' class='button'> < Back</a></p>
</div>
<?php
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
  $to_email = $GLOBALS['cgv']['global_to_email'];
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
	. $d_message . "\"<BR><BR><b><U> Maid Details: </U></b><BR>"
	.$result_record."
	</body>
	</html>";
	if (wp_mail($to_email, $d_subject, $d_message, $d_headers)) {
		$_SESSION[$email_request]='success';
		echo "<div class='div_container'><p style='background-color: lightgreen'>Request successfully submitted</p></div>";
	}else{
		$_SESSION[$email_request]='failed';
		echo "<div class='div_container'><p style='background-color: orange'>Request submission failed. Please try again later</p></div>";
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