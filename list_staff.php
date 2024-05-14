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

    $oldItemCode = $_POST['txtHiddenItemNumber'];
    $newItemCode = $_POST['txtEditItemNumber'];

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
  $Promoted_Item_Code = $_POST['txtEditItemNumber'];
  if ($oldItemCode != $newItemCode) { 
    $PreviousPosition = $_POST['txtEditDateFilledUpLast'];
    $PromotedPosition = $_POST['txtPreviousPosition'];
    $conn -> query("INSERT INTO tbl_history (item_code, empno, date_started, date_end)VALUES('$oldItemCode','$Edit_EmpNo','$PreviousPosition','$PromotedPosition')");
    $conn -> query("UPDATE lib_position SET status_code = '2' WHERE item_code = '$oldItemCode'");
    $conn -> query("UPDATE lib_position SET status_code = '1' WHERE item_code = '$newItemCode'");
  }


  $conn -> query("UPDATE pds_personal_information SET surname = '$Edit_LastName', firstname = '$Edit_FirstName', middlename = '$Edit_MiddleName', name_extension = '$Edit_ExtName', sex = '$Edit_Sex', date_of_birth = '$Edit_Birthday', age = '$Edit_Age', civil_status = '$Edit_Civil_Status', citizenship = '$Edit_Citizenship', email_address = '$Edit_EmailAddress', mobile_no = '$Edit_MobileNo' WHERE empno ='$Edit_EmpNo'");
    
  $conn -> query("UPDATE userprofile SET item_code = '$Promoted_Item_Code', parenthetical_code ='$Edit_Parenthetical', designation_code ='$Edit_Designation', designation_date ='$Edit_DesignationDate', special_order_code ='$Edit_SpecialOrder', obsp_code ='$Edit_OBSP', mode_accession_code ='$Edit_ModeAccession', date_filled_up ='$Edit_FilledUp', date_original_appointment ='$Edit_OriginalAppointment', date_last_promotion ='$Edit_LastPromotion', date_first_entry ='$Edit_FirstEntry'  WHERE empno ='$Edit_EmpNo'");

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
                    <div class="box-body table-responsive">
                         <table id='tbl_output' class='table table-bordered table-striped dataTable text-center' style = 'width: 100%;'>
                              <thead>
                                <tr>
                                  <th>Employee Number</th>
                                  <th>Item Number</th>
                                  <th>Position Title</th>
                                  <th>Last Name</th>
                                  <th>First Name</th>
                                  <th>Middle Name</th>
                                  <!-- <th>Division</th>
                                  <th>Unit</th>
                                  <th>Office Location</th> -->
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
      { data: 'action' },
    ],
         'columnDefs': [ {
        'targets': [6], //Yung Action
        'orderable': false,
     }]
  });
    function modalCloseConfirm(){      
      $('#confirm_edit').modal('hide');
      
    };

    function modalCloseDate(process){
      if(process == close){
        $('#confirm_date').modal('hide');
      }else{
        var date_promoted = $('#txtPromotedPosition').val();
        var date_ended = $('#txtPreviousPosition').val(); // for history

        if(date_promoted && date_ended)
        {
          //  $('#txtEditLastName').val("GACUSANSS");
           $('#txtEditDateFilledUp').val(date_promoted);
           $('#txtEditDatePromotion').val(date_promoted);
           $('#confirm_date').modal('hide');
        }else{
          alert("Please Select Both Date");
        }
      }

    };
 function modalEdit(val) {
       var item_code = val;

        jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{item_code:item_code},
          success:function(data){
            /*var no = JSON.stringify(data);*/
              var staff = JSON.parse(data);
                    
              jQuery("#txtEditLastName").val(staff["surname"]);
              jQuery("#txtEditFirstName").val(staff["firstname"]);
              jQuery("#txtEditMiddleName").val(staff["middlename"]);
              jQuery("#txtEditAge").val(staff["age"]);
              jQuery("#txtEditEmailAddress").val(staff["email_address"]);
              jQuery("#txtEditContactNo").val(staff["mobile_no"]);
              jQuery("#txtEditDateFilledUp").val(staff["date_filled_up"]);
              jQuery("#txtEditDateFilledUpLast").val(staff["date_filled_up"]);
              jQuery("#txtEditDateOriginal").val(staff["date_original_appointment"]);
              jQuery("#txtEditDatePromotion").val(staff["date_last_promotion"]);
              jQuery("#txtEditDateFirstEntry").val(staff["date_first_entry"]);
              /*jQuery("#txtEditItemNumber").val(staff["item_code"]);*/
              jQuery("#txtEditBirthday").val(staff["date_of_birth"]);
              jQuery("#txtDesignationDate").val(staff["designation_date"]);
              jQuery("#txtEditEmpNo").val(staff["empno"]);
              jQuery("#txtEditDivisionName").val(staff["division_name"]);
              jQuery("#txtEditUnitName").val(staff["unit_name"]);
              jQuery("#txtEditOLOS").val(staff["station_name"]);
              jQuery("#txtEditDateCreation").val(staff["date_creation_position"]);
              jQuery("#txtEditPositionTitle").val(staff["position_name"]);
              jQuery("#txtEditPositionLevel").val(staff["position_level"]);
              jQuery("#txtEditIncrement").val(staff["increment"]);
              jQuery("#txtEditGrade").val(staff["grade"]);
              jQuery("#txtEditSalary").val(number_format_js(staff["salary"],','));
              jQuery("#txtEditFundSource").val(staff["fund_source_name"]);
              jQuery("#txtEditEmployment").val(staff["employment_name"]);
              jQuery("#txtHiddenItemNumber").val(staff["item_code"]);
              
              
              var item_number = staff["item_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{item_number:item_number},
                  success:function(data){
                      jQuery('#txtEditItemNumber').html(data);
                  }
              });              
              var extname = staff["name_extension"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{extname:extname},
                  success:function(data){
                      jQuery('#txtEditExtName').html(data);
                  }
              });
              var sex = staff["sex"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{sex:sex},
                  success:function(data){
                      jQuery('#txtEditSex').html(data);
                  }
              });              
              var civil_status_code = staff["civil_status"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{civil_status_code:civil_status_code},
                  success:function(data){
                      jQuery('#txtEditCivilStatus').html(data);
                  }
              });              
            var citizenship_code = staff["citizenship"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{citizenship_code:citizenship_code},
                  success:function(data){
                      jQuery('#txtEditCitizenship').html(data);
                  }
              });
            var parenthetical_code = staff["parenthetical_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{parenthetical_code:parenthetical_code},
                  success:function(data){
                      jQuery('#txtEditParenthetical').html(data);
                  }
              });
            var designation_code = staff["designation_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{designation_code:designation_code},
                  success:function(data){
                      jQuery('#txtEditDesignation').html(data);
                  }
              });
            var special_order_code = staff["special_order_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{special_order_code:special_order_code},
                  success:function(data){
                      jQuery('#txtEditSpecialOrder').html(data);
                  }
              }); 
            var obsp_code = staff["obsp_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{obsp_code:obsp_code},
                  success:function(data){
                      jQuery('#txtEditOBSP').html(data);
                  }
              });
            var mode_accession_code = staff["mode_accession_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{mode_accession_code:mode_accession_code},
                  success:function(data){
                      jQuery('#txtEditModeAccession').html(data);
                  }
              });                                           

              jQuery("#modalEdit").modal("show");
          }
      });
   }
 jQuery("#txtEditItemNumber").on('change',function(){
      var ItemCode = jQuery(this).val();
      let ItemNumberAction = 'ItemNumberAction';
      jQuery.ajax({
        url:"includes/db_functions.php",
        method:"POST",
        data:{ItemNumberAction:ItemNumberAction, ItemCode:ItemCode},
        success:function(data){
          var json_data = JSON.parse(data);
          jQuery('#txtEditDivisionName').val(json_data.division_name);
          jQuery('#txtEditUnitName').val(json_data.unit_name);
          jQuery('#txtEditOLOS').val(json_data.station_name);
          jQuery('#txtEditDateCreation').val(json_data.date_creation_position);
          jQuery('#txtEditPositionTitle').val(json_data.position_name);
          jQuery('#txtEditPositionLevel').val(json_data.position_level);
          jQuery('#txtEditGrade').val(json_data.grade);
          jQuery('#txtEditIncrement').val(json_data.increment);
          jQuery('#txtEditSalary').val(json_data.salary);
          jQuery('#txtEditFundSource').val(json_data.fund_source_name);
          jQuery('#txtEditEmployment').val(json_data.employment_name);         
        }

        });
      jQuery('#confirm_date').modal('show')

    });
</script>
 
</body>
</html> 

