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
  function getAddedby($OBSP_Code,$conn)
  {
    $fname = "";
    $sname = "";
    $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
          IFNULL(added_by.surname,'') as added_sname,
          IFNULL(updated_by.firstname,'') as updated_fname,
          IFNULL(updated_by.surname,'') as updated_sname
        FROM lib_obsp 
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_obsp.added_by
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_obsp.updated_by
        WHERE lib_obsp.obsp_code = '$OBSP_Code';");
    $result = $result->fetch_assoc();
    return $result;
  }
if(isset($_POST['btnUpdateYes'])){
  $OBSP_Edit_Code = $_POST['txtEditOBSPCode'];
  $OBSP_Edit_Name = strtoupper($_POST['txtEditOBSPName']);
  $OBSP_Edit_Description = strtoupper($_POST['txtEditOBSPDescription']);
  $Updated_By = $_SESSION['user_id'];
  $Update_OBSP_SQL = "UPDATE lib_obsp SET obsp_name ='$OBSP_Edit_Name', obsp_description = '$OBSP_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE obsp_code ='$OBSP_Edit_Code'";

  if(mysqli_query($conn,$Update_OBSP_SQL)==true){
    echo "
        <script>
        alert('OBSP Details Successfully Updated!');
        window.location = 'list_obsp.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_OBSP_Code = $_POST['txtDeleteOBSPCode'];

  $Delete_OBSP_SQL = "UPDATE lib_obsp SET deleted = 1 WHERE obsp_code ='$Delete_OBSP_Code'";
  if(mysqli_query($conn,$Delete_OBSP_SQL)==true){
    echo "
        <script>
        alert('OBSP Details Successfully Deleted!');
        window.location = 'list_obsp.php';
                </script>
    ";
  }
}

if(isset($_POST['btnAddYes'])){
  $Add_OBSP_Name = strtoupper($_POST['txtAddOBSPName']);
  $Add_OBSP_Description= strtoupper($_POST['txtAddOBSPDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_OBSP_Output = $conn -> query("SELECT * from `lib_obsp` WHERE `obsp_name` = 'Add_OBSP_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_OBSP_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("OBSP Already Exists!");
    window.location = "list_obsp.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_obsp (obsp_code,obsp_name,obsp_description,added_by,date_added,deleted) VALUES('','$Add_OBSP_Name','$Add_OBSP_Description','$Added_By', now(),2)");
  echo '
    <script>
    alert("New OBSP Successfully Added!");
    window.location = "list_obsp.php"
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
                        <h4 class="box-title">List of Office/Bureau/Service/Program</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Office Location/Official Station</a>
                      </div>    
              <div class="box-body">
                <?php
                $obsp_sql = "SELECT * FROM lib_obsp WHERE deleted = 2";
                    $obsp_result = mysqli_query($conn,$obsp_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Office/Bureau/Service/Program</th>
                            <th>Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($obsp_output = mysqli_fetch_array($obsp_result)){
                    $OBSP_Code = $obsp_output['obsp_code'];
                    $hahawak =  getAddedby($OBSP_Code,$conn);
                    $OBSP_Name = $obsp_output['obsp_name'];
                    $OBSP_Description = $obsp_output['obsp_description'];
                    $Date_Added = $obsp_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Updated_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $obsp_output['date_updated'];
                    $OBSP_list_sql = "SELECT * from lib_obsp";
                    $OBSP_list_result = mysqli_query($conn,$OBSP_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$OBSP_Code?>">
                    <td><?=$OBSP_Name?></td>
                    <td><?=$OBSP_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_by?></td>
                    <td><?=$Date_Updated?></td>
                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$OBSP_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$OBSP_Code?>" value = "<?=$OBSP_Code?>" title="Edit OBSP"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$OBSP_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                  </td>
                  </tr>
                  <?php include 'modal/modal_obsp.php';?>
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
    var check_OBSP_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_OBSP_code:check_OBSP_code},
          success:function(data){
            var OBSP_check = JSON.parse(data);
            if(OBSP_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected OBSP is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_obsp_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_obsp_name:check_delete_obsp_name}, 
                      success:function(data){
                        jQuery('#OBSPName').text(data);
                        jQuery('#txtDeleteOBSPName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteOBSPCode').val(check_OBSP_code);
                      jQuery("#modalDeleteOBSP").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
