<?php include 'includes/hrppms_session.php'; ?>

<?php include 'includes/hrppms_header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/hrppms_scripts.php'; ?>
  <?php include 'includes/hrppms_navbar.php'; ?>
  <?php include 'includes/hrppms_menubar.php'; ?>
  <?php include 'includes/db_functions.php';?>

  <?php 
  include 'includes/conn.php'; 

  function getAddedby($Unit_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_unit 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_unit.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_unit.updated_by
      WHERE lib_unit.unit_code = '$Unit_Code';");
  $result = $result->fetch_assoc();
  return $result;
}

if(isset($_POST['btnUpdateYes'])){
  $U_Code = strtoupper($_POST['txtUnitCode']);
  $U_Name = strtoupper($_POST['txtUnitName']);
  $U_Name_Code = strtoupper($_POST['txtUnitNameCode']);
  $Div_Code = strtoupper($_POST['txtEditDivision']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Unit_SQL = "UPDATE lib_unit SET unit_name ='$U_Name', unit_name_code = '$U_Name_Code', division_code = '$Div_Code', updated_by = '$Updated_By', date_updated = now() WHERE unit_code ='$U_Code'";
  if(mysqli_query($conn,$Update_Unit_SQL)==true){
    echo "
        <script>
        alert('Unit Details Successfully Updated!');
        window.location = 'list_unit.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_Unit_Code = $_POST['txtDeleteUnitCode'];

  $Delete_Unit_SQL = "UPDATE lib_unit SET deleted = 1 WHERE unit_code ='$Delete_Unit_Code'";
  if(mysqli_query($conn,$Delete_Unit_SQL)==true){
    echo "
        <script>
        alert('Division Details Successfully Deleted!');
        window.location = 'list_unit.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Unit_Name = strtoupper($_POST['txtAddUnitName']);
  $Add_Unit_Name_Code = strtoupper($_POST['txtAddUnitNameCode']);
  $Add_Unit_Division = strtoupper($_POST['Unit_Division']);
   $Added_By = $_SESSION['user_id']; 
  $Add_New_Unit_Output = $conn -> query("SELECT * from `lib_unit` WHERE `unit_name` = '$Add_Unit_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Unit_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Unit Name Already Exists!");
    window.location = "list_unit.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_unit (unit_name,unit_name_code,division_code,added_by,datetime_added,deleted) VALUES('$Add_Unit_Name','$Add_Unit_Name_Code','$Add_Unit_Division','$Added_By',now(),2)");
  echo '
    <script>
    alert("New Unit Successfully Added!");
    window.location = "list_unit.php"
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
          <div class="box box-info">  
                      <div class="box-header with-border">
                        <h4 class="box-title">List of Units</h4>
                          <a href="#modalAddNewModalUnit" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Unit</a>
                      </div>    
              <div class="box-body">
                <?php
                $Unit_sql = "SELECT lib_unit.*, lib_division.division_name,lib_division.division_code FROM lib_unit INNER JOIN lib_division on lib_unit.division_code = lib_division.division_code WHERE lib_unit.deleted = 2";
                    $Unit_result = mysqli_query($conn,$Unit_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Unit Name</th>
                            <th>Unit Name Code</th>
                            <th>Division</th>
                            <th>Added By</th>
                            <th>Date Added</th>
                            <th>Updated By</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($Unit_output = mysqli_fetch_array($Unit_result)){
                    $Unit_Code = $Unit_output['unit_code'];
                     $hahawak =  getAddedby($Unit_Code,$conn);
                    $Unit_Name = $Unit_output['unit_name'];
                    $Unit_Name_Code = $Unit_output['unit_name_code'];
                    $Division_Name = $Unit_output['division_name'];
                    $Division_Code = $Unit_output['division_code'];
                    $Added_By = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Date_Added = $Unit_output['datetime_added'];
                    $Updated_By = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $Unit_output['date_updated'];
                    

                    /*$Unit_list_sql = "SELECT lib_unit.*, lib_division.division_name,lib_division.division_code FROM lib_unit INNER JOIN lib_division on lib_unit.division_code = lib_division.division_code WHERE unit_code = ".$Unit_Code;
                    $Unit_list_result = mysqli_query($conn,$Unit_list_sql) or die (mysqli_error());*/
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Unit_Code?>">
                    <td><?=$Unit_Name?></td>
                    <td><?=$Unit_Name_Code?></td>  
                    <td><?=$Division_Name?></td>
                    <td><?=$Added_By?></td> 
                    <td><?=$Date_Added?></td> 
                    <td><?=$Updated_By?></td> 
                    <td><?=$Date_Updated?></td>                                       
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Unit_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEditUnit<?=$Unit_Code?>" value = "<?=$Unit_Code?>" title="Edit Unit"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModalUnit(<?=$Unit_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button> 
                    </td>
                  </tr>

                  <?php include 'modal/modal_unit.php';?>
                  <?php include 'modal/modal_confirm.php';?>
                          <?php } ?> 
                                           </table>
                                       </tbody>                              
          </div>
        </div>
      </div>
    </section>
    <!--End Main Content-->
</div>

</script>

<script type="text/javascript">
  function ShowCheckModalUnit(val)
  {
    var check_unit_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_unit_code:check_unit_code},
          success:function(data){

            var unit_check = JSON.parse(data);
            if(unit_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected Unit is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_unit_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_unit_name:check_delete_unit_name}, 
                      success:function(data){
                        jQuery('#UnitName').text(data);
                        jQuery('#txtDeleteUnitName').val(data);
                      }               
                      });
                      jQuery('#txtDeleteUnitCode').val(check_unit_code);
                      jQuery("#modalDeleteUnit").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
