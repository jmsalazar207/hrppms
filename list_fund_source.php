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
function getAddedby($Fund_Source_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_fund_source 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_fund_source.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_fund_source.updated_by
      WHERE lib_fund_source.fund_source_code = '$Fund_Source_Code';");
  $result = $result->fetch_assoc();
  return $result;
}

if(isset($_POST['btnUpdateYes'])){
  $Fund_Source_Edit_Code = $_POST['txtEditFundSourceCode'];
  $Fund_Source_Edit_Name = strtoupper($_POST['txtEditFundSourceName']);
  $Fund_Source_Edit_Description = strtoupper($_POST['txtEditFundSourceDesription']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Fund_Source_SQL = "UPDATE lib_fund_source SET fund_source_name ='$Fund_Source_Edit_Name', fund_source_description = '$Fund_Source_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE fund_source_code ='$Fund_Source_Edit_Code'";

  if(mysqli_query($conn,$Update_Fund_Source_SQL)==true){
    echo "
        <script>
        alert('Fund Source Details Successfully Updated!');
        window.location = 'list_fund_source.php';
                </script>
    ";
  }
  else{
    "
        <script>
        alert('Updating unsuccessful!');
        window.location = 'list_fund_source.php';
                </script>
    ";
  }
}

if(isset($_POST['btnDeleteYes'])){
  $Delete_FS_Code = $_POST['txtDeleteFundSourceCode'];

  $Delete_FS_SQL = "UPDATE lib_fund_source SET deleted = 1 WHERE fund_source_code ='$Delete_FS_Code'";
  if(mysqli_query($conn,$Delete_FS_SQL)==true){
    echo "
        <script>
        alert('Fund Source Details Successfully Deleted!');
        window.location = 'list_fund_source.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Fund_Source_Name = strtoupper($_POST['txtAddFundSourceName']);
  $Add_Fund_Source_Description= strtoupper($_POST['txtAddFundSourceDesription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Fund_Source_Output = $conn -> query("SELECT * from `lib_fund_source` WHERE `fund_source_name` = '$Add_Fund_Source_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Fund_Source_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Fund Source Name Already Exists!");
    window.location = "list_fund_source.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_fund_source (fund_source_name,fund_source_description,added_by,date_added,deleted) VALUES('$Add_Fund_Source_Name','$Add_Fund_Source_Description','$Added_By', now(),2)");
  
  echo '
    <script>
    alert("New Fund Source Successfully Added!");
    window.location = "list_fund_source.php"
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
                        <h4 class="box-title">List of Fund Source</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Fund Source</a>
                      </div>    
              <div class="box-body">
                <?php
                $fund_source_sql = "SELECT * FROM lib_fund_source WHERE deleted =2";
                    $fund_source_result = mysqli_query($conn,$fund_source_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Fund Source Name</th>
                            <th>Fund Source Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($fund_source_output = mysqli_fetch_array($fund_source_result)){
                    $Fund_Source_Code = $fund_source_output['fund_source_code'];
                    $hahawak =  getAddedby($Fund_Source_Code,$conn);
                    $Fund_Source_Name = $fund_source_output['fund_source_name'];
                    $Fund_Source_Description = $fund_source_output['fund_source_description'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Date_Added = $fund_source_output['date_added'];
                    $Updated_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $fund_source_output['date_updated'];
                    $Fund_Source_list_sql = "SELECT * from lib_designation";
                    $Fund_Source_list_result = mysqli_query($conn,$Fund_Source_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Fund_Source_Code?>">
                    <td><?=$Fund_Source_Name?></td>
                    <td><?=$Fund_Source_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_by?></td>
                    <td><?=$Date_Updated?></td>                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Fund_Source_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Fund_Source_Code?>" value = "<?=$Fund_Source_Code?>" title="Edit Fund Source"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Fund_Source_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
                  <?php include 'modal/modal_fund_source.php';?>
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
    var check_FS_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_FS_code:check_FS_code},
          success:function(data){
            var FS_check = JSON.parse(data);
            if(FS_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected Fund Source is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_fs_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_fs_name:check_delete_fs_name}, 
                      success:function(data){
                        jQuery('#FundSourceName').text(data);
                        jQuery('#txtDeleteFundSourceName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteFundSourceCode').val(check_FS_code);
                      jQuery("#modalDeleteFundSource").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
