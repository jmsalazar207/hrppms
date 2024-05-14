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

if(isset($_POST['btnUpdateYes'])){
  $Status_Edit_Code = $_POST['txtEditStatusCode'];
  $Status_Edit_Name = strtoupper($_POST['txtEditStatusName']);
  $Status_Edit_Description = strtoupper($_POST['txtEditStatusDescription']);
  $Update_Status_SQL = "UPDATE lib_status SET status_name ='$Status_Edit_Name', status_description = '$Status_Edit_Description' WHERE status_code ='$Status_Edit_Code'";

  if(mysqli_query($conn,$Update_Status_SQL)==true){
    echo "
        <script>
        alert('Unit Details Successfully Updated!');
        window.location = 'list_status.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Status_Name = strtoupper($_POST['txtAddStatusName']);
  $Add_Status_Description= strtoupper($_POST['txtAddDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Status_Output = $conn -> query("SELECT * from `lib_status` WHERE `status_name` = '$Add_Status_Name'") or die(mysqli_error());
  $Add_New_Query = $Add_New_Status_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Status Name Already Exists!");
    window.location = "list_status.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_status (status_code,status_name,status_description,added_by) VALUES('','$Add_Status_Name','$Add_Status_Description','$Added_By')");
  echo '
    <script>
    alert("New status Successfully Added!");
    window.location = "list_status.php"
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
                        <h4 class="box-title">List of Status</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Status</a>
                      </div>    
              <div class="box-body">
                <?php
                $status_sql = "SELECT * FROM lib_status";
                    $status_result = mysqli_query($conn,$status_sql) or die(mysqli_error());
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Status Name</th>
                            <th>Description</th>
                            <th>added_by</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($status_output = mysqli_fetch_array($status_result)){
                    $Status_Code = $status_output['status_code'];
                    $Status_Name = $status_output['status_name'];
                    $Status_Description = $status_output['status_description'];
                    $Date_Added = $status_output['date_added'];
                    $Added_by = $status_output['added_by'];
                    $Status_list_sql = "SELECT * from lib_status";
                    $Status_list_result = mysqli_query($conn,$Status_list_sql) or die (mysqli_error());
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Status_Code?>">
                    <td><?=$Status_Name?></td>
                    <td><?=$Status_Description?></td>  
                    <td><?=$Added_by?></td>
                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Unit_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Status_Code?>" value = "<?=$Status_Code?>" title="Edit Status"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    </td>
                  </tr>

<!--Modal Pop up for Approve-->
                                        <div class="modal fade" id="modalEdit<?=$Status_Code?>" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Updating Status Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="Editmodalbody">
                                                                    <div class="row" hidden="true">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditStatusCode" class="form-control border-input" readonly="true" value="<?=$Status_Code?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditStatusName" class="form-control border-input" value="<?=$Status_Name?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditStatusDescription" class="form-control border-input" value="<?=$Status_Description?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div>                                                                                                           
                                                            </div>
                                                                <div class="text-center modal-footer">
                                                                    <input type="submit" class="btn btn-success btn-round btnyesno" name="btnUpdateYes" value="YES" />
                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">NO</button>
                                                                </div>
                                                    </div>                                                       
                                                </form>
                                            </div>
                                        </div>
<!--End Modal Pop up for Approve-->   
                          <?php } ?> 
                                           </table>
                                       </tbody>
<!--Modal Pop up for Add New-->
                                        <div class="modal fade" id="modalAddNewModal" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmAdd" method="POST">
                                                    <div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Add New Status Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="AddNewmodalbody">                                                 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddStatusName" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddDescription" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div> 
                                                                                                                          
                                                            </div>
                                                                <div class="text-center modal-footer">
                                                                    <input type="submit" class="btn btn-success btn-round btnyesno" name="btnAddYes" value="YES" />
                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">NO</button>
                                                                </div>
                                                    </div>                                                       
                                                </form>
                                            </div>
                                        </div>
<!--End Modal Pop up for Add New-->                                                        
          </div>
        </div>
      </div>
    </section>
    <!--End Main Content-->
</div>

  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
