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
function getAddedby($Mode_Accession_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_mode_accession 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_mode_accession.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_mode_accession.updated_by
      WHERE lib_mode_accession.mode_accession_code = '$Mode_Accession_Code';");
  $result = $result->fetch_assoc();
  return $result;
}
if(isset($_POST['btnUpdateYes'])){
  $Mode_Accession_Edit_Code = $_POST['txtEditModeAccessionCode'];
  $Mode_Accession_Edit_Name = strtoupper($_POST['txtEditModeAccessionName']);
  $Mode_Accession_Edit_Description = strtoupper($_POST['txtEditModeAccessionDescription']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Mode_Accession_SQL = "UPDATE lib_mode_accession SET mode_accession_name ='$Mode_Accession_Edit_Name', mode_accession_description = '$Mode_Accession_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE mode_accession_code ='$Mode_Accession_Edit_Code'";

  if(mysqli_query($conn,$Update_Mode_Accession_SQL)==true){
    echo "
        <script>
        alert('Mode of Accession Details Successfully Updated!');
        window.location = 'list_mode_accession.php';
                </script>
    ";
  }
  else{
    "
        <script>
        alert('Updating unsuccessful!');
        window.location = 'list_mode_accession.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_MA_Code = $_POST['txtDeleteMACode'];

  $Delete_MA_SQL = "UPDATE lib_mode_accession SET deleted = 1 WHERE mode_accession_code ='$Delete_MA_Code'";
  if(mysqli_query($conn,$Delete_MA_SQL)==true){
    echo "
        <script>
        alert('Mode of Accession Details Successfully Deleted!');
        window.location = 'list_mode_accession.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Mode_Accession_Name = strtoupper($_POST['txtAddModeAccessionName']);
  $Add_Mode_Accession_Description= strtoupper($_POST['txtAddModeAccessionDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Mode_Accession_Output = $conn -> query("SELECT * from `lib_mode_accession` WHERE `mode_accession_name` = '$Add_Mode_Accession_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Mode_Accession_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Mode of Accession Name Already Exists!");
    window.location = "list_mode_accession.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_mode_accession (mode_accession_code,mode_accession_name,mode_accession_description,added_by,date_added,deleted) VALUES('','$Add_Mode_Accession_Name','$Add_Mode_Accession_Description','$Added_By', now(),2)");
  
  echo '
    <script>
    alert("New Mode of Accession Successfully Added!");
    window.location = "list_mode_accession.php"
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
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Mode of Accession</a>
                      </div>    
              <div class="box-body">
                <?php
                $mode_accession_sql = "SELECT * FROM lib_mode_accession WHERE deleted =2";
                    $mode_accession_result = mysqli_query($conn,$mode_accession_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Mode of Accession Name</th>
                            <th>Mode of Accession Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                            
                          </thead>
                          <tbody>";
                    while($mode_accession_output = mysqli_fetch_array($mode_accession_result)){
                    $Mode_Accession_Code = $mode_accession_output['mode_accession_code'];
                    $hahawak =  getAddedby($Mode_Accession_Code,$conn);
                    $Mode_Accession_Name = $mode_accession_output['mode_accession_name'];
                    $Mode_Accession_Description = $mode_accession_output['mode_accession_description'];
                    $Date_Added = $mode_accession_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Date_Added = $mode_accession_output['date_added'];
                    $Updated_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $mode_accession_output['date_updated'];
                    $Mode_Accession_list_sql = "SELECT * from lib_mode_accession";
                    $Mode_Accession_list_result = mysqli_query($conn,$Mode_Accession_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Mode_Accession_Code?>">
                    <td><?=$Mode_Accession_Name?></td>
                    <td><?=$Mode_Accession_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_by?></td>
                    <td><?=$Date_Updated?></td>

                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Mode_Accession_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Mode_Accession_Code?>" value = "<?=$Mode_Accession_Code?>" title="Edit Mode of Accession"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Mode_Accession_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
                  <?php include 'modal/modal_mode_accession.php';?>
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
    var check_MA_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_MA_code:check_MA_code},
          success:function(data){
            var MA_check = JSON.parse(data);
            if(MA_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected Mode of Accession is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_ma_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_ma_name:check_delete_ma_name}, 
                      success:function(data){
                        jQuery('#AccessionName').text(data);
                        jQuery('#txtDeleteMANName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteMACode').val(check_MA_code);
                      jQuery("#modalDeleteModeAccession").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
