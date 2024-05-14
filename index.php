<?php
  	session_start();
  	if(isset($_SESSION['user_id'])){
    	header('location:hrppms_home.php');
  	}
?>
<style>
  form i {
    margin-left: -0px;
    cursor: pointer;
}
</style>

<?php include 'includes/hrppms_header.php'; ?>
<html>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<b>HRPPMS - MODULE</b>
  	</div>
  	<div class="login-box-body">
    	<p class="login-box-msg">Admin Login</p>
    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="input-group has-feedback">
            <input type="password" class="form-control" name="password" id = "password" placeholder="Password" required>
            <span class="input-group-addon"><i class="fa fa-eye-slash toggle-password " toggle = "#password"  id="togglepassword"></i></span>
          </div>
          <br>

            <div class="g-recaptcha" data-sitekey="6Lc-IEwhAAAAAFCni3p5_9NyjkIvr9XxGclxWRDO"></div>

            <br>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" name="submit" class="btn btn-primary  btn-block btn-flat" >Login</button>
				</div>
      		</div>
      </form>
                <div class="row">
            <div class="col-xs-12">
              <label>Click <a href="new_employee.php">HERE</a> for new Employee</label>
            </div>
          </div>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/hrppms_scripts.php' ?>
<!--Code for OLD PASSWORD-->
<script>
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>
<!--End Code for OLD PASSWORD-->
</body>
</html>