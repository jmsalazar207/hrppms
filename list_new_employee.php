<?php include 'includes/hrppms_session.php'; ?>
<?php include 'includes/hrppms_header.php'; ?>

<?php include 'includes/hrppms_scripts.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/hrppms_navbar.php'; ?>
  <?php include 'includes/hrppms_menubar.php'; ?>
   <?php include 'includes/db_functions.php'; ?>
  <?php 
  include 'includes/conn.php'; 
if(isset($_POST['btnUpdateYes'])){
  $Edit_EmpNo=$_POST['txtEditEmpNo'];
  $Edit_FilledUp=$_POST['txtEditDateFilledUp'];
  $Edit_OriginalAppointment=$_POST['txtEditDateOriginal'];
    $Edit_FirstEntry=$_POST['txtEditDateFirstEntry'];  
  $Edit_Parenthetical=$_POST['txtEditParenthetical'];
  $Edit_Item_Code=$_POST['txtEditItemCode'];
  $Edit_Designation=$_POST['txtEditDesignation'];
  $Edit_DesignationDate=$_POST['txtDesignationDate'];
  $Edit_SpecialOrder=$_POST['txtEditSpecialOrder'];
  $Edit_OBSP=$_POST['txtEditOBSP'];
  $Edit_ModeAccession=$_POST['txtEditModeAccession'];
  $conn -> query("UPDATE userprofile SET item_code = '$Edit_Item_Code', parenthetical_code ='$Edit_Parenthetical', designation_code ='$Edit_Designation', designation_date ='$Edit_DesignationDate', special_order_code ='$Edit_SpecialOrder', obsp_code ='$Edit_OBSP', mode_accession_code ='$Edit_ModeAccession', date_filled_up ='$Edit_FilledUp', date_original_appointment ='$Edit_OriginalAppointment', date_first_entry ='$Edit_FirstEntry', updated = '1'  WHERE empno ='$Edit_EmpNo'");

    echo "
        <script>
        alert('Employee Information Successfully Updated!');
        window.location = 'list_staff.php';       
                </script>
    ";
  
};

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">  
                      <div class="box-header with-border">
                        <h4 class="box-title">List of Newly Registered Employee</h4>
                        <!-- <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Position</a> -->
                      </div>  
              <div class="box-body">
                   <table id='tbl_output' class='table table-bordered table-striped dataTable text-center'>
                      <thead>
                        <tr>
                            <th>Employee Number</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Extension Name</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                    </table>
          </div>
        </div>
      </div>
    </section>
    <!--End Main Content-->
</div>

  <?php include 'includes/hrppms_footer.php'; ?>
  <?php include 'modal/edit_newly_registered_modal.php'?>
  <script>  //kapag meg select add division
        $('#tbl_output').DataTable({
            'responsive': true,
            'processing': true,
            'serverSide': true,
            'pageLength': 20,
            'bLengthChange': false,
            'serverMethod': 'post',
            'stateSave': true,            
                'ajax': {
        'url':'list_new_employee_ajax.php',
        'data': function(data){
                              }
                        },
            'columns':[
            { data: 'empno' },
            { data: 'surname' },
            { data: 'firstname' },
            { data: 'middlename' },
            { data: 'name_extension' },
            { data: 'action' },
                      ],
            'columnDefs': [{
            'targets': [5], //Yung Action
            'orderable': false,
                          }]
            });

        function modalEdit(val)
        {
        
        jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{empno:val},
          success:function(data){
              var empnovalue = JSON.parse(data);
              jQuery("#txtEditEmpNo").val(empnovalue["empno"]);
              jQuery("#txtEditLastName").val(empnovalue["surname"]);
              jQuery("#txtEditFirstName").val(empnovalue["firstname"]);
              jQuery("#txtEditMiddleName").val(empnovalue["middlename"]);
              jQuery("#txtEditExtName").val(empnovalue["name_extension"]);
                                }
                    });
        jQuery("#modalEdit").modal("show");
        }
</script>
</body>
</html>

