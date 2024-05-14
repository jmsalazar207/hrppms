<?php include 'includes/hrppms_session.php'; ?>

<?php include 'includes/hrppms_header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/hrppms_scripts.php'; ?>
  <?php include 'includes/hrppms_navbar.php'; ?>
  <?php include 'includes/hrppms_menubar.php'; ?>
  
  <?php 
  include 'includes/conn.php'; 
function getAddedby($Division_Code,$conn)
{
  $fname = "";
  $sname = "";
  $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
        IFNULL(added_by.surname,'') as added_sname,
        IFNULL(updated_by.firstname,'') as updated_fname,
        IFNULL(updated_by.surname,'') as updated_sname
      FROM lib_division 
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_division.added_by
      LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_division.updated_by
      WHERE lib_division.division_code = '$Division_Code';");
  $result = $result->fetch_assoc();
  return $result;
}

if(isset($_POST['btnUpdateYes'])){
  $Div_Code = $_POST['txtDivisionCode'];
  $Div_Name = strtoupper($_POST['txtDivisionName']);
  $Div_Name_Code = strtoupper($_POST['txtDivisionNameCode']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Division_SQL = "UPDATE lib_division SET division_name ='$Div_Name', division_name_code = '$Div_Name_Code' , updated_by = '$Updated_By', date_updated = now() WHERE division_code ='$Div_Code'";
  if(mysqli_query($conn,$Update_Division_SQL)==true){
    echo "
        <script>
        alert('Division Details Successfully Updated!');
        window.location = 'list_division.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_Division_Code = $_POST['txtDeleteDivisionCode'];

  $Delete_Division_SQL = "UPDATE lib_division SET deleted = 1 WHERE division_code ='$Delete_Division_Code'";
  if(mysqli_query($conn,$Delete_Division_SQL)==true){
    echo "
        <script>
        alert('Division Details Successfully Deleted!');
        window.location = 'list_division.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Div_Name = strtoupper($_POST['txtAddDivisionName']);
  $Add_Div_Name_Code = strtoupper($_POST['txtAddDivisionNameCode']);
  $Added_By = $_SESSION['user_id'];
  $Add_New_Div_Output = $conn -> query("SELECT * from `lib_division` WHERE `division_name` = '$Add_Div_Name' AND deleted =2") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Div_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Division Name Already Exists!");
    window.location = "list_division.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_division (division_code,division_name,division_name_code,datetime_added,added_by,deleted) VALUES('','$Add_Div_Name','$Add_Div_Name_Code',now(),'$Added_By','2')");
  echo '
    <script>
    alert("New Division Successfully Added!");
    window.location = "list_division.php"
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
                        <h4 class="box-title">List of Divisions</h4>
                        <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Division</a>
                      </div>  
              <div class="box-body">
                <?php
                $Division_sql = "SELECT * FROM lib_division WHERE deleted = 2";
                    $Division_result = mysqli_query($conn,$Division_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Division Name</th>
                            <th>Division Name Code</th>
                            <th>Added By</th>
                            <th>Date Added</th>
                            <th>Updated By</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($Division_output = mysqli_fetch_array($Division_result)){
                    $Division_Code = $Division_output['division_code'];
                    $hahawak =  getAddedby($Division_Code,$conn);
                    $Division_Name = $Division_output['division_name'];
                    $Added_By = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Date_Added = $Division_output['datetime_added'];
                    $Updated_By = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $Division_output['date_updated'];
                    $Division_Name_Code = $Division_output['division_name_code'];
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Division_Code?>">
                    <td><?=$Division_Name?></td>
                    <td><?=$Division_Name_Code?></td>
                    <td><?=$Added_By?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_By?></td>
                    <td><?=$Date_Updated?></td>                  
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Division_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Division_Code?>" value = "<?=$Division_Code?>" title="Edit Division"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Division_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
                       <?php include 'modal/modal_division.php';?>
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

  <?php include 
  'includes/hrppms_footer.php';
   ?>
<script type="text/javascript">
  function ShowCheckModal(val)
  {
    var check_division_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_division_code:check_division_code},
          success:function(data){
            var division_check = JSON.parse(data);
            if(division_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected division is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_division_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_division_name:check_division_name}, 
                      success:function(data){
                        jQuery('#DivisionName').text(data);
                        jQuery('#txtDeleteDivisionName').val(data);
                      }               
                      });
                            var check_division_name_code = val;
                            jQuery.ajax({
                            url:"includes/db_functions.php",
                            method:"POST",
                            data:{check_division_name_code:check_division_name_code}, 
                            success:function(data){
                              jQuery('#txtDeleteDivisionNameCode').val(data);
                            }               
                            });
                            var checking_division_code = val;
                            
                      jQuery('#txtDeleteDivisionCode').val(checking_division_code);
                      jQuery("#modalDelete").modal("show"); 
            }
          }
          }); 

  }
</script>
</body>
</html>
