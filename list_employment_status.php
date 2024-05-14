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
function getAddedby($Employment_Status_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM employment_lib 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = employment_lib.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = employment_lib.updated_by
      WHERE employment_lib.employment_id = '$Employment_Status_Code';");
  $result = $result->fetch_assoc();
  return $result;
}

if(isset($_POST['btnUpdateYes'])){
  $Employment_Status_Edit_Code = $_POST['txtEditEmploymentStatusCode'];
  $Employment_Status_Edit_Name = strtoupper($_POST['txtEditEmploymentStatusName']);
  $Employment_Status_Edit_Description = strtoupper($_POST['txtEditEmploymentStatusDescription']);
$Updated_By = $_SESSION['user_id'];
  $Employment_Update_Status_SQL = "UPDATE employment_lib SET employment_name ='$Employment_Status_Edit_Name', employment_description = '$Employment_Status_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE employment_id ='$Employment_Status_Edit_Code'";

  if(mysqli_query($conn,$Employment_Update_Status_SQL)==true){
    echo "
        <script>
        alert('Classification of Status Details Successfully Updated');
        window.location = 'list_employment_status.php';
                </script>
    ";
  }
  else{
    echo "script>
        alert('Classification of Status Details Update failed!');
        window.location = 'list_employment_status.php';
                </script>";
  }

}
if(isset($_POST['btnDeleteYes'])){
  $Delete_CS_Code = $_POST['txtDeleteClassStatusCode'];

  $Delete_CS_SQL = "UPDATE employment_lib SET deleted = 1 WHERE employment_id ='$Delete_CS_Code'";
  if(mysqli_query($conn,$Delete_CS_SQL)==true){
    echo "
        <script>
        alert('Classification of Status Details Successfully Deleted!');
        window.location = 'list_employment_status.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Employment_Status_Name = strtoupper($_POST['txtAddEmploymentStatusName']);
  $Add_Status_Description= strtoupper($_POST['txtAddEmploymentStatusDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Employment_Status_Output = $conn -> query("SELECT * from `employment_lib` WHERE `employment_name` = '$Add_Employment_Status_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Employment_Status_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Employment Status Name Already Exists!");
    window.location = "list_employment_status.php"
  </script>
  ';
}
  else
{

  $conn -> query("INSERT INTO employment_lib (employment_name,employment_description,added_by,date_added,deleted) 
    VALUES('$Add_Employment_Status_Name','$Add_Status_Description','$Added_By', now(),2)");

  echo '
    <script>
    alert("New Classification of Status Successfully Added!");
    window.location = "list_employment_status.php"
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
                        <h4 class="box-title">List of Classification of Status</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Status</a>
                      </div>    
              <div class="box-body">
                <?php
                $employment_status_sql = "SELECT * FROM employment_lib WHERE deleted =2";
                    $employment_status_result = mysqli_query($conn,$employment_status_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Employment Status Name</th>
                            <th>Employment Description</th>
                            <th>Added By</th>
                            <th>Date Added</th>
                            <th>Updated By</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($employment_status_output = mysqli_fetch_array($employment_status_result)){
                    $Employment_Status_Code = $employment_status_output['employment_id'];
                    $hahawak =  getAddedby($Employment_Status_Code,$conn);
                    $Employment_Status_Name = $employment_status_output['employment_name'];
                    $Employment_Status_Description = $employment_status_output['employment_description'];
                    $Date_Added = $employment_status_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Date_Added = $employment_status_output['date_added'];
                    $Updated_By = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $employment_status_output['date_updated'];                                        
                    $Employment_Status_list_sql = "SELECT * from employment_lib";
                    $Employment_Status_list_result = mysqli_query($conn,$Employment_Status_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Employment_Status_Code?>">
                    <td><?=$Employment_Status_Name?></td>
                    <td><?=$Employment_Status_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_By?></td>
                    <td><?=$Date_Updated?></td>

                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Employment_Status_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Employment_Status_Code?>" value = "<?=$Employment_Status_Code?>" title="Edit Classification of Status"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Employment_Status_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
                  <?php include 'modal/modal_class_status.php';?>
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
    var check_CS_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_CS_code:check_CS_code},
          success:function(data){
            var CS_check = JSON.parse(data);
            if(CS_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected employment status is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_CS_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_CS_name:check_delete_CS_name}, 
                      success:function(data){
                        jQuery('#ClassStatusName').text(data);
                        jQuery('#txtDeleteClassStatusName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteClassStatusCode').val(check_CS_code);
                      jQuery("#modalDeleteClassStatus").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
