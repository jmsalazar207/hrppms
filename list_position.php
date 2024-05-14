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
  $Edit_Pos_Code = $_POST['txtEditPositionCode'];
  $Edit_Item_Code = strtoupper($_POST['txtEditItemCode']);  
  $Edit_Station_Code = $_POST['txtEditStation'];
  $Edit_Div_Code = $_POST['txtEditDivision'];
  $Edit_Unit_Code = $_POST['txtEditUnit'];
  $Update_Position_SQL = "UPDATE lib_position SET division_code = '$Edit_Div_Code', unit_code = '$Edit_Unit_Code', station_code = '$Edit_Station_Code' WHERE position_code='$Edit_Pos_Code'";
  if(mysqli_query($conn,$Update_Position_SQL)==true){
    echo "
        <script>
        alert('Position Details Successfully Updated!');
        window.location = 'list_position.php';
                </script>
    ";
  }
  else{
          echo "
        <script>
        alert('Updating unsuccessful!');
        window.location = 'list_position.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $data = [];
  foreach($_POST as $key=>$value){
    $data[$key] = strip_tags($value);
  }
  $Add_Pos_Name = strtoupper($data['txtAddPositionName']);
  $Add_Item_Code = strtoupper($data['txtAddItemCode']);
  $Add_Div_Code = $data['txtAddDivision'];
  $Add_Unit_Code = $data['txtAddUnit'];
  $Add_Employment = $data['txtAddEmploymentStatus'];
  $Add_Status = 2; 
  $Add_Fund_Source = $data['txtAddFundSource'];
  $Add_Created_Date = $data['txtAddCreatedDate'];
  $Added_By = $_SESSION['user_id']; 
  $Add_Grade = $data['txtAddSalaryGrade'];
  $Add_Increment = $data['txtAddStepIncrement'];
  $Add_SalaryId = $data['txtSalaryId'];
  $Add_Position_Level = $data['txtAddPositionLevel'];
  $Add_Station_Code = $data['txtAddPositionStation'];


  $Add_New_Pos_Output = $conn -> query("SELECT * from `lib_position` WHERE `item_code` = '$Add_Item_Code'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Pos_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Position Already Exists!");
    window.location = "list_position.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_position (position_code,position_name,item_code,added_by,division_code,unit_code,status_code,employment_id,fund_source_code,date_creation_position,station_code,position_level) 
    VALUES('','$Add_Pos_Name','$Add_Item_Code','$Added_By','$Add_Div_Code','$Add_Unit_Code','$Add_Status','$Add_Employment','$Add_Fund_Source','$Add_Created_Date','$Add_Station_Code','$Add_Position_Level')");

   $conn -> query("INSERT INTO lib_position_salary (item_code, salary_id) 
    VALUES('$Add_Item_Code',$Add_SalaryId)");

  echo '
    <script>
    alert("New Position Successfully Added!");
    window.location = "list_position.php"
  </script>
  ';
;
}
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
              <h4 class="box-title">List of Position</h4>
              <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Position</a>
            </div>  
            <div class="box-body table-responsive">
              <table  id='tbl_output' class='table table-bordered table-striped dataTable text-center' style = 'width: 100%;'>
                <thead>
                  <tr>
                    <th>Division</th>
                    <th>Unit</th>
                    <th>Office Location/Official Station</th>
                    <th>Item Code</th>
                    <th>Position Name</th>
                    <th>Salary Grade</th>
                    <th>Position level</th>
                    <th>Monthly Salary</th>
                    <th>Employment Status</th>
                    <th>Fund Source</th>
                    <th>Date Created</th> 
                    <th>Status(filled/Unfilled)</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
          </div>
        </div>
      </div>
    </div>
    </section>
    <!--End Main Content-->
</div>
  <?php include 'modal/add_position_modal.php'?>
  <?php include 'modal/edit_position_modal.php'?>
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
        'url':'list_position_ajax.php',
        'data': function(data){
    }
    },
    'columns': [
      { data: 'division_name' },
      { data: 'unit_name' },
      { data: 'station_name' },
      { data: 'item_code' },
      { data: 'position_name' },
      { data: 'grade' },
      { data: 'position_level' },
      { data: 'salary' },
      { data: 'employment_name' },
      { data: 'fund_source_name' },
      { data: 'date_creation_position' },
      { data: 'status_name' },
      { data: 'action' },
    ],
         'columnDefs': [ {
        'targets': [12], //Yung Action
        'orderable': false,
     }]
  });


  //kapag meg select add division
  //add
  jQuery(document).ready(function() {

    jQuery("#txtAddDivision").on('change',function(){
      var divisionAction = jQuery(this).attr("id");
      var division_ids = jQuery(this).val();
      if(division_ids){
          jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{divisionAction:divisionAction, division_ids:division_ids},
          success:function(data){
              jQuery('#txtAddUnit').html(data);
          }
      });
      }else{
          jQuery('#txtAddUnit').html('<option value="">SELECT DIVISION FIRST</option>');
      }
  });

        
  jQuery("#txtAddSalaryGrade").on('change',function(){
      var SG_id = jQuery(this).val(); 
      let PosLevel = "";
      if(SG_id < 11){
          PosLevel = 1;
      }else if(SG_id > 10 && SG_id < 25){
        PosLevel = 2;
      }else{
        PosLevel = 3;
      }
      jQuery('#txtAddPositionLevel').val(PosLevel);


      let positionLevelAction = 'positionLevelAction';
      jQuery.ajax({
        url:"includes/db_functions.php",
        method:"POST",
        data:{positionLevelAction:positionLevelAction, SG_id:SG_id},
        success:function(data){
          var json_data = JSON.parse(data);

          jQuery('#txtSalary').val(json_data.salary);
          jQuery('#txtSalaryId').val(json_data.id);
        }
        });
    });
  });


  jQuery("#txtEditDivision").on("change",function(){
    var updatedivisionAction = jQuery(this).attr("id");
    var update_division_id = jQuery(this).val();
    if(update_division_id){
      jQuery.ajax({
        url:"includes/db_functions.php",
        method:"POST",
        data:{updatedivisionAction:updatedivisionAction, update_division_id:update_division_id},
        success:function(data){
          jQuery("#txtEditUnit").html(data);
        }
      });
    }else{
      jQuery("#txtEditUnit").html("<option value=''>SELECT DIVISION FIRST</option>");
    }
  });
     
   function modalEdit(val) {
       var position_code = val;

        jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{position_code:position_code},
          success:function(data){
              var position = JSON.parse(data);

              jQuery("#txtEditPositionCode").val(position["position_code"]);
              jQuery("#txtEditItemCode").val(position["item_code"]);

              var division_id = position["division_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{division_id:division_id},
                  success:function(data){
                      jQuery('#txtEditDivision').html(data);
                  }
              });

              var station_code = position["station_code"];
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{station_code:station_code},
                  success:function(data){
                      jQuery('#txtEditStation').html(data);
                  }
              });


              var unit_code = position["unit_code"];
              
              jQuery.ajax({
                  url:"includes/db_functions.php",
                  method:"POST",
                  data:{unit_code:unit_code,whereDivCode:division_id},
                  success:function(data){
                      jQuery('#txtEditUnit').html(data);
                  }
              });

              jQuery("#modalEdit").modal("show");
          }
      });
   }

</script>
</body>
</html>
