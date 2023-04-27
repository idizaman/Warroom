  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['warroomuid']==0)) {
  header('location:logout.php');
  } else{
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );


if(isset($_POST['submit']))
{
	$loginid=$_POST['loginid'];
	$password=$_POST['password'];
	$newpassword=$_POST['newpassword'];
	$sql=mysqli_query($con,"select password from tbluser where password='".$_POST['password']."' && id='".$_SESSION['warroomuid']."'");
   $num=mysqli_fetch_array($sql);  
if($num>0)
{
 $con=mysqli_query($con,"update tbluser set password='$newpassword',LastPassUpdate='$currentTime' where id='".$_SESSION['warroomuid']."'");
$_SESSION['msg']="Password Changed Successfully !!!";
}
else
{
$_SESSION['msg']="Old Password not match. Please Try again.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="600; url="<?php echo $_SERVER['PHP_SELF']; ?>" />

	<title>War Room || Change Password</title>
	
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
  
	<meta http-equiv="refresh" content="900;url=logout.php"/>
	
  
	 
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>

</head>
<body>

<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
	
	
	<div class="wrapper">
		
		
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="user-profile.php"><em class="fa fa-home"></em></a></li>
				<li class="active">Change Password.</li>
			</ol>
		</div><!--/.row-->
			
			<div class="col-md-12">	
					<div class="panel">
					<hr style="border: 1px solid orange">
						<div class="panel-heading" style="padding-left:20%"><em class="fa fa-key">&nbsp;</em>Change Password</div>
						<div class="panel-body table">
			
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<div class="col-lg-12">
                                                <div class="all-form-element-inner">
                                                    
                                                    <form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
                                                      
                                                        <div class="form-group-inner has-feedback">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Current Password:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                  <input type="password" placeholder="Enter your current Password"  name="password" class="form-control" value=""  required="true">
                                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
																</div>
                                                            </div>
                                                        </div>
                                                        <div><br></div>
														
														
														
														<div class="form-group-inner has-feedback">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">New Password:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input type="password" placeholder="Enter your new current Password"  name="newpassword" class="form-control" value=""  required="true">
                                                               		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
																</div>
                                                            </div>
                                                        </div>
														 <br>
                                                         <div class="form-group-inner has-feedback">
                                                       	<div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Confirm Password:</label>
                                                                </div>

                                                             <div class="col-lg-9">
																	<input type="password" placeholder="Enter your new Password again"  name="confirmpassword" class="form-control" value="" required="true">
																	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
															 </div>	
                                                            </div>
															
                                                        </div>
                                                      
													  <br>
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                         <!--<button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Save Change</button>-->
																		 <button class="btn btn-primary btn-block btn-flat" type="submit" name="submit">Save Change</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


									</div>
							</div><!--panel-body table-->
						</div>	<!--panel-->					
					</div>	<!--col-md-12-->

			</div><!--/.main-->
		
	</div><!--/.wrapper-->				
<?php include_once('includes/footer.php');?>
	
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/datatables.min.js"></script>
	<script src="scripts/datatables/js/jquery.dataTables.min.js"></script>
	<script src="scripts/datatables/js/dataTables.buttons.min.js"></script>
	<script src="scripts/datatables/js/jszip.min.js"></script>
	<script src="scripts/datatables/js/buttons.html5.min.js"></script>
</body>
</html>
<?php mysqli_close($con);} ?>