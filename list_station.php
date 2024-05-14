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
  function getAddedby($Station_Code,$conn)
  {
    $fname = "";
    $sname = "";
    $result = $conn->query("SELECT IFNULL(added_by.firstname,'') as added_fname,
          IFNULL(added_by.surname,'') as added_sname,
          IFNULL(updated_by.firstname,'') as updated_fname,
          IFNULL(updated_by.surname,'') as updated_sname
        FROM lib_official_station 
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') added_by ON added_by.empno = lib_official_station.added_by
        LEFT JOIN (SELECT firstname,surname,empno FROM pds_personal_information WHERE empno != '') updated_by ON updated_by.empno = lib_official_station.updated_by
        WHERE lib_official_station.station_code = '$Station_Code';");
    $result = $result->fetch_assoc();
    return $result;
  }
if(isset($_POST['btnUpdateYes'])){
  $Station_Edit_Code = $_POST['txtEditStationCode'];
  $Station_Edit_Name = strtoupper($_POST['txtEditStationName']);
  $Station_Edit_Description = strtoupper($_POST['txtEditStationDescription']);
  $Updated_By = $_SESSION['user_id'];
  $Update_Station_SQL = "UPDATE lib_official_station SET station_name ='$Station_Edit_Name', station_description = '$Station_Edit_Description', updated_by = '$Updated_By', date_updated = now() WHERE station_code ='$Station_Edit_Code'";

  if(mysqli_query($conn,$Update_Station_SQL)==true){
    echo "
        <script>
        alert('Official Station Details Successfully Updated!');
        window.location = 'list_station.php';
                </script>
    ";
  }
}
if(isset($_POST['btnDeleteYes'])){
  $Delete_OLOS_Code = $_POST['txtDeleteOLOSCode'];

  $Delete_OLOS_SQL = "UPDATE lib_official_station SET deleted = 1 WHERE station_code ='$Delete_OLOS_Code'";
  if(mysqli_query($conn,$Delete_OLOS_SQL)==true){
    echo "
        <script>
        alert('OLOS Details Successfully Deleted!');
        window.location = 'list_station.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Station_Name = strtoupper($_POST['txtAddStationName']);
  $Add_Station_Description= strtoupper($_POST['txtAddStationDescription']);
  $Added_By = $_SESSION['user_id']; 
  $Add_New_Station_Output = $conn -> query("SELECT * from `lib_official_station` WHERE `station_name` = '$Add_Station_Name'") or die(mysqli_error($conn));
  $Add_New_Query = $Add_New_Station_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Office Location/Official Station Already Exists!");
    window.location = "list_station.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_official_station (station_code,station_name,station_description,added_by,date_added,deleted) VALUES('','$Add_Station_Name','$Add_Station_Description','$Added_By', now(),2)");
  echo '
    <script>
    alert("New Office Location/Official Station Successfully Added!");
    window.location = "list_station.php"
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
                        <h4 class="box-title">List of Office Location/Official Station</h4>
                          <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Office Location/Official Station</a>
                      </div>    
              <div class="box-body">
                <?php
                $station_sql = "SELECT * FROM lib_official_station WHERE deleted = 2";
                    $station_result = mysqli_query($conn,$station_sql) or die(mysqli_error($conn));
                    echo "<table id='example2' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Office Location/Official Station</th>
                            <th>Description</th>
                            <th>Added by</th>
                            <th>Date Added</th>
                            <th>Updated by</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    while($station_output = mysqli_fetch_array($station_result)){
                    $Station_Code = $station_output['station_code'];
                    $hahawak =  getAddedby($Station_Code,$conn);
                    $Station_Name = $station_output['station_name'];
                    $Station_Description = $station_output['station_description'];
                    $Date_Added = $station_output['date_added'];
                    $Added_by = $hahawak['added_fname'].' '.$hahawak['added_sname'];
                    $Updated_by = $hahawak['updated_fname'].' '.$hahawak['updated_sname'];
                    $Date_Updated = $station_output['date_updated'];
                    $Station_list_sql = "SELECT * from lib_official_station";
                    $Station_list_result = mysqli_query($conn,$Station_list_sql) or die (mysqli_error($conn));
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Station_Code?>">
                    <td><?=$Station_Name?></td>
                    <td><?=$Station_Description?></td>  
                    <td><?=$Added_by?></td>
                    <td><?=$Date_Added?></td>
                    <td><?=$Updated_by?></td>
                    <td><?=$Date_Updated?></td>
                                                   
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Station_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Station_Code?>" value = "<?=$Station_Code?>" title="Edit Office Location/Official Station"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    <button class="btn btn-danger btn-sm btnDelete" id="btnDeleteShow" name="btnDeleteShow" onclick="ShowCheckModal(<?=$Station_Code?>);"><i class="fa fa-times-circle" aria-hidden="true"> </i></button>
                  </td>
                  </tr>
                  <?php include 'modal/modal_station.php';?>
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
    var check_OLOS_code = val;
    jQuery.ajax({
          url:"includes/db_functions.php",
          method:"POST",
          data:{check_OLOS_code:check_OLOS_code},
          success:function(data){
            var OLOS_check = JSON.parse(data);
            if(OLOS_check['bilang'] > 0)
            {
              jQuery('#WarningMessage').text("Selected OLOS is in use");
              jQuery("#ModalWarning").modal("show");
            }
            else
            {
                      var check_delete_olos_name = val;
                      jQuery.ajax({
                      url:"includes/db_functions.php",
                      method:"POST",
                      data:{check_delete_olos_name:check_delete_olos_name}, 
                      success:function(data){
                        jQuery('#StationName').text(data);
                        jQuery('#txtDeleteOLOSName').val(data);
                      }               
                      });
                      // var check_delete_designation_code = val;
                      jQuery('#txtDeleteOLOSCode').val(check_OLOS_code);
                      jQuery("#modalDeleteOLOS").modal("show"); 
            }
          }
          }); 

  }
</script>
  <?php include 'includes/hrppms_footer.php'; ?>
</body>
</html>
