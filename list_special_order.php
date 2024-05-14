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
  function getAddedby($Special_Order_Code,$conn)
  {
    $fname = "";
    $sname = "";
    $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
          IFNULL(added_by.surname,'') as added_sname,
          IFNULL(updated_by.firstname,'') as updated_fname,
          IFNULL(updated_by.surname,'') as updated_sname
        FROM lib_special_order 
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_special_order.added_by
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_special_order.updated_by
        WHERE lib_special_order.special_order_code = '$Special_Order_Code';");
    $result = $result->fetch_assoc();
    return $result;
  }
if(isset($_POST['btnUpdateYes'])){
  $Special_Order_Edit_Code = $_POST['txtEditSpecialOrderCode'];
  $Special_Order_Edit_Number = strtoupper($_POST['txtEditSpeicalOrderNumber']);
  $Special_Order_Edit_Description = strtoupper($_POST['txtEditSpecialOrderDescription']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Special_Order_SQL = "UPDATE lib_special_order SET special_order_no ='$Special_Order_Edit_Number', special_order_description = '$Special_Order_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE special_order_code ='$Special_Order_Edit_Code'";

  if(mysqli_query($conn,$Update_Special_Order_SQL)==true){
    echo "
        <script>
        alert('Special Order Details Successfully Updated!');
        window.location = 'list_special_order.php';
                </script>
    ";
  }
  else{
    echo "<script>
        alert('Updating Special Order Unsuccessful!');
        window.location = 'list_special_order.php';
                </script>";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_RSO_Code = $_POST['txtDeleteRSOCode'];

  $Delete_RSO_SQL = "UPDATE lib_special_order SET deleted = 1 WHERE special_order_code ='$Delete_RSO_Code'";
  if(mysqli_query($conn,$Delete_RSO_SQL)==true){
    echo "
        <script>
        alert('RSO Details Successfully Deleted!');
        window.location = 'list_special_order.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Special_Order_Number = strtoupper($_POST['txtAddSpecialOrderNumber']);
  $Add_Special_Order_Description= strtoupper($_POST['txtAddSpecialOrderDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Special_Order_Output = $conn -> query("SELECT * from `lib_special_order` WHERE `special_order_no` = '$Add_Special_Order_Number'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Special_Order_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Special Order Number Already Exists!");
    window.location = "list_special_order.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_special_order (special_order_code,special_order_no,special_order_description,added_by,date_added,deleted) VALUES('','$Add_Special_Order_Number','$Add_Special_Order_Description','$Added_By', now(),2)");
  echo '
    <script>
    alert("New Special Order Number Successfully Added!");
    window.location = "list_special_order.php"
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
                        <h4 class="box-title">List of Special Order Number</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Special Order</a>
                      </div>    
              <div class="box-body">
                <?php
                $special_order_sql = "SELECT * FROM lib_special_order WHERE deleted = 2";
                    $special_order_result = mysqli_query($conn,$special_order_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Special Order Number</th>
                            <th>Special Order Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($special_order_output = mysqli_fetch_array($special_order_result)){
                    $Special_Order_Code = $special_order_output['special_order_code'];
                    $hahawak =  getAddedby($Special_Order_Code,$conn);
                    $Special_Order_Number = $special_order_output['special_order_no'];
                    $Special_Order_Description = $special_order_output['special_order_description'];
                    $Date_Added = $special_order_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Updated_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $special_order_output['date_updated'];
                    $Special_Order_list_sql = "SELECT * from lib_special_order";
                    $Special_Order_list_result = mysqli_query($conn,$Special_Order_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Special_Order_Code?>">
                    <td><?=$Special_Order_Number?></td>
                    <td><?=$Special_Order_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_by?></td>
                    <td><?=$Date_Updated?></td>
                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Special_Order_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Special_Order_Code?>" value = "<?=$Special_Order_Code?>" title="Edit Special Order Number"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Special_Order_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                  </td>
                  </tr>
                  <?php include 'modal/modal_special_order.php';?>
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
    var check_RSO_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_RSO_code:check_RSO_code},
          success:function(data){
            var RSO_check = JSON.parse(data);
            if(RSO_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected Special Order is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_rso_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_rso_name:check_delete_rso_name}, 
                      success:function(data){
                        jQuery('#RSOName').text(data);
                        jQuery('#txtDeleteRSOName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteRSOCode').val(check_RSO_code);
                      jQuery("#modalDeleteRSO").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
