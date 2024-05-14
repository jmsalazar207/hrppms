

<?php
  include 'includes/conn.php';

  $quserlevel = $conn->query("SELECT * FROM `pds_personal_information` WHERE `empno` = '$_SESSION[user_id]'") or die(mysqli_error());
  $fuserlevel = $quserlevel->fetch_array();
  

?>
<style>
    .sidebar-menu, .main-sidebar .user-panel, .sidebar-menu>li.header {
        white-space: normal;
    }
  </style>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo 'images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['surname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN</li>
      <li class=""><a href="hrppms_home.php"><i class="fa fa-home"></i> <span>HOME</span></a></li>
      <li class=""><a href="list_staff.php"><i class="fa fa-list-alt"></i> <span>List of Staff</span></a></li>
      <li class=""><a href="list_position.php"><i class="fa fa-th-list"></i> <span>Position</span></a></li>          
      <li class="header">MANAGE DROPDOWN MENU</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">          
      <li class=""><a href="list_division.php"><i class="fa fa-list"></i>Division</a></li>
      <li class=""><a href="list_unit.php"><i class="fa fa fa-list"></i>Unit</a></li>
      <!-- <li class=""><a href=".php"><i class="fa fa-list"></i>Position</a></li> -->
      <li class=""><a href="list_designation.php"><i class="fa fa-list"></i>Designation</a></li>
      <li class=""><a href="list_employment_status.php"><i class="fa fa-list"></i>Classification of Status</a></li> 
      <!-- <li class=""><a href="list_status.php"><i class="fa fa-list"></i>Status(Filled/Unfilled)</a></li> -->
      <li class=""><a href="list_parenthetical.php"><i class="fa fa-list"></i>Parenthetical Title</a></li>
      <li class=""><a href="list_fund_source.php"><i class="fa fa-list"></i>Fund Source</a></li>
      <li class=""><a href="list_mode_accession.php"><i class="fa fa-list"></i>Mode of Accession</a></li>
      <li class=""><a href="list_special_order.php"><i class="fa fa-list"></i>Special Order Number</a></li>
      <li class=""><a href="list_station.php"><i class="fa fa-list"></i>Office Location/ Official Station</a></li>
      <li class=""><a href="list_obsp.php"><i class="fa fa-list"></i>Office/ Bureau/ Service/ Program</a></li>    
    </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-wrench"></i>
          <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu"> 
      <li class=""><a href="logout.php"><i class="fa fa-circle-o"></i> Log-Out</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>


