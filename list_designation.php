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
  function getAddedby($Designation_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_designation 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_designation.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_designation.updated_by
      WHERE lib_designation.designation_code = '$Designation_Code';");
  $result = $result->fetch_assoc();
  return $result;
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_Designation_Code = $_POST['txtDeleteDesignationCode'];

  $Delete_Designation_SQL = "UPDATE lib_designation SET deleted = 1 WHERE designation_code ='$Delete_Designation_Code'";
  if(mysqli_query($conn,$Delete_Designation_SQL)==true){
    echo "
        <script>
        alert('Designation Details Successfully Deleted!');
        window.location = 'list_designation.php';
                </script>
    ";
  }
}
if(isset($_POST['btnUpdateYes'])){
  $Designation_Edit_Code = $_POST['txtEditDesignationCode'];
  $Designation_Edit_Name = strtoupper($_POST['txtEditDesignationName']);
  $Designation_Edit_Description = strtoupper($_POST['txtEditDesignationDesription']);
   $Updated_By = $_SESSION['user_id'];
  $Update_Designation_SQL = "UPDATE lib_designation SET designation_name ='$Designation_Edit_Name', designation_description = '$Designation_Edit_Description', date_updated = now(), updated_by = '$Updated_By' WHERE designation_code ='$Designation_Edit_Code'";

  if(mysqli_query($conn,$Update_Designation_SQL)==true){
    echo "
        <script>
        alert('Designation Details Successfully Updated!');
        window.location = 'list_designation.php';
                </script>
    ";
  }
  else{
    "
        <script>
        alert('Updating unsuccessful!');
        window.location = 'list_designation.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Designation_Name = strtoupper($_POST['txtAddDesignationName']);
  $Add_Designation_Description= strtoupper($_POST['txtAddDesignationDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Designation_Output = $conn -> query("SELECT * from `lib_designation` WHERE `designation_name` = '$Add_Designation_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Designation_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Designation Name Already Exists!");
    window.location = "list_designation.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_designation (designation_name,designation_description,added_by,date_added,deleted) 
    VALUES('$Add_Designation_Name','$Add_Designation_Description','$Added_By',now(), 2)");
  
  echo '
    <script>
    alert("New Designation Successfully Added!");
    window.location = "list_designation.php"
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
                        <h4 class="box-title">List of Designation</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Designation</a>
                      </div>    
              <div class="box-body">
                <?php
                $designation_sql = "SELECT * FROM lib_designation WHERE deleted =2";
                    $designation_result = mysqli_query($conn,$designation_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Designation Name</th>
                            <th>Designation Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($designation_output = mysqli_fetch_array($designation_result)){
                    $Designation_Code = $designation_output['designation_code'];
                    $hahawak =  getAddedby($Designation_Code,$conn);
                    $Designation_Name = $designation_output['designation_name'];
                    $Designation_Description = $designation_output['designation_description'];
                    $Date_Added = $designation_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Update_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $designation_output['date_updated'];
                    $Designation_list_sql = "SELECT * from lib_designation";
                    $Designation_list_result = mysqli_query($conn,$Designation_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Designation_Code?>">
                    <td><?=$Designation_Name?></td>
                    <td><?=$Designation_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Update_by?></td>
                    <td><?=$Date_Updated?></td>
                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Designation_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Designation_Code?>" value = "<?=$Designation_Code?>" title="Edit Designation"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Designation_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>                     
                    </td>
                  </tr>
                  <?php include 'modal/modal_designation.php';?>
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
<script type="text/javascript">
  function ShowCheckModal(val)
  {
    var check_designation_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_designation_code:check_designation_code},
          success:function(data){
            var designation_check = JSON.parse(data);
            if(designation_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected designation is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_designation_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_designation_name:check_delete_designation_name}, 
                      success:function(data){
                        jQuery('#DesignationName').text(data);
                        jQuery('#txtDeleteDesignationName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteDesignationCode').val(check_designation_code);
                      jQuery("#modalDeleteDesignation").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
