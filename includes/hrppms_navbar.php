
<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b>PPMS</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>HR </b>PPMS</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="#" class="notiifcation">
              <i class="fa fa-bell-o" title="Newly Registered Employee" id="NotifBell" name="NotifBell"></i>
              <span class="label label-danger" id="spantotal" name="spantotal" ><?=$total['total'];?></span>
            </a>
          </li>
          </ul>      
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo 'images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?= $user['firstname'].' '.$user['surname']; ?></span>
          </a>

          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo 'images/profile.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?= $user['firstname'].' '.$user['surname']; ?>
             </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="underconstruction.php" data-toggle="modal" class="btn btn-default btn-flat" id="profile1">User's Manual</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>

        </li>
      </ul>
    </div>
  </nav>
</header>
<script>
$( document ).ready(function() {
        $('.notiifcation').on('click', function(e){
            var spanvalue = $("#spantotal").text();
            if(spanvalue != 0){
              window.location.href = "list_new_employee.php";
            }else{
              
            }
        });
    });
  
</script>
