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
$genericid=strtoupper($_POST['genericid']);
$siteCode=strtoupper($_POST['siteCode']);
$Priority=$_POST['Priority'];
$genSite=$_POST['genSite'];
$hubSite=$_POST['hubSite'];
$ConnectedSites=$_POST['ConnectedSites'];
$powerStatus=$_POST['powerStatus'];
$siteType=$_POST['siteType'];
$shareType=$_POST['shareType'];

$District=$_POST['District'];
$Thana=$_POST['Thana'];
$inHouseFlm=$_POST['inHouseFlm'];
$kvaGridNamethtw=$_POST['kvaGridNamethtw'];
$kvaGridNameoo=$_POST['kvaGridNameoo'];



$status=1;

$ret=mysqli_query($con,"SELECT * from tbluser AS usr where usr.id='$uid'");

$row=mysqli_fetch_array($ret);
$bloffice=$row['bloffice'];
$officeid=$row['officeid'];
$regionid=$row['regionid'];

//$query=mysqli_query($con,"insert into siteinfo(UserId,genericid,siteCode,shareType,Priority,genSite,bloffice,District,Thana,kvaGridNamethtw,kvaGridNameoo,ConnectedSites,siteType,powerStatus,inHouseFlm,hubSite,officeid,regionid,status) values('$uid','$genericid','$siteCode','$shareType','$Priority','$genSite','$bloffice','$District','$Thana','$kvaGridNamethtw','$kvaGridNameoo','$ConnectedSites','$siteType','$powerStatus','$inHouseFlm','$hubSite','$officeid','$regionid','$status')");
																  				
}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from siteinfo where id = '".$_GET['sid']."'");
                  $_SESSION['delmsg']="Site deleted. !!";
		  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<title>War Room - Sites</title>
	
	<script src="js/jquery-3.1.0.min.js"></script>
	<!--<<script src="js/jquery-2.2.0.min.js"></script>-->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="bootstrap/css/style-responsive.css" rel="stylesheet">
	
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
  
   <style type="text/css"> 

  /*#datable_rptA_wrapper horizontal scroll bar enable */
#datable_rptA.dataTables_wrapper {
	overflow: auto !important;
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
				<li class="active">Site Management</li>
			</ol>
		</div><!--/.row-->
		
		
				
					<div class="col-md-12">
						<div class="panel">
							<hr style="border: 1px solid orange">
						<!--<div class="panel-heading"style="line-height: 50%; margin-top: 0; margin-bottom: 0">Add Site</div>-->
						<div class="panel-head" style="line-height:0%; color:black">&nbsp;&nbsp;<em class="fa fa-plus">&nbsp;</em><strong>New Site Entry</strong></div>
						<!--<p style="line-height:0%; color:black"> &nbsp;&nbsp;<b><em class="fa fa-plus">&nbsp;</em>New Site Entry</b></p>-->
						
							<div class="panel-body">
									<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">X</button>
									<strong>Site added successfully.</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
									<?php } ?>							
										
								<form class="form-horizontal style-form" method="post" name="siteadd" enctype="multipart/form-data" style="line-height: 0%; margin-top: 0; margin-bottom: 0">	

								<table class="table table-striped display" style="white-space:nowrap;width:95%; line-height: 0%; margin-top: auto; margin-bottom: auto;text-align:center; vertical-align: auto;" align="center">
									
									<tbody>
										
										<tr>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label>Generic ID</label><input type="text" name="genericid" required="required" style="text-transform: uppercase" placeholder="e.g. BAR0092" value="" required="" class="form-control"></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label>Site Code</label><input type="text" name="siteCode" required="required" style="text-transform: uppercase" placeholder="e.g. BAR_X0092" value="" required="" class="form-control"></div></td>
											<td><div class="form-group"></div></td>	
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label>Connected Site</label><input type="text" name="ConnectedSites" required="required" style="text-transform: capitalize" placeholder="Number of Site (e.g. 5)" value="" required="" class="form-control"></div></td>
											<td><div class="form-group"></div></td>	
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label>32KV Grid Name</label><input type="text" name="kvaGridNamethtw" style="text-transform: capitalize" placeholder="Name of Grid Sub-Station" value="" required="" class="form-control"></div></td>
											<td><div class="form-group"></div></td>	
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label>11KV Grid Name</label><input type="text" name="kvaGridNameoo" style="text-transform: capitalize" placeholder="Name of Grid Sub-Station" value="" required="" class="form-control"></div></td>
											<td><div class="form-group"></div></td>	
										</tr>											
										<tr>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Priority</label><select name="Priority" required="required" onChange="getCat(this.value);" style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0;" class="form-control"><option value="">Select Priority</option><option value="Platinum-P1">Platinum-P1</option><option value="Gold-P1">Gold-P1</option><option value="P2">P2</option><option value="P3">P3</option></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Site Type</label><select name="siteType" class="form-control" onChange="getCat(this.value);" required="">
											<option value="">Select Type</option><?php $sql=mysqli_query($con,"SELECT DISTINCT si.siteType from siteinfo AS si ORDER BY si.siteType asc"); while ($row=mysqli_fetch_array($sql)) { ?> <option value="<?php echo htmlentities($row['siteType']);?>"><?php echo htmlentities($row['siteType']);?></option> <?php } ?></select></div></td>
											<td><div class="form-group"></div></td>	
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">In-House/FLM</label><select name="inHouseFlm" required="required" onChange="getCat(this.value);" style="margin-top:50; margin-bottom:0; margin-left:0; margin-right:0;" class="form-control"><option value="">Select Type</option><option value="In-House">In-House</option><option value="FLM">FLM</option></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Hub/Tx. Site</label><select name="hubSite" required="required" onChange="getCat(this.value);" style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0;" class="form-control"><option value="">Select Status</option><option value="Yes">Yes</option><option value="No">No</option></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">DG Site</label><select name="genSite" required="required" onChange="getCat(this.value);" style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0;" class="form-control"><option value="">Select Status</option><option value="Yes">Yes</option><option value="No">No</option></select></div></td>
											<td><div class="form-group"></div></td>
											
											
										</tr>
										
											<tr>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Power Status</label><select name="powerStatus" class="form-control" onChange="getCat(this.value);" required="">
											<option value="">Select Status</option><?php $sql=mysqli_query($con,"SELECT DISTINCT si.powerStatus from siteinfo AS si ORDER BY si.powerStatus asc"); while ($row=mysqli_fetch_array($sql)) { ?> <option value="<?php echo htmlentities($row['powerStatus']);?>"><?php echo htmlentities($row['powerStatus']);?></option> <?php } ?></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Share Type</label><select name="shareType" required="required" onChange="getCat(this.value);" style="margin-top:50; margin-bottom:0; margin-left:0; margin-right:0;" class="form-control"><option value="">Select Type</option><option value="BL Provider">BL Provider</option><option value="BL Seeker">BL Seeker</option><option value="NA">NA</option></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">District</label><select name="District" class="form-control" onChange="getCat(this.value);" required="required" required="">
											<option value="">Select District"</option><?php $sql=mysqli_query($con,"SELECT DISTINCT si.District from siteinfo AS si ORDER BY si.District asc"); while ($row=mysqli_fetch_array($sql)) { ?> <option value="<?php echo htmlentities($row['District']);?>"><?php echo htmlentities($row['District']);?></option> <?php } ?></select></div></td>
											<td><div class="form-group"></div></td>
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><label style="text-align:left; vertical-align: top;">Thana</label><select name="Thana" class="form-control" onChange="getCat(this.value);" required="required" required="">
											<option value="">Select Thana</option><?php $sql=mysqli_query($con,"SELECT DISTINCT si.Thana from siteinfo AS si ORDER BY si.Thana asc"); while ($row=mysqli_fetch_array($sql)) { ?> <option value="<?php echo htmlentities($row['Thana']);?>"><?php echo htmlentities($row['Thana']);?></option> <?php } ?></select></div></td>
											<td><div class="form-group"></div></td>
											
											<td style="text-align:center; vertical-align: middle;"><div class="form-group"><button type="submit" class="btn btn-primary has-success" style="margin:0; position: absolute;
											top: 82%;transform: translateY(-70%);-ms-transform: translateY(-70%); " name="submit">Submit</button></div></td>
											<td><div class="form-group"></div></td>
											
										</tr>
										
										
										
									</tbody>
									
									</table>



								</form>
							</div><!--panel-body table-->
							</div><!--panel-->					
					</div>	<!--col-md-12-->
				
<div class="container">	
	<div class="row">				
				<div class="col-md-12">	
					<div class="panel">
<br>
						<div class="panel-head" style="line-height:5%; color:black">&nbsp;&nbsp;<em class="fa fa-wrench">&nbsp;</em><strong>Manage Sites</strong></div>
						
							<div class="panel-body table">
								<!--<table class="datatable-1 table table-fit table-bordered display" style="white-space:wrap;width:100%;">-->
								<!--<table id="export" class="datatable-1 display responsive-table table table-fit table-bordered table-striped nowrap cell-border compact stripe" style="width:100%;">-->
									<table id="datable_rptA" class="datatable-1 display table table-fit table-bordered table-striped wrap cell-border compact stripe" style="width:100%;">	
									<thead>
										<tr><!-- Table Row & head-->
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Sl.No</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Generic ID</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Site Code</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Priority</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Office</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">RO</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">DG Site</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Hub/Tx Site</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Connected Site</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Power Status</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Site Type</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Share Type</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">In-House/ FLM</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">District</th>
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Thana</th>
											
											<th style="font-size:11px;text-align:center; vertical-align: middle;height:auto;">Edit/ Delete</th>
										</tr>
									</thead>
									<tbody>

<?php 
$uid=$_SESSION['warroomuid'];
$query=mysqli_query($con,"select si.id,si.genericid,si.siteCode,si.genSite,si.hubSite,si.shareType,si.Priority,si.inHouseFlm,si.postingDate,si.siteType,si.powerStatus,si.District,si.Thana,si.ConnectedSites,si.bloffice,si.regionid,si.updationDate,si.remarks from siteinfo as si LEFT JOIN tbluser usr ON si.status=usr.status where usr.id='$uid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>								
										<tr>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo $row['id'];?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['genericid']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['siteCode']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['Priority']);?></td>
											  <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['bloffice']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['regionid']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['genSite']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['hubSite']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['ConnectedSites']);?></font></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['powerStatus']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['siteType']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['shareType']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['inHouseFlm']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['District']);?></td>
											 <td style="font-size:11px;text-align:center; vertical-align: middle;" ><?php echo htmlentities($row['Thana']);?></td>		

																			
											
															
											
											<td style="text-align:center">
											<a href="updatesitersg.php?sid=<?php echo $row['id']?>" ><i class="icon-edit" style="color:orange"></i></a>
											<a href="add-site-rsg.php?sid=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete Site?')"><i class="icon-remove-sign" style="color:red"></i></a>
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
			/* "order" : [[0, "asc"]],*/

		"bJQueryUI": true,
        "bProcessing": true,
        "bSort": false,
        "bSortClasses": false,
        "bDeferRender": false,
		"orderable" : false,			
		"sPaginationType": "full_numbers", 	/* it details in style css file,*/					
			dom: "Bfrtip",
		
		"bPaginate":true,
		"info": true,
		"bInfo": true,
		"bAutoWidth":false,
		"bFilter":true,
		"bLengthChange": true,
			
		"buttons": [{text: 'export to Excel', extend:"excelHtml5", footer: true, className: "btn-primary", filename: 'War_Room_Site_Database',	
			exportOptions: {
						columns: ':visible',
						search: 'applied',
						order: 'applied',
					}
		  }], 
		
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-orange btn-md');},
			"sDom": "<'row'<'col-md-12'f>><'row'<'col-md-6'B>><'row'<'col-md-6'l>>rt<'row'<'col-xl-12'i>><'row'<'.datatable-1'>p>",
			/*"sDom": "B<'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-xl-12'i>><'row'<'.datatable-1'>p>",	*/
				"oLanguage": {"sSearch": "","sSearchPlaceholder": "Search records..." , "sLengthMenu":"Page Size:_MENU_"},
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		 		"iDisplayLength": 10,
			scrollX : 'TRUE',
	
		});
		
			});
	</script>
</body>
</html>
<?php mysqli_close($con);} ?>