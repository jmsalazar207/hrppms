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
function getAddedby($Parenthetical_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_parenthetical_title 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_parenthetical_title.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_parenthetical_title.updated_by
      WHERE lib_parenthetical_title.parenthetical_code = '$Parenthetical_Code';");
  $result = $result->fetch_assoc();
  return $result;
}

if(isset($_POST['btnUpdateYes'])){
  $Parenthetical_Edit_Code = $_POST['txtEditParentheticalCode'];
  $Parenthetical_Edit_Name = strtoupper($_POST['txtEditParentheticalName']);
  $Parenthetical_Edit_Description = strtoupper($_POST['txtEditParentheticalDesription']);
  $Updated_By = $_SESSION['user_id']; 
  $Update_Parenthetical_SQL = "UPDATE lib_parenthetical_title SET parenthetical_name ='$Parenthetical_Edit_Name', parenthetical_description = '$Parenthetical_Edit_Description', updated_by = '$Updated_By', date_updated = now()  WHERE parenthetical_code ='$Parenthetical_Edit_Code'";

  if(mysqli_query($conn,$Update_Parenthetical_SQL)==true){
    echo "
        <script>
        alert('Parenthetical Details Successfully Updated!');
        window.location = 'list_parenthetical.php';
                </script>
    ";
  }
  else{
    "
        <script>
        alert('Updating unsuccessful!');
        window.location = 'list_parenthetical.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_Parenthetical_Code = $_POST['txtDeleteParentheticalCode'];

  $Delete_Parenthetical_SQL = "UPDATE lib_parenthetical_title SET deleted = 1 WHERE parenthetical_code ='$Delete_Parenthetical_Code'";
  if(mysqli_query($conn,$Delete_Parenthetical_SQL)==true){
    echo "
        <script>
        alert('Parenthetical Title Details Successfully Deleted!');
        window.location = 'list_parenthetical.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Parenthetical_Name = strtoupper($_POST['txtAddParentheticalName']);
  $Add_Parenthetical_Description= strtoupper($_POST['txtAddParentheticalDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Parenthetical_Output = $conn -> query("SELECT * from `lib_parenthetical_title` WHERE `parenthetical_name` = '$Add_Parenthetical_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Parenthetical_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Parenthetical Name Already Exists!");
    window.location = "list_parenthetical.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_parenthetical_title (parenthetical_name,parenthetical_description,added_by,date_added,deleted) VALUES('$Add_Parenthetical_Name','$Add_Parenthetical_Description','$Added_By',now(), 2)");
  
  echo '
    <script>
    alert("New Parenthetical Successfully Added!");
    window.location = "list_parenthetical.php"
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
                        <h4 class="box-title">List of Parenthetical</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Status</a>
                      </div>    
              <div class="box-body">
                <?php
                $parenthetical_sql = "SELECT * FROM lib_parenthetical_title WHERE deleted =2";
                    $parenthetical_result = mysqli_query($conn,$parenthetical_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Parenthetical Name</th>
                            <th>Parenthetical Description</th>
                            <th>Added By</th>
                            <th>Date Added</th>
                            <th>Updated By</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($parenthetical_output = mysqli_fetch_array($parenthetical_result)){
                    $Parenthetical_Code = $parenthetical_output['parenthetical_code'];
                    $hahawak =  getAddedby($Parenthetical_Code,$conn);
                    $Parenthetical_Name = $parenthetical_output['parenthetical_name'];
                    $Parenthetical_Description = $parenthetical_output['parenthetical_description'];
                    $Date_Added = $parenthetical_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Updated_By = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $parenthetical_output['date_updated'];
                    $Parenthetical_list_sql = "SELECT * from lib_parenthetical_title";
                    $Parenthetical_list_result = mysqli_query($conn,$Parenthetical_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Parenthetical_Code?>">
                    <td><?=$Parenthetical_Name?></td>
                    <td><?=$Parenthetical_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_By?></td>
                    <td><?=$Date_Updated?></td>

                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Parenthetical_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Parenthetical_Code?>" value = "<?=$Parenthetical_Code?>" title="Edit Parenthetical"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Parenthetical_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
                  <?php include 'modal/modal_parenthetical.php';?>
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
    var check_parenthetical_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_parenthetical_code:check_parenthetical_code},
          success:function(data){
            var parenthetical_check = JSON.parse(data);
            if(parenthetical_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected parenthetical title is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_parenthetical_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_parenthetical_name:check_delete_parenthetical_name}, 
                      success:function(data){
                        jQuery('#ParentheticalTitle').text(data);
                        jQuery('#txtDeleteParentheticalName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteParentheticalCode').val(check_parenthetical_code);
                      jQuery("#modalDeleteParenthetical").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
