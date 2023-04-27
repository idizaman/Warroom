  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['warroomuid']==0)) {
  header('location:logout.php');
  } else{
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{

$uid=$_SESSION['warroomuid'];
$genitemcode=$_POST['itemcode'];
$gentype=$_POST['gentype'];
$gensource=$_POST['gensource'];
$genslno=$_POST['genslno'];
$gencondition=$_POST['gencondition'];
$flmoffice=$_POST['flmoffice'];
$status=1;

$ret=mysqli_query($con,"SELECT * from tbluser AS usr left JOIN territory AS trr ON usr.officeid=trr.officeid where usr.id='$uid'");

$row=mysqli_fetch_array($ret);
$bloffice=$row['bloffice'];
$officeid=$row['officeid'];
$regionid=$row['regionid'];

$query=mysqli_query($con,"insert into resourse(UserId,bloffice,flmoffice,gentype,gensource,genslno,gencondition,officeid,regionid,status) values('$uid','$bloffice','$flmoffice','$gentype','$gensource','$genslno','$gencondition','$officeid','$regionid','$status')");
}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from resourse where id = '".$_GET['rid']."'");
                  $_SESSION['delmsg']="Resourse deleted !!";
		  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>War Room</title>
	
	<script src="js/jquery-3.1.0.min.js"></script>
	<!--<<script src="js/jquery-2.2.0.min.js"></script>-->
	
	<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap-3.3.7.min.js"></script>

	<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
	<link href="bootstrap/css/table-responsive.css" rel="stylesheet">
	<link href="scripts/datatables/datatables.min.css" rel="stylesheet">
	<link href="scripts/datatables/datatables.css" rel="stylesheet">
	<link href="scripts/datatables/js/datatables.min.js" rel="stylesheet">
	

	
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	
	
<script src="js/jquery-3.4.1.slim.min.js"></script>
<!--<script src="js/popper.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
	
	<meta http-equiv="refresh" content="600; url="<?php echo $_SERVER['PHP_SELF']; ?>" />
	<meta http-equiv="refresh" content="900;url=logout.php"/>

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
    width: 35%;
}
 
.right-col {
    float: left;
    width: 55%;
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
				<li class="active">PG/DGoW resource Entry.</li>
			</ol>
		</div><!--/.row-->
		
		
				
					<div class="col-md-12">
						<div class="panel">
							<hr style="border: 1px solid orange">
						<div class="panel-heading"style="line-height: 50%; margin-top: 0; margin-bottom: 0">Add Resource</div>
						
						
							<!--<hr style="border: 1px solid orange">-->
							
							<div class="panel-body">
							
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">X</button>
									<strong>Resource data has been added successfully.</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

							
<form class="form-horizontal style-form" method="post" name="resourse" enctype="multipart/form-data" style="line-height: 50%; margin-top: 0; margin-bottom: 0">	

<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">Generator Type</label>
<div class="col-sm-4">
<select name="gentype" id="gentype" class="form-control" onChange="getCat(this.value);" required="">
<option value="">Select Type</option>
<?php $sql=mysqli_query($con,"select id,gentypename from gentype");
while ($row=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($row['gentypename']);?>"><?php echo htmlentities($row['gentypename']);?></option>
<?php
}
?>
</select>
 </div>
 </div>


<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">Generator Source</label>
<div class="col-sm-4">
<select name="gensource" id="gensource" class="form-control" onChange="getCat(this.value);" required="">
<option value="">Select Source</option>
<?php $sql=mysqli_query($con,"select id,gensourcename from gensource");
while ($row=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($row['gensourcename']);?>"><?php echo htmlentities($row['gensourcename']);?></option>
<?php
}
?>
</select>
 </div>
</div>

<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">Generator Number</label>
<div class="col-sm-4">
<input type="text" name="genslno" required="required" style="text-transform: uppercase" placeholder="Enter Gen no (e.g. PG-01 or DG-01)" value="" required="" class="form-control">
</div>

</div>


<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">Functional-Condition</label>
<div class="col-sm-4">
<select name="gencondition" id="gencondition" class="form-control" onChange="getCat(this.value);" required="">
<option value="">Select Condition</option>
<?php $sql=mysqli_query($con,"select id,genfunctionalcondition from genfunctional");
while ($row=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($row['genfunctionalcondition']);?>"><?php echo htmlentities($row['genfunctionalcondition']);?></option>
<?php
}
?>
</select>
 </div>
 </div>



<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">FLM Office<br><p style="line-height: 100%; margin-top:0; margin-bottom:0; color:orange"><font face="Calibri" size="2">(Not applicable for In-House)</font></p></label>
<div class="col-sm-4">
<select name="flmoffice" id="flmoffice" class="form-control" placeholder="Select FLM Office" onChange="getCat(this.value);" required="">
<option value="">Select FLM Office</option>
<option value="In-House">Not Applicable</option>
<?php $sql=mysqli_query($con,"select * from tbluser as usr LEFT JOIN flmoffice as flo ON usr.officeid=flo.officeid where usr.id='$uid'");
while ($row=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($row['flmoffice']);?>"><?php echo htmlentities($row['flmoffice']);?></option>
<?php
}
?>
</select>
 </div>
 </div>
   

<div class="form-group">
<div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
<br>
</div>
								</form>
							</div><!--panel-body table-->
						</div>	<!--panel-->					
					</div>	<!--col-md-12-->
				
	<div class="container">	
	<div class="row">				
				<div class="col-md-12">	
					<div class="panel">

						<div class="panel-heading">Manage Resource</div>
						
							<div class="panel-body table">
								<!--<table class="datatable-1 table table-bordered table-striped display" style="white-space:nowrap; width:100%;">-->
								<table id="export" class="datatable-1 display responsive-table table table-fit table-bordered table-striped nowrap cell-border compact stripe" style="width:100%;">
									<thead>
										<tr>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">SL.#</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">BL<br>Office</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">FLM<br>Office</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Gen.<br>Type</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Gen.<br>Source</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Gen.<br>No</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Functional<br>Condition</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Posting date</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Last Updated</font></th>
											<th style="text-align:center; vertical-align: middle;" ><font face="Calibri Light" size="2">Edit & Delete</font></th>
										</tr>
									</thead>
									<tbody>

<?php 
$uid=$_SESSION['warroomuid'];
$query=mysqli_query($con,"SELECT rs.id,rs.bloffice,rs.flmoffice,rs.gentype,rs.gensource,rs.genslno,rs.gencondition,rs.postingDate,rs.updationDate from resourse as rs ORDER BY rs.id asc");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>								
										<tr>
											
											<!--<td style="text-align:center"><font face="Calibri Light" size="2"><?php //echo htmlentities($cnt);?></font></td>-->
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($cnt);?></font></td>
											<!--<td style="text-align:center"><font face="Calibri Light" size="2"><?php //echo htmlentities($row['id']);?></font></td>-->
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['bloffice']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['flmoffice']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['gentype']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['gensource']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['genslno']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['gencondition']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['postingDate']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['updationDate']);?></font></td>
																										
											<td style="text-align:center">
											<a href="updateresourse-rsg.php?rid=<?php echo htmlentities($row['id']);?>" data-toggle="tooltip" data-original-title="Edit"><i class="icon-edit" style="color:orange"></i></a><font style="color:white"> |<>| </font>
											<a href="add-resourse-rsg.php?rid=<?php echo htmlentities($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to Delete this Resource?')"><i class="icon-remove-sign" style="color:red"></i></a>
											</td>
											
										</tr>
										<?php $cnt=$cnt+1; } ?>
									</tbody>
								</table>
							</div><!--panel-body table-->
						</div>	<!--panel-->					
					</div>	<!--col-md-12-->
	</div><!-- /.row -->	
	</div>	
				
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
	
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable({
				"order" : [[0, "asc"]],
				
				dom: "Bfrtip","buttons": [
            {extend:"excelHtml5"},
            {extend: "csvHtml5"}
         	],
	            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
			});
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		});
	</script>
</body>
</html>
<?php mysqli_close($con);} ?>