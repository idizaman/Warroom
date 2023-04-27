  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['warroomuid']==0)) {
  header('location:logout.php');
  } else{



if(isset($_POST['submit']))
{

$uid=$_SESSION['warroomuid'];
$officename=$_POST['officename'];
$officedescription=$_POST['officedescription'];
$ret=mysqli_query($con,"select * from tbluser as usr
LEFT JOIN territory as trr ON usr.officeid=trr.officeid where usr.id='$uid';");
$row=mysqli_fetch_array($ret);
$officeid=$row['officeid'];
$regionid=$row['regionid'];
$bloffice=$row['bloffice'];
$status=$row['status'];
$query=mysqli_query($con,"insert into territory(UrerId,officeName,bloffice,officedescription,officeid,regionid,status) values('$uid','$officename','$bloffice','$officedescription','$officeid','$regionid','$status')");

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from territory where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Office info deleted !!";
		  }

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	
	<title>War room Support</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
			<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
			<link href="bootstrap/css/table-responsive.css" rel="stylesheet">
			<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<!--Custom Font
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>-->
	
	
  
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>


	<div class="wrapper">	
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="#"><em class="fa fa-home"></em></a></li>
				<li class="active">Office information Entry.</li>
			</ol>
		</div><!--/.row-->
		
		
				
					<div class="col-md-12">
						<div class="panel">
						<div class="panel-heading">Add Office</div>
							
							<div class="panel-panel">
							
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>
			
							
								<form class="form-horizontal style-form" method="post" name="resourse" enctype="multipart/form-data" >	

<div class="form-group align-self-center">
<label class="col-sm-2 col-sm-2 control-label">Office Name</label>
<div class="col-sm-4">
<input type="text" placeholder="Enter O&M Office Name"  name="officename" class="form-control" required="">
 </div>
 </div>

 <div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">ZM info</label>
<div class="col-sm-4">
<input type="text" placeholder="Enter Name & Mobile no"  name="officedescription" class="form-control" required="">
 </div>
 </div>

   

<div class="form-group">
<div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
<br>
</div>


									</form>
							</div>
						</div>
					</div>
				
				
				<div class="col-md-12">	
					<div class="panel">

						<div class="panel-heading">Manage Office</div>
						
							<div class="panel-body table">
								<table class="datatable-1 table table-bordered table-striped display" style="white-space:nowrap;width:100%;">
									<thead>
										<tr>
											<th style="text-align:center"><font face="Calibri Light" size="2">Sl.#</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">BL Office</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">FLM Office</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">ZM info.</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">office ID #</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">Region_ID</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">Posting date</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">Last Updated</font></th>
											<th style="text-align:center"><font face="Calibri Light" size="2">Action</font></th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from tbluser as usr
LEFT JOIN territory as trr ON usr.officeid=trr.officeid where usr.id='$uid';");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($cnt);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['bloffice']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['flmoffice']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['officeDescription']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['officeid']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['regionid']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['postingDate']);?></font></td>
											<td style="text-align:center"><font face="Calibri Light" size="2"><?php echo htmlentities($row['updationDate']);?></font></td>
																											
											<td style="text-align:center">
											<a href="#?id=<?php echo $row['id']?>"><i class="icon-edit"></i></a>
											<a href="#?id=<?php echo $row['id']?>"<i class="icon-remove-sign"></i></a>
											</td>
											
										</tr>
										<?php $cnt=$cnt+1; } ?>
									<tbody>
								</table>
							</div><!--panel-body table-->
						</div>	<!--panel-->					
					</div>	<!--col-md-12-->
				
				
	</div><!--/.main-->
	</div><!--/.wrapper-->
	
	<?php include_once('includes/footer.php');?>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
	

    <!--script for this page-->
	
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span/>');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
</html>
<?php mysqli_close($con);} ?>