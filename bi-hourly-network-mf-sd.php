  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['warroomuid']==0)) {
  header('location:logout.php');
  } else{
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

$output='';

//--




//--



if(isset($_POST['submit']))
{
$uid=$_SESSION['warroomuid'];

$status=1;
$tdate=date('Y-m-d');
$uttdate=date('YY-mm-dd');

$TimeCheck=mysqli_query($con,"SELECT hro.updationDate,hro.updateat from hrlysmry as hro where hro.updationDate='".$tdate."' order by hro.id desc limit 1");
$timeresult=mysqli_fetch_array($TimeCheck);

$date=$timeresult['updationDate'];
$hr=$timeresult['updateat'];
$updateat=$_POST['updathrr'];

//---


//---

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="600; url="<?php echo $_SERVER['PHP_SELF']; ?>" />
	
	<title>War Room Bi-Hourly Report</title>

	<script src="js/jquery-3.1.0.min.js"></script>
	<!--<<script src="js/jquery-2.2.0.min.js"></script>-->
	
	<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<!--<script src="bootstrap/js/bootstrap-3.3.7.min.js"></script>-->

	<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
	<link href="bootstrap/css/table-responsive.css" rel="stylesheet">
	<link href="scripts/datatables/datatables.min.css" rel="stylesheet">
	<link href="scripts/datatables/datatables.css" rel="stylesheet">
	<!--<link href="scripts/datatables/js/datatables.min.js" rel="stylesheet">-->
	

	
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	
	
<script src="js/jquery-3.4.1.slim.min.js"></script>
<!--<script src="js/popper.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>

	
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>-->
	
	<meta http-equiv="refresh" content="600; url="<?php echo $_SERVER['PHP_SELF']; ?>" />
	<meta http-equiv="refresh" content="900;url=logout.php"/>

<style>
.container { 
  height: 200px;
  position: relative;
  border: 3px solid green; 
}

.center {

  height: 35px; 
  margin: 0;
  position: absolute;
  top: 94%;
  left: 40%;
 -ms-transform: translate(-50%, -0%);
  transform: translate(-50%, -100%); 
 
}

.left-col {
    float: left;
    width: 10%;
}
 
.center-col {
    float: left;
    width: 65%;
}
 
.right-col {
    float: left;
    width: 25%;
}

.body {margin:10em;}
tfoot tr, thead tr,thead td {
	font-weight:bold;
	background: orange;
}
tfoot td {
	font-weight:bold;
		background: orange;
}


</style>
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>


	<div class="wrapper">
		
		
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="#"><em class="fa fa-home"></em></a></li>
				<li class="active">Bi-Hourly Site Down & PG Utilization Summary.</li>
			</ol>
		</div><!--/.row-->
		
		
		
		<div class="col-md-12">
						<div class="panel">
							<hr style="border: 1px solid orange"/>
					
																			
							<!--<div class="panel-body">-->
								
								<!--<p style="text-align:left; vertical-align: middle;"><i class="fa fa-clock-o"></i><b> Update Hourly Active Log</b></p>-->
								
								<div class="col-md-12">
									
									
								
									<form  method="post" action="bi-hourly-network-mf-sd.php" enctype="multipart/form-data">
									
									<table  class="table table-striped display" style="white-space:nowrap;height:auto; width:auto;vertical-align:top; margin-left: auto; margin-right: auto; margin-top: auto;">
									
									<tbody>
									
										<tr >
										
										<th><div class="form-group"></div></th>	
									
			<td style="text-align:left; vertical-align: middle;""><div class="form-group"><div class="form-group"><label style="text-align:Left; vertical-align: middle;">Date</label><input class="form-control" type="date"  id="reportdate" name="reportdate" required="true" style="margin:-6%;vertical-align: middle; 
											top:100%;transform: translateY(10%);-ms-transform: translateY(10%);"></div></td>
											
			<td style="text-align:left; vertical-align: middle;"><div class="form-group"><label style="text-align:Left; vertical-align: middle;">Region </label><select class="form-control" name="region" required="required" onChange="getCat(this.value);" style="text-align:Left; vertical-align: middle;">
<!--<option value="">Select Region</option>-->

<?php 
$uid=$_SESSION['warroomuid'];
$tdate=date('Y-m-d');
$queryb=mysqli_query($con,"SELECT distinct(blon.regionName),blon.regionid,blon.regionAll FROM blofficenew blon ORDER BY blon.regionAll asc");
while ($rowtime=mysqli_fetch_array($queryb)) 
{?>

 <option value="<?php echo htmlentities($rowtime['regionid'])?>"><?php echo $rowtime['regionName'];?></option>
  
<?php
}
?>
</select></font></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><input type="submit" name="submit" class="btn btn-primary has-success" style="margin: 0; position: absolute;
											top: 50%;transform: translateY(-50%);-ms-transform: translateY(-50%);"/></div></td>
											<th><div class="form-group"></div></th>	
											<td><div class="form-group"></div></td>
											<td><div class="form-group"></div></td>
											<td><div class="form-group"></div></td>								
											<th><div class="form-group"></div></th>	
																					
										</tr>
										
									</tbody>
									
									</table>
																						
											
								</div>
							<!--</div>-->
							<!--panel-body table-->
					
						
						
						<!--</div>	<!--panel-->					
					<!--</div>	<!--col-md-12-->
								
		
				
									
				
					<!--<div class="col-md-12">-->	
					<!--<div class="panel">-->
						
								
				
					
						
										
					<div class="panel-body table" >
								<table class="datatable-1 table table-fit table-bordered table-striped display" border="2" style="white-space:nowrap;width:100%;">
									<thead>
									<tr><!-- Table Row & head-->
											
										<td style="text-align:center; vertical-align: middle;" rowspan="2"><font face="Calibri" size="2" color="white">SL#</font></td>
										<td style="text-align:center; vertical-align: middle;" rowspan="2"><font face="Calibri" size="2" color="white">BL<br> Office</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">6:00</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">8:00</font></td>							
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">10:00</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">12:00</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">14:00</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">16:00</font></td>							
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">18:00</font></td>
										<td style="text-align:center; vertical-align: middle;" colspan="2"><font face="Calibri" size="2" color="white">20:00</font></td>											
									</tr>
										
									<tr>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">SD</font></td>
										<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white">PG</font></td>
									</tr>								
										
									</thead>
									<tbody>

<?php 
$uid=$_SESSION['warroomuid'];
//$tdate=date('Y-m-d',strtotime("-1 days"));
$date=date('Y-m-d');

//$updathrr=$_POST['updathrr'];
$reportdate=$_POST['reportdate'];
$region=$_POST['region'];


if($region>0){

$query1=mysqli_query($con,"select bon.id,bon.regionid,bon.officeid,bon.bloffice from blofficenew bon 
where bon.bloffice IS NOT NULL AND bon.bloffice!='-' AND bon.regionid=$region ORDER BY bon.id ASC;");

	}else{
	
$query1=mysqli_query($con,"select bon.id,bon.regionid,bon.officeid,bon.bloffice from blofficenew bon 
where bon.bloffice IS NOT NULL AND bon.bloffice!='-' ORDER BY bon.id ASC;");
		}
	
$cnt=1;
while($rowOffice=mysqli_fetch_array($query1))
{

$ttlSD6h=0;
$ttlSD8h=0;
$ttlSD10h=0;
$ttlSD12h=0;
$ttlSD14h=0;
$ttlSD16h=0;
$ttlSD18h=0;
$ttlSD20h=0;

	
	
$Hrlysm_query=mysqli_query($con,"select sds.id,sds.bloffice,sds.totalCountSD,sds.updateat AS sds_Time,sds.updationDate,sds.regionid,sds.officeid from site_down_summary sds
where sds.updationDate='".$reportdate."' AND sds.officeid='".$rowOffice['officeid']."'
ORDER BY sds.id ASC;");

while($row=mysqli_fetch_array($Hrlysm_query)){

$UpdateHr=$row['sds_Time'];
//$totalPg=$row['totalPg'];
//$totalPgrun=$row['Pgrun'];

//print_r($row);
//echo "<br>";
								if($UpdateHr==6 && ($row['totalCountSD'])>0) {($ttlSD6h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==8 && ($row['totalCountSD'])>0) {($ttlSD8h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==10 && ($row['totalCountSD'])>0){($ttlSD10h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==12 && ($row['totalCountSD'])>0) {($ttlSD12h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==14 && ($row['totalCountSD'])>0) {($ttlSD14h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==16 && ($row['totalCountSD'])>0) {($ttlSD16h=$row['totalCountSD']);} else {;};		
								if($UpdateHr==18 && ($row['totalCountSD'])>0) {($ttlSD18h=$row['totalCountSD']);} else {;};	
								if($UpdateHr==20 && ($row['totalCountSD'])>0) {($ttlSD20h=$row['totalCountSD']);} else {;};		
								
										}
										

$ttlPgU6h=0;
$ttlPgU8h=0;
$ttlPgU10h=0;	
$ttlPgU12h=0;
$ttlPgU14h=0;
$ttlPgU16h=0;
$ttlPgU18h=0;
$ttlPgU20h=0;

$ttlPg6h=0;
$ttlPgR6h=0;
$ttlPg8h=0;
$ttlPgR8h=0;
$ttlPg10h=0;
$ttlPgR10h=0;	
$ttlPg12h=0;
$ttlPgR12h=0;
$ttlPg14h=0;
$ttlPgR14h=0;
$ttlPg16h=0;
$ttlPgR16h=0;
$ttlPg18h=0;
$ttlPgR18h=0;
$ttlPg20h=0;
$ttlPgR20h=0;
	

$HrlysmGen_query=mysqli_query($con,"SELECT hrsm.id,hrsm.bloffice,hrsm.officeid,hrsm.totalPg,hrsm.Pgrun,hrsm.PgUtilization,hrsm.Pgmove,hrsm.regionid,hrsm.updateat,hrsm.updationDate from hrlysmry hrsm 
where hrsm.updationDate='".$reportdate."' AND hrsm.officeid='".$rowOffice['officeid']."'
ORDER BY hrsm.id ASC;");

while($rowGen=mysqli_fetch_array($HrlysmGen_query)){

$UpdateHrGen=$rowGen['updateat'];
//$totalPg=$row['totalPg'];
//$totalPgrun=$row['Pgrun'];

//print_r($row);
//echo "<br>";
									
								if($UpdateHrGen==6 && ($rowGen['PgUtilization'])>0) {($ttlPgU6h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==8 && ($rowGen['PgUtilization'])>0) {($ttlPgU8h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==10 && ($rowGen['PgUtilization'])>0){($ttlPgU10h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==12 && ($rowGen['PgUtilization'])>0) {($ttlPgU12h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==14 && ($rowGen['PgUtilization'])>0) {($ttlPgU14h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==16 && ($rowGen['PgUtilization'])>0) {($ttlPgU16h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==18 && ($rowGen['PgUtilization'])>0) {($ttlPgU18h=$rowGen['PgUtilization']);} else {;};
								if($UpdateHrGen==20 && ($rowGen['PgUtilization'])>0) {($ttlPgU20h=$rowGen['PgUtilization']);} else {;};
								
								if($UpdateHrGen==6 && ($rowGen['totalPg'])>0) {($ttlPg6h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==6 && ($rowGen['Pgrun'])>0) {($ttlPgR6h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==8 && ($rowGen['totalPg'])>0) {($ttlPg8h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==8 && ($rowGen['Pgrun'])>0) {($ttlPgR8h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==10 && ($rowGen['totalPg'])>0){($ttlPg10h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==10 && ($rowGen['Pgrun'])>0){($ttlPgR10h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==12 && ($rowGen['totalPg'])>0) {($ttlPg12h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==12 && ($rowGen['Pgrun'])>0) {($ttlPgR12h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==14 && ($rowGen['totalPg'])>0) {($ttlPg14h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==14 && ($rowGen['Pgrun'])>0) {($ttlPgR14h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==16 && ($rowGen['totalPg'])>0) {($ttlPg16h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==16 && ($rowGen['Pgrun'])>0) {($ttlPgR16h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==18 && ($rowGen['totalPg'])>0) {($ttlPg18h=$rowGen['totalPg']);} else {;};	
								if($UpdateHrGen==18 && ($rowGen['Pgrun'])>0) {($ttlPgR18h=$rowGen['Pgrun']);} else {;};
								if($UpdateHrGen==20 && ($rowGen['totalPg'])>0) {($ttlPg20h=$rowGen['totalPg']);} else {;};		
								if($UpdateHrGen==20 && ($rowGen['Pgrun'])>0) {($ttlPgR20h=$rowGen['Pgrun']);} else {;};

										}										
										
										
									
									
?>								
									
	
									
									<tr>
											
											<td style="text-align:center"><font face="Calibri" size="2"><?php echo htmlentities($cnt);?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php echo htmlentities($rowOffice['bloffice']);?></font></td>
																					
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD6h>0){echo $ttlSD6h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU6h>0){echo $ttlPgU6h,"%";} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD8h>0){echo $ttlSD8h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU8h>0){echo $ttlPgU8h,"%";} else {echo "-";};?></font></td>
											
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD10h>0){echo $ttlSD10h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU10h>0){echo $ttlPgU10h,"%";} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD12h>0){echo $ttlSD12h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU12h>0){echo $ttlPgU12h,"%";} else {echo "-";};?></font></td>
											
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD14h>0){echo $ttlSD14h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU14h>0){echo $ttlPgU14h,"%";} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD16h>0){echo $ttlSD16h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU16h>0){echo $ttlPgU16h,"%";} else {echo "-";};?></font></td>
											
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD18h>0){echo $ttlSD18h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU18h>0){echo $ttlPgU18h,"%";} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlSD20h>0){echo $ttlSD20h;} else {echo "-";};?></font></td>
											<td style="text-align:center"><font face="Calibri" size="2"><?php if($ttlPgU20h>0){echo $ttlPgU20h,"%";} else {echo "-";};?></font></td>
											
								
									</tr>
																														
										<?php 
										$totalSD6hrs+=$ttlSD6h;
										  $totalSD8hrs+=$ttlSD8h;
										   $totalSD10hrs+=$ttlSD10h;
										    $totalSD12hrs+=$ttlSD12h;
											 $totalSD14hrs+=$ttlSD14h; 								 
											  $totalSD16hrs+=$ttlSD16h;
											   $totalSD18hrs+=$ttlSD18h;
											    $totalSD20hrs+=$ttlSD20h;
												
										$totalPg6hrs+=$ttlPg6h;
										$totalPgR6hrs+=$ttlPgR6h;
										$totalPg8hrs+=$ttlPg8h;
										$totalPgR8hrs+=$ttlPgR8h;
										$totalPg10hrs+=$ttlPg10h;
										$totalPgR10hrs+=$ttlPgR10h;	
										$totalPg12hrs+=$ttlPg12h;
										$totalPgR12hrs+=$ttlPgR12h;
										$totalPg14hrs+=$ttlPg14h;
										$totalPgR14hrs+=$ttlPgR14h;	
										$totalPg16hrs+=$ttlPg16h;
										$totalPgR16hrs+=$ttlPgR16h;
										$totalPg18hrs+=$ttlPg18h;
										$totalPgR18hrs+=$ttlPgR18h;	
										$totalPg20hrs+=$ttlPg20h;
										$totalPgR20hrs+=$ttlPgR20h;
										$PgR6=ROUND((($totalPgR6hrs*100/$totalPg6hrs)),0);
										$PgR8=ROUND((($totalPgR8hrs*100/$totalPg8hrs)),0);
										$PgR10=ROUND((($totalPgR10hrs*100/$totalPg10hrs)),0);
										$PgR12=ROUND((($totalPgR12hrs*100/$totalPg12hrs)),0);
										$PgR14=ROUND((($totalPgR14hrs*100/$totalPg14hrs)),0);
										$PgR16=ROUND((($totalPgR16hrs*100/$totalPg16hrs)),0);
										$PgR18=ROUND((($totalPgR18hrs*100/$totalPg18hrs)),0);
										$PgR20=ROUND((($totalPgR20hrs*100/$totalPg20hrs)),0);										
										$cnt=$cnt+1; } ?> <!--$cnt=$cnt+1;-->
									
									</tbody>
<tfoot>
<tr>
  <td colspan="2" style="text-align:center; vertical-align: middle;"><b><font face="Calibri" size="2" color="white">Grand Total</font></b></td>     
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD6hrs>0){echo $totalSD6hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR6>0){echo $PgR6,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD8hrs>0){echo $totalSD8hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR8>0){echo $PgR8,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD10hrs>0){echo $totalSD10hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR10>0){echo $PgR10,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD12hrs>0){echo $totalSD12hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR12>0){echo $PgR12,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD14hrs>0){echo $totalSD14hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR14>0){echo $PgR14,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD16hrs>0){echo $totalSD16hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR16>0){echo $PgR16,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD18hrs>0){echo $totalSD18hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR18>0){echo $PgR18,"%";} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($totalSD20hrs>0){echo $totalSD20hrs;} else {echo "-";};?></font></td>
		<td style="text-align:center; vertical-align: middle;"><font face="Calibri" size="2" color="white"><?php if($PgR20>0){echo $PgR20,"%";} else {echo "-";};?></font></td>

		</tr>									
								
</tfoot>								
							
								
								</table>
								<!--Close connection-->
																			
							</div><!--panel-body table-->
							
						</div>	<!--panel-->
		<!--<div class="panel-body table" >						
								
		<!--</div> <!--class="panel-body table"-->					
							
						<!--</div>	<!--panel-->					
		</div>	<!--col-md-12-->
						
				
	</div><!--/.main-->
		
	</div><!--/.wrapper-->
	
	<?php include_once('includes/footer.php');?>
	
    <!--script for this page-->
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/datatables.min.js"></script>
	<script src="scripts/datatables/js/jquery.dataTables.min.js"></script>
	<script src="scripts/datatables/js/dataTables.buttons.min.js"></script>
	<script src="scripts/datatables/js/jszip.min.js"></script>
	<script src="scripts/datatables/js/buttons.html5.min.js"></script>
	
	<!--<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>-->
	<!--<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>-->
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
	<!--<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>-->
	
	
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable({
				"order" : [[0, "asc"]],
								
				dom: "Bfrtip","buttons": [
            {extend:"excelHtml5"},
            {extend: "csvHtml5"}
         	],
	            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": true,
			"bAutoWidth": true,
								
			});
			
		});
	</script>
	


</body>
</html>
<!-->

<!-->

<?php mysqli_close($con);} ?>