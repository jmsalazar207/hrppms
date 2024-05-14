<?php include 'includes/hrppms_session.php'; ?>

<?php include 'includes/hrppms_header.php'; ?>
<?php include 'includes/hrppms_scripts.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/hrppms_navbar.php'; ?>
  <?php include 'includes/hrppms_menubar.php'; ?>
   <?php include 'includes/db_functions.php'; ?>
  <?php include 'includes/conn.php';

if(isset($_POST['btnUpdateYes'])){
  $Edit_LastName = strtoupper($_POST['txtEditLastName']);
  $Edit_FirstName = strtoupper($_POST['txtEditFirstName']);
  $Edit_MiddleName = strtoupper($_POST['txtEditMiddleName']);
  $Edit_ExtName = $_POST['txtEditExtName'];
  $Edit_Sex = $_POST['txtEditSex'];
  $Edit_Birthday = $_POST['txtEditBirthday'];
  $Edit_Age = $_POST['txtEditAge'];
  $Edit_Civil_Status = $_POST['txtEditCivilStatus'];
  $Edit_Citizenship = $_POST['txtEditCitizenship'];
  $Edit_EmailAddress = $_POST['txtEditEmailAddress'];
  $Edit_MobileNo = $_POST['txtEditContactNo'];
  $Edit_EmpNo = $_POST['txtEditEmpNo'];

  $Edit_Parenthetical = $_POST['txtEditParenthetical'];
  $Edit_Designation = $_POST['txtEditDesignation'];
  $Edit_DesignationDate = $_POST['txtDesignationDate'];
  $Edit_SpecialOrder = $_POST['txtEditSpecialOrder'];
  $Edit_OBSP = $_POST['txtEditOBSP'];
  $Edit_ModeAccession = $_POST['txtEditModeAccession'];
  $Edit_FilledUp = $_POST['txtEditDateFilledUp'];
  $Edit_OriginalAppointment = $_POST['txtEditDateOriginal'];
  $Edit_LastPromotion = $_POST['txtEditDatePromotion'];
  $Edit_FirstEntry = $_POST['txtEditDateFirstEntry'];  


  $conn -> query("UPDATE pds_personal_information SET surname = '$Edit_LastName', firstname = '$Edit_FirstName', middlename = '$Edit_MiddleName', name_extension = '$Edit_ExtName', sex = '$Edit_Sex', date_of_birth = '$Edit_Birthday', age = '$Edit_Age', civil_status = '$Edit_Civil_Status', citizenship = '$Edit_Citizenship', email_address = '$Edit_EmailAddress', mobile_no = '$Edit_MobileNo' WHERE empno ='$Edit_EmpNo'");
    
  $conn -> query("UPDATE userprofile SET parenthetical_code ='$Edit_Parenthetical', designation_code ='$Edit_Designation', designation_date ='$Edit_DesignationDate', special_order_code ='$Edit_SpecialOrder', obsp_code ='$Edit_OBSP', mode_accession_code ='$Edit_ModeAccession', date_filled_up ='$Edit_FilledUp', date_original_appointment ='$Edit_OriginalAppointment', date_last_promotion ='$Edit_LastPromotion', date_first_entry ='$Edit_FirstEntry'  WHERE empno ='$Edit_EmpNo'");

    echo "
        <script>
        alert('Employee Information Successfully Updated!');
        window.location = 'list_staff.php';
                </script>
    ";
  
;
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">  
                      <div class="box-header with-border">
                        <h4 class="box-title">List of Staff</h4>
                        <!-- <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Position</a> -->
                      </div>  
                    <div class="box-body">
                         <table id='tbl_output' class='table table-bordered table-striped dataTable text-center' style = 'width: 100%;'>
                              <thead>
                                <tr>
                                  <th>Employee Number</th>
                                  <th>Item Number</th>
                                  <th>Position Title</th>
                                  <th>Last Name</th>
                                  <th>First Name</th>
                                  <th>Middle Name</th>
                                  <th>Division</th>
                                  <th>Unit</th>
                                  <th>Office Location</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                            </table>
                    </div>
          </div>
        </div>
      </div>
  </section>
</div>
  <?php include 'modal/edit_staff_modal.php'?>
  <?php include 'includes/hrppms_footer.php' ?>
<script>
    $('#tbl_output').DataTable({
    'responsive': true,
    'processing': true,
    'serverSide': true,
    'pageLength': 20,
    'bLengthChange': false,
    'serverMethod': 'post',
    'stateSave': true,
    //'searching': false, // Remove default Search Control
    'ajax': {
        'url':'list_staff_ajax.php',
        'data': function(data){
    }
    },
    'columns': [
      { data: 'empno' },
      { data: 'item_code' },
      { data: 'position_name' },
      { data: 'surname' },
      { data: 'firstname' },
      { data: 'middlename' },
      { data: 'division_name' },
      { data: 'unit_name' },
      { data: 'station_name' },
      { data: 'action' },
    ]
  });

</script>
 
</body>
</html> 

