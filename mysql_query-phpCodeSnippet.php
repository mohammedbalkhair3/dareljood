<?php

if (session_status() != PHP_SESSION_ACTIVE) {
session_start();
}

$protocol = ((!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurpgURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

if (!isset($_SESSION['maids_pg'])){
	$_SESSION['maids_pg']=$CurpgURL;
}

global $wpdb;

?>

<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&display=swap" rel="stylesheet">
</head>
<style>
body {font-family: Arial;}
</style>
<body>

<div class="div_container">

<?php
$limit = $GLOBALS['cgv']['global_rec_limits'];

if(isset($_GET['pg'])){
	$pg = (int)$_GET['pg'];
	if ($pg < 1)
		$pg = 1;
}else{
	$pg = 1;
}

$_SESSION['maids_pg_num']=$pg;

$offset = ($pg - 1) * $limit;

$result = $wpdb->get_results( "SELECT ID FROM datatable;");

$total_rows=$wpdb->num_rows;

$result = $wpdb->get_results( "SELECT ID, NAME, IMAGE_LOCATION, NATIONALITY, AVAILABILITY, DATE_AVAILABLE, CURRENT_RESIDENCE, REMARKS, REMARKS_HEADING FROM datatable LIMIT $offset, $limit");

$total_pg = ceil($total_rows / $limit);

foreach ($result as $row) {
	?>
	<div class="div_container">
  <div class="div_sub_container">
  	  <img src="<?php echo $row->IMAGE_LOCATION; ?>"/>		
	<p><a href=maid-profile?ID=<?php echo $row->ID; ?> class='button'>Maid Profile</a></p>
  </div>
  <div class="div_sub_container">
	<table>
	<tr>	
	   	<th>Name:</th>
        <td><?php echo $row->NAME; ?></td>
    </tr>
	<tr>	
	   	<th>Nationality:</th>
        <td><?php echo $row->NATIONALITY; ?></td>
    </tr>
	<tr>	
	   	<th>Availability:</th>
        <td><?php echo $row->AVAILABILITY; ?></td>
    </tr>
	<tr>
	   	<th>Available Date:</th>
        <td><?php echo $row->DATE_AVAILABLE; ?></td>
    </tr>
	<tr>	
	   	<th>Current Residence:</th>
        <td><?php echo $row->CURRENT_RESIDENCE; ?></td>
    </tr>
	</table>
   </div>
  <div class="div_sub_container">
  	<h4><?php echo $row->REMARKS_HEADING; ?></h4>
    <p><?php echo  $row->REMARKS; ?></p>
  </div>	
</div>
<div class="div_line"></div>
	<?php
}
?>
</div>
<div class="container">
<ul class="pagination">
            <a class="nav-link-left nav-link" href="?pg=1"><i class="fas fa-angle-double-left"></i></a>
            <a class="nav-link" href="<?php if($pg <= 1){echo '#';}else{$t=$pg-1;echo "?pg=".$t;} ?>"><i class="fas fa-caret-left"></i></a>
            <?php 
				echo "<a class='active links' href='?pg=$pg'>".$pg." / ".$total_pg."</a>";
			/*
                for($i = 1; $i <= $total_pg; $i++){
                    if($pg == $i){
                        echo "<a class='active links' href='?pg=$i'>".$i."</a>";
                    }else{
                        echo "<a class='links' href='?pg=$i'>".$i."</a>";
                    }
                }
				*/
            ?>
			<a class="nav-link" href="<?php if($pg == $total_pg ){echo '#';}else{$t=$pg+1;echo "?pg=".$t;} ?>"><i class="fas fa-caret-right"></i></a>
            <a class="nav-link-right nav-link" href="?pg=<?php echo $total_pg;?>"><i class="fas fa-angle-double-right"></i></a>
        
        </ul>
<!--
<form action="" method="GET">
	
	<select name="pg" onchange="this.form.submit()">
		
		<?php 
		/*
			echo "<option value='$pg'>Active:".$pg."</option>";
			for($i = 1; $i <= $total_pg; $i++){
				echo "<option value='$i'>".$i."</option>";
			}
		*/
		?>

	</select>
</form>
		-->
</div>
		</body>
</html>