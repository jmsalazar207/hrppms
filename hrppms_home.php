<?php include 'includes/hrppms_session.php'; ?>

<?php include 'includes/hrppms_header.php'; ?>

<html>
<style>
    

/*body{
	font: 100%/1.85em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
}*/
</style>


<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
	<?php include 'includes/hrppms_scripts.php'; ?>
	<?php include 'includes/hrppms_navbar.php'; ?>
	<?php include 'includes/hrppms_menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Home
		  </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
							</ol>
		</section>
    
	<!-- Main content -->
    <section class="content">
		<?php
			if(isset($_SESSION['error'])){
				echo "
				<div class='alert alert-danger alert-dismissible'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-warning'></i> Error!</h4>
				".$_SESSION['error']."
				</div>
				";
			unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
				echo "
					<div class='alert alert-success alert-dismissible'>
					  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					  <h4><i class='icon fa fa-check'></i> Success!</h4>
					  ".$_SESSION['success']."
					</div>
				  ";
			unset($_SESSION['success']);
			}
		?>
      
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<img src = "images/hrmis.jpg" height = "750px" width = "100%" />
					</div>
				</div>
			</div>
		</div>
    </section>   
	</div>
    
  <?php include 'includes/hrppms_footer.php'; ?>
	

	

 
</div>





</body>
</html>
