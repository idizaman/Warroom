<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['warroomuid']==0)) {
  header('location:logout.php');
  } else{
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime=date( 'd-m-Y h:i:s A', time () );
$tdate=date('Y-m-d'); // Today

if(isset($_POST['submit']))
{
$uid=$_SESSION['warroomuid'];

$status=1;
$ret=mysqli_query($con,"SELECT * from tbluser where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['FullName'];

$uttdate=date('YY-mm-dd');

$time=date('H:i:s', time ());
$TimeCheck=mysqli_query($con,"SELECT ut.updationDate,ut.updateat,ut.bloffice from utilization as ut
LEFT JOIN tbluser as tblusr ON ut.officeid=tblusr.officeid where ut.updationDate='".$tdate."' and tblusr.id='$uid' order by ut.id desc limit 1");
$timeresult=mysqli_fetch_array($TimeCheck);

$date=$timeresult['updationDate'];
$hr=$timeresult['updateat'];
$off=$timeresult['bloffice'];
$hr=$timeresult['updateat'];
$off=$timeresult['bloffice'];
$pringtdate=date('Y-m-d');

$PCdatedatetime=date('Y-m-d h:i:s a', time());
$blockhr= date('H', strtotime($PCdatedatetime));
$ExtraHr=1;
//exit;

if(($timeresult['updateat']>0) and $updathrr=$_POST['updathrr']>($blockhr + $ExtraHr))
{
	echo "<script>alert('Hi ".$name."! \\n==> You are two or more hours ahead of the update time.. \\n. Select the correct time.\\n -- Thank You -- \\n   War Room.');</script>";
	
	} elseif (!empty($updathrr=$_POST['updathrr']<=$timeresult['updateat'])) {
	
	echo "<script>alert('Hi ".$name."! \\n Sorry!! You are not allowed to access previous hour(s). \\n Try again to keep moving forward. \\n -- Thank You -- \\n   War Room.');</script>";

	} elseif (empty($timeresult['updateat']) and $updathrr=$_POST['updathrr']>20) {
		
	echo "<script>alert('Hi ".$name."! \\n Entry is not allowed or Invalid entry. \\n ".$currentTime." \\n. Date & Time is almost over today.\\n -- Thank You -- \\n   War Room.');</script>";
	
	} else {

$usra=mysqli_query($con,"select usr.ro,usr.roleid,usr.officeid,usr.regionid,usr.id from resourse as rs LEFT JOIN tbluser usr ON rs.officeid=usr.officeid where usr.id='$uid'");
$row=mysqli_fetch_array($usra);
$ro=$row['ro'];
$roleid=$row['roleid'];
$officeid=$row['officeid'];
$regionid=$row['regionid'];
$zmusrid=$row['id'];

$count=count($_POST['resourseid']);
for ($i=0; $i<$count; $i++){
$resourseid=$_POST['resourseid'][$i];
$gentype=$_POST['gentype'][$i];
$gensource=$_POST['gensource'][$i];
//$gencondition=$_POST['gencondition'][$i];
$genslno=$_POST['genslno'][$i];
$siteid=strtoupper($_POST['siteid'][$i]);
$starttime=strtoupper($_POST['starttime'][$i]);
$stoptime=strtoupper($_POST['stoptime'][$i]);

$todaystatus=$_POST['todaystatus'][$i];
$bloffice=$_POST['bloffice'][$i];
$flmoffice=$_POST['flmoffice'][$i];
$updathrr=$_POST['updathrr']; 

   // do any update with database
$utInsertQuery="insert into utilization(UserId,resourseid,gentype,gensource,genslno,siteid,starttime,stoptime,todaystatus,bloffice,flmoffice,ro,status,roleid,officeid,regionid,updateat,updationDate,updateTime) values('$uid','$resourseid','$gentype','$gensource','$genslno','$siteid','$starttime','$stoptime','$todaystatus','$bloffice','$flmoffice','$ro','$status','$roleid','$officeid','$regionid','$updathrr','$tdate','$time')";

//echo $utInsertQuery."<br />";
$query=mysqli_query($con,$utInsertQuery);
}

if($uid == $zmusrid) {
		$hsInsertQuery=mysqli_query($con,"insert into hrlysmry(UserId,bloffice,status,roleid,officeid,regionid,updateat,updationDate) values('$uid','$bloffice','$status','$roleid','$officeid','$regionid','$updathrr','$tdate')");
		//$queryd=mysqli_fetch_array($hsInsertQuery);
	} else {
			}
	
$hsDetailQuery="SELECT ROUND(((s.run*100/(SELECT blo.BasicPG from blofficenew blo 
where blo.officeid=s.officeid))),2) AS tcpercentage,(SELECT blo.BasicPG from blofficenew blo 
where blo.officeid=s.officeid) AS basPG, s.totalCount, s.gentype, s.updateat,s.run, 
s.move, s.standbyAtsite, s.idleAtoffice, s.notWorkable,s.userId,s.officeid,s.UserId,s.updateat,s.updationDate FROM (
SELECT COUNT(*) AS totalCount, ut.gentype, ut.updateat,ut.UserId,ut.officeid,ut.updationDate,
  sum(case when ut.todaystatus = 'run' then 1 else 0 end) run,
  sum(case when ut.todaystatus = 'move' then 1 else 0 end) move,
   sum(case when ut.todaystatus = 'Standby-at-Site' then 1 else 0 end) standbyAtsite,
  sum(case when ut.todaystatus = 'Idle-at-Office' then 1 else 0 end) idleAtoffice,
   sum(case when ut.todaystatus = 'Not-Workable' then 1 else 0 end) notWorkable
from utilization AS ut LEFT JOIN tbluser as tblusr ON ut.officeid=tblusr.officeid WHERE ut.updationDate='".$tdate."' AND ut.updateat=$updathrr AND tblusr.id='$uid' GROUP BY ut.gentype, ut.updateat) s
ORDER BY s.gentype DESC";

//echo $hsDetailQuery."<br />";
$qat=mysqli_query($con,$hsDetailQuery); 

while($rowsumm=mysqli_fetch_array($qat)){
	$Uttcpercentage=$rowsumm['tcpercentage'];
	$Utgentype=$rowsumm['gentype'];
	$BasicPgCount=$rowsumm['basPG'];
	$UttotalCount=$rowsumm['totalCount'];
	$Utupdateat=$rowsumm['updateat'];
	$Utrun=$rowsumm['run'];
	$Utmove=$rowsumm['move'];
	$UtstandbyAtsite=$rowsumm['standbyAtsite'];
	$UtidleAtoffice=$rowsumm['idleAtoffice'];
	$UtnotWorkable=$rowsumm['notWorkable'];
	$UtUserId=$rowsumm['UserId'];
	$UtupdationDate=$rowsumm['updationDate'];
	
	if($uid == $zmusrid && $gentype == "PG") {
		$hsDetailUpdateQuery=mysqli_query($con,"update hrlysmry set totalBasicPg='$BasicPgCount',totalPg=$UttotalCount,Pgrun=$Utrun,Pgmove=$Utmove,PgstandbyAtsite=$UtstandbyAtsite,PgidleAtoffice=$UtidleAtoffice,PgnotWorkable=$UtnotWorkable,PgUtilization=$Uttcpercentage WHERE updationDate='".$tdate."' AND updateat=$Utupdateat AND UserId='$uid'");
	} else {
		$hsDetailUpdateQuery=mysqli_query($con,"update hrlysmry set totalDg=$UttotalCount,Dgrun=$Utrun,Dgmove=$Utmove,DgstandbyAtsite=$UtstandbyAtsite,DgidleAtoffice=$UtidleAtoffice,DgnotWorkable=$UtnotWorkable,DgUtilization=$Uttcpercentage WHERE updationDate='".$tdate."' AND updateat=$Utupdateat AND UserId='$uid'");
	}
	$Utupdate=mysqli_fetch_array($hsDetailUpdateQuery);

}

	
if($query){
echo "<script>alert('Record successfully updated.');</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";
}
echo "<meta http-equiv='refresh' content='0'>";
}
}

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	
	<title>War Room||Data Entry</title>
	
	<!--<script src="js/jquery-3.1.0.min.js"></script>-->
	<!--<<script src="js/jquery-2.2.0.min.js"></script> media="screen"-->
	<!--<<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">-->
	<link rel="stylesheet" href="bootstrap/3.3.7/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="bootstrap/css/style-responsive.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="bootstrap/css/table-responsive.css">
	<link rel="stylesheet" href="bootstrap/css/style-responsive.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="images/icons/css/font-awesome.css">
	<link rel="stylesheet" href="bootstrap/1.12.1/css/bootstrap-select.css" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap-select.min.css"/>
	
	
	
	

<style>

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
	background:orange;
}
tfoot td {
	font-weight:bold;
		background:orange;
}

</style>	



		
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">PG/DGoW Utilization Entry.
</li>
			</ol>
		</div><!--/.row-->
		

     	  
				<div class="col-lg-12">	
					<div class="panel">
							
					<hr style="border: 1px solid orange">
					<div class="panel-heading text-center">
					<p style="line-height: 20%; margin-top:0; margin-bottom:0; color: black"><b><font size="5" face="Arial Narrow">PG/DGoW Data Entry</font></b></p>
						<p style="line-height: 120%; margin-top:0; margin-bottom:0; color:orange"><b><font face="Arial Narrow" size="3"><?php echo htmlentities($row['bloffice']);?></font></b></p>
					<p style="line-height: 100%; margin-top:0; margin-bottom:0"><b><font size="2" face="Arial Narrow">Date&nbsp;:&nbsp;<?php echo htmlentities($currentTime);?></p>
					</div>
					 
					<div class="panel-body">
						
						<div class="col-lg-14" >



			<form method="post" enctype="multipart/form-data" >

<div class="form-group" style="text-align:center; padding-left:5%;">
<label class="col-md-2" style="font-family:Arial Narrow">Resource update at <br><font size="2" face="Arial Narrow" color="#FF0000">(Mandatory selection)</font></label>
<div class="col-md-2">
<p style="line-height: 20%; margin-top:0; margin-bottom:0; color: black; padding-left:5%;"><font face="Arial Narrow" size="2"><select name="updathrr" required="required" onChange="getCat(this.value);" style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0; width:100px !important;">
<option value="">Select Hr.</option>

<?php 
$uid=$_SESSION['warroomuid'];
$queryb=mysqli_query($con,"select uph.id,uph.updathr,uph.updateat from updatehrs as uph");
while ($rowtime=mysqli_fetch_array($queryb)) {

$utTime=mysqli_query($con,"SELECT ut.id, ut.updateat,ut.UserId,ut.officeid from utilization as ut
LEFT JOIN tbluser as tblusr ON ut.officeid=tblusr.officeid where updationDate='".$tdate."' and tblusr.id='$uid' order by ut.id desc limit 1");

$time=mysqli_fetch_array($utTime);
  ?>
  
  <option value="<?php echo htmlentities($rowtime['id']);?>" <?php if($rowtime['id']==$time['updateat']) {echo 'selected="selected"';} else { } ?> ><?php echo htmlentities($rowtime['updateat']);?></option>
  
<?php
}
?>
</select></font></p>
</div>
</div>	

							<div class="table responsive">

			<table class="datatable-1 table table-fit table-bordered table-striped display compact stripe" style="white-space:nowrap;" width="100%">
			
				<thead>
                <tr>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Sl.No</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">BL Office</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">FLM Office</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Gen. Type</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Gen.Source</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Gen.SL No</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Site ID</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Start Time</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Stop Time</font></td>
					<td style="text-align:center; vertical-align: middle;" align="center"><font face="Calibri" size="2">Current Status</font></td>
					
				 </tr>
              </thead>
              
              <tbody>
<?php 
$uid=$_SESSION['warroomuid'];
$querya=mysqli_query($con,"SELECT rs.id,rs.bloffice,rs.flmoffice,rs.gentype,rs.gensource,rs.gencondition,rs.genslno from resourse as rs LEFT JOIN tbluser as usr ON rs.officeid=usr.officeid where usr.id='$uid' order BY rs.id");
$cnt=1;
while($row=mysqli_fetch_array($querya))
{
$queryut=mysqli_query($con,"SELECT ut.id,ut.bloffice,ut.flmoffice,ut.gentype,ut.gensource,ut.gencondition,ut.genslno,ut.siteid,ut.starttime,ut.stoptime,ut.todaystatus,ut.updateat from utilization as ut where ut.resourseid=".$row['id']." and ut.updationDate='".$tdate."' order by id desc limit 1");
$rowut=mysqli_fetch_array($queryut);
//var_dump($rowut['id']);
?>               
			
						<tr>
								
								
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="resourseid[]" required="required" value="<?php echo $row['id'];?>" required="" style="text-align:center; vertical-align: middle; color: black;" size="7" readonly></font></span></td>
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="bloffice[]" required="required" value="<?php echo $row['bloffice'];?>" required="" style="text-align:center; vertical-align: middle; color: black;" size="9" readonly></font></span></td>
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="flmoffice[]" required="required" value="<?php echo $row['flmoffice'];?>" required="" style="text-align:center; vertical-align: middle; color: black;" size="9" readonly></font></span></td>
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="gentype[]" required="required" value="<?php echo $row['gentype'];?>" required="" style="text-align:center; vertical-align: middle; color: black;" size="9" readonly></font></span></td>
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="gensource[]" required="required" value="<?php echo $row['gensource'];?>" required="" style="text-align:center; vertical-align: middle; color: black;" size="9" readonly></font></span></td>
								
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="1" color="#000000"><input type="text" name="genslno[]" required="required" value="<?php echo $row['genslno'];?>" required="" style="text-align:center; vertical-align: middle; color:#0000FF;" size="9" readonly></font></span></td>

<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="2"><select name="siteid[]" type="option" class="selectpicker form-control" data-size="4" data-width="100%" data-show-subtext="true" data-live-search="true" data-dropup-auto="false" style="color: black; text-align:center; width:100% !important; autofocus="autofocus">
<!--<option value=""></option>-->
<option disabled="disabled" selected>- Select -</option>
<?php $queryc=mysqli_query($con,"SELECT * from siteinfo as si LEFT JOIN tbluser as usr ON si.officeid=usr.officeid where usr.id='$uid'");
while ($row=mysqli_fetch_array($queryc)) 
	{
  ?>
  <option value="<?php echo htmlentities($row['siteCode']);?>" <?php if($row['siteCode']==$rowut['siteid']) echo 'selected="selected"'; ?> ><?php echo htmlentities($row['siteCode']);?></option>

<?php
}
?>
</select></font></span></td>	
								

	<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="2"><select name="starttime[]" type="option" class="selectpicker form-control" data-size="4" data-width="90%" data-show-subtext="true" data-live-search="true" data-dropup-auto="false" style="color: black; text-align:center; width:90% !important; autofocus="autofocus">
<!--<option value=""></option>-->
<option disabled="disabled" selected>Select</option>
<?php $querytime=mysqli_query($con,"SELECT udt.id,udt.timebox,udt.timedigit,udt.roleid FROM updatetime udt");
while ($row=mysqli_fetch_array($querytime)) {
  ?>
  <option value="<?php echo htmlentities($row['timedigit']);?>" <?php if($row['timedigit']==$rowut['starttime']) echo 'selected="selected"'; ?> ><?php echo htmlentities($row['timedigit']);?></option>

<?php
}
?>
</select></font></span></td>	

	<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="2"><select name="stoptime[]" type="option" class="selectpicker form-control" data-size="4" data-width="90%" data-show-subtext="true" data-live-search="true" data-dropup-auto="false" style="color: black; text-align:center; width:90% !important; autofocus="autofocus">
<!--<option value=""></option>-->
<option disabled="disabled" selected>Select</option>
<?php $querytime=mysqli_query($con,"SELECT udt.id,udt.timebox,udt.timedigit,udt.roleid FROM updatetime udt");
while ($row=mysqli_fetch_array($querytime)) {
  ?>
  <option value="<?php echo htmlentities($row['timedigit']);?>" <?php if($row['timedigit']==$rowut['stoptime']) echo 'selected="selected"'; ?> ><?php echo htmlentities($row['timedigit']);?></option>

<?php
}
?>
</select></font></span></td>	
		
							
								
								
								
								<td style="text-align:center; vertical-align: middle;" align="center"><span><font face="Calibri" size="2" color="#000000"><select name="todaystatus[]" required="required" onChange="getCat(this.value);" style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0; color: black; width:85% !important; autofocus="autofocus" required="true">

<option value="">Select Status</option>
<!--<option disabled="disabled" selected>Select Status</option>-->
<?php $queryb=mysqli_query($con,"select cs.id,cs.movetstatus from currentstatus cs");
while ($row=mysqli_fetch_array($queryb)) {
  ?>
  <option value="<?php echo htmlentities($row['movetstatus']);?>" <?php if($row['movetstatus']==$rowut['todaystatus']) echo 'selected="selected"'; ?> ><?php echo htmlentities($row['movetstatus']);?></option>
<?php
}
?>
</select></font></span></td>						
		
		</tr>
													
                          
              </tbody>
			  
			  <?php $cnt=$cnt+1; } ?>
            </table>
			
			<div class="form-group">
			</div>
			<p style="text-align:center; vertical-align: middle; border: 1px solid orange" align="center"><i class="fa fa-info-circle" aria-hidden="true" style="color:red"></i> Are you sure to submit your Hourly Data finally? Just one more confirm <b style="color:red">Resource update at</b> (Select Hour) , <b style="color:black">Site ID</b>, <b style="color:black">Start Time</b>, <b style="color:black">Stop Time</b> and so on...</p>
						<div class="form-group">
						<div class="col-sm-10" style="padding-left:48% ">
						
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
						</div>
			</form>
          </div>
		  
		  
						</div><!-- /.col-md12-->
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		 
		 
		</div><!--/.main mysqli_close($con);-->
	<?php include_once('includes/footer.php');?>
	
	<!--<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>-->
	<!--<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>-->
	<!--<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
	<!--<script src="bootstrap/js/bootstrap-3.3.7.min.js"></script>-->
	
<script src="js/jquery-3.4.1.slim.min.js"></script>
<!--<script src="js/popper.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
	
<script src="bootstrap/js/jquery-3.5.1.min.js"></script>
					<script src="bootstrap/1.14.3/umd/popper.min.js"></script>
<!--<script src="bootstrap/4.1.3/js/bootstrap.min.js"></script>2-->
<script src="bootstrap/js/1.13.14/bootstrap-select.min.js"></script>
	
	
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>

	<!--<script src="bootstrap/1.12.4/js/jquery.min.js"></script>1-->
    <script src="bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="bootstrap/1.12.1/js/bootstrap-select.js"></script>
	


</body>
</html>
<?php mysqli_close($con);} ?>