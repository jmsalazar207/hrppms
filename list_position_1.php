<?php include 'includes/hrppms_session.php'; ?>

<?php include 'includes/hrppms_header.php'; ?>
<?php include 'includes/hrppms_scripts.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/hrppms_navbar.php'; ?>
  <?php include 'includes/hrppms_menubar.php'; ?>
   <?php include 'includes/db_functions.php'; ?>
  <?php 
  include 'includes/conn.php'; 
if(isset($_POST['btnUpdateYes'])){
  $Edit_Pos_Code = $_POST['txtEditPositionCode'];
  $Edit_Item_Code = strtoupper($_POST['txtEditItemCode']);  
  $Edit_Station_Code = $_POST['txtEditStation'];

  $Edit_Div_Code = $_POST['txtEditDivision'];
  $Edit_Unit_Code = $_POST['txtEditUnit'];

  $Update_Position_SQL = "UPDATE lib_position SET division_code = '$Edit_Div_Code', unit_code = '$Edit_Unit_Code' station_code = '$Edit_Station_Code' WHERE item_code ='$Edit_Item_Code'";
  if(mysqli_query($conn,$Update_Position_SQL)==true){
    echo "
        <script>
        alert('Position Details Successfully Updated!');
        window.location = 'list_position.php';
                </script>
    ";
  }
}
if(isset($_POST['btnAddYes'])){
  $Add_Pos_Name = strtoupper($_POST['txtAddPositionName']);
  $Add_Item_Code = strtoupper($_POST['txtAddItemCode']);
  $Add_Div_Code = $_POST['txtAddDivision'];
  $Add_Unit_Code = $_POST['txtAddUnit'];
  $Add_Employment = $_POST['txtAddEmploymentStatus'];
  $Add_Status = $_POST['txtAddStatus']; 
  $Add_Fund_Source = $_POST['txtAddFundSource'];
  $Add_Created_Date = $_POST['txtAddCreatedDate'];
  $Added_By = $_SESSION['user_id']; 
  $Add_Grade = $_POST['txtAddSalaryGrade'];
  $Add_Increment = $_POST['txtAddStepIncrement'];
  $Add_SalaryId = $_POST['txtSalaryId'];
  $Add_Position_Level = $_POST['txtAddPositionLevel'];
  $Add_Station_Code = $_POST['txtAddPositionStation'];


  $Add_New_Pos_Output = $conn -> query("SELECT * from `lib_position` WHERE `item_code` = '$Add_Item_Code'") or die(mysqli_error());
  $Add_New_Query = $Add_New_Pos_Output -> num_rows;
    if($Add_New_Query ==1)
{
  echo '
  <script>
    alert("Position Already Exists!");
    window.location = "list_position.php"
  </script>
  ';
}
  else
{
  $conn -> query("INSERT INTO lib_position (position_code,position_name,item_code,added_by,division_code,unit_code,status_code,employment_id,fund_source_code,date_creation_position,station_code,position_level) 
    VALUES('','$Add_Pos_Name','$Add_Item_Code','$Added_By','$Add_Div_Code','$Add_Unit_Code','$Add_Status','$Add_Employment','$Add_Fund_Source','$Add_Created_Date','$Add_Station_Code','$Add_Position_Level')");

   $conn -> query("INSERT INTO lib_position_salary (item_code, salary_id) 
    VALUES('$Add_Item_Code',$Add_SalaryId)");

  echo '
    <script>
    alert("New Position Successfully Added!");
    window.location = "list_position.php"
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
          <div class="box box-primary">  
                      <div class="box-header with-border">
                        <h4 class="box-title">List of Position</h4>
                        <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Position</a>
                      </div>  
              <div class="box-body">
                <?php
               $Position_sql = "SELECT lib_position.position_code, lib_position.position_name, employment_lib.employment_name, lib_division.division_name, lib_unit.unit_name, lib_position.item_code, lib_status.status_name, employment_lib.employment_id, lib_division.division_code, lib_unit.unit_code, lib_status.status_code, lib_fund_source.fund_source_name, lib_position.date_creation_position, salary.grade, lib_position.position_level, lib_official_station.station_name, lib_official_station.station_code, salary.salary 
                  FROM lib_position
                  INNER JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id
                  INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
                  INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
                  INNER JOIN lib_status ON lib_status.status_code = lib_position.status_code
                  LEFT JOIN lib_fund_source ON lib_fund_source.fund_source_code = lib_position.fund_source_code
                  INNER JOIN lib_official_station on lib_official_station.station_code = lib_position.station_code
                  LEFT JOIN lib_position_salary ON lib_position_salary.item_code = lib_position.item_code
                  LEFT JOIN salary ON lib_position_salary.salary_id = salary.id
                  GROUP BY lib_position.position_code, lib_position.position_name, employment_lib.employment_name, lib_division.division_name, lib_unit.unit_name, lib_position.item_code, lib_status.status_name, employment_lib.employment_id, lib_division.division_code, lib_unit.unit_code, lib_status.status_code, lib_fund_source.fund_source_name, lib_position.date_creation_position, salary.grade, lib_position.position_level, lib_official_station.station_name, lib_official_station.station_code, salary.salary
                  ";

                    $Position_result = mysqli_query($conn,$Position_sql) or die(mysqli_error());
                    echo "<table id='tbl_output' class='table table-bordered table-striped dataTable text-center' style = 'width: 100%;'>";
                    echo "<thead>
                            <th>Division</th>
                            <th>Unit</th>
                            <th>Office Location/Official Station</th>
                            <th>Item Code</th>
                            <th>Position Name</th>
                            <th>Salary Grade</th>
                            <th>Position level</th>
                            <th>Monthly Salary</th>
                            <th>Employment Status</th>
                            <th>Fund Source</th>
                            <th>Date Created</th> 
                            <th>Status(filled/Unfilled)</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    $loop_count = 1;
                    while($Position_output = mysqli_fetch_array($Position_result)){
                    $Position_Code = $Position_output['position_code'];
                    $Position_Name = $Position_output['position_name'];
                    $Employment_Name = $Position_output['employment_name'];
                    $Division_Name = $Position_output['division_name'];
                    $Unit_Name = $Position_output['unit_name'];
                    $Item_Code = $Position_output['item_code'];
                    $Status_Name = $Position_output['status_name'];
                    $Employment_ID = $Position_output['employment_id'];
                    $Division_Code = $Position_output['division_code'];
                    $Unit_Code = $Position_output['unit_code'];
                    $Status_Code = $Position_output['status_code'];
                    $Fund_Source_Code = $Position_output['fund_source_name'];
                    $Created_Date = $Position_output['date_creation_position'];
                    $Salary_Grade = $Position_output['grade'];
                    $Position_level = $Position_output['position_level'];
                    $Monthly_Salary = number_format($Position_output['salary']);
                    $OLOS_Name = $Position_output['station_name'];
                    $Station_Code = $Position_output['station_code'];
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Position_Code?>">
                    <td><?=$Division_Name?></td>
                    <td><?=$Unit_Name?></td>
                    <td><?=$OLOS_Name?></td>
                    <td><?=$Item_Code?></td>
                    <td><?=$Position_Name?></td>
                    <td><?=$Salary_Grade?></td>
                    <td><?=$Position_level?></td>
                    <td><?=$Monthly_Salary?></td>
                    <td><?=$Employment_Name?></td>
                    <td><?=$Fund_Source_Code?></td> 
                    <td><?=$Created_Date?></td>   
                    <td><?=$Status_Name?></td>    
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Position_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Position_Code?>" value = "<?=$Position_Code?>" title="Edit Position"><i class="fa fa-edit" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
<!--Modal Pop up for Approve-->

                                        <div class="modal fade" id="modalEdit<?=$Position_Code?>" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Updating Position Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="Editmodalbody">
                                                              <!--HIDDEN-->
                                                                    <div class="row"  hidden="true">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Position Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditPositionCode" class="form-control border-input" readonly="true" value="<?=$Position_Code?>">
                                                                        </div>
                                                                    </div>
                                                              <!--HIDDEN-->      
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Item Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditItemCode" class="form-control border-input" value="<?=$Item_Code?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                      <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Office Location/Official Station:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
<!--                                                                             <input type="text" name="txtEditStation" class="form-control border-input" value="<?=$OLOS_Name?>" style="text-transform: uppercase;">  -->
                                                                            <select class="form-control select2" style="width: 100%" id="txtEditStation<?=$loop_count?>" name="txtEditStation">
                                                                            <?php
                                                                            echo fill_List_Position_Update_Station($connP,$Station_Code);
                                                                            ?>
                                                                          </select>                                                                            
                                                                        </div>
                                                                    </div>                                                                                                                                    
<!--                                                                     <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Position Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditPositionName" class="form-control border-input" value="<?=$Position_Name?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div> -->
<!--                                                                     <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Status:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <select class="form-control" id="txtEditEmployment" name="txtEditEmployment">
                                                                            <?php
                                                                              //echo fill_List_Position_Update_Employment($connP,$Employment_ID);
                                                                            ?>
                                                                          </select>
                                                                        </div>
                                                                    </div>   -->
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Division:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <select class="form-control select2" style="width:100%" id="txtEditDivision<?=$loop_count?>" name="txtEditDivision">
                                                                            <?php
                                                                              echo fill_List_Position_Update_Division($connP,$Division_Code);
                                                                            ?>
                                                                          </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <select class="form-control select2" style="width:100%" id="txtEditUnit<?=$loop_count?>" name="txtEditUnit">
                                                                             
                                                                             <?php
                                                                              echo fill_List_Position_Update_Unit($connP,$Unit_Code);
                                                                            ?>
                                                                            
                                                                          </select>
                                                                        </div>
                                                                        </div>
<!--                                                                     <div class="row">
                                                                      <div class="col-md-4 text-left float-left">
                                                                        Created Date
                                                                      </div>
                                                                      <div class="col-md-8 text-left float-left">
                                                                        <input type="date" name="txtEditCreatedDate" id = "txtEditCreatedDate<?=$loop_count?>" class="form-control" value="<?=$Created_Date?>" style="text-transform: uppercase;">
                                                                      </div>
                                                                    </div> -->
                                                                    
<!--                                                                     <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status(Filled/Unfilled):
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <select class="form-control" id="txtEditStatus<?=$loop_count?>" name="txtEditStatus">
                                                                             
                                                                             <?php
                                                                              //echo fill_List_Position_Update_Status($connP,$Status_Code);
                                                                            ?>
                                                                            
                                                                          </select>
                                                                        </div>
                                                                    </div>    -->                                                                         
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
                          <?php 

                            echo '<script>
                                    jQuery("#txtEditDivision'.$loop_count.'").on("change",function(){
                                        var updatedivisionAction = jQuery(this).attr("id");
                                        var update_division_id = jQuery(this).val();
                                        if(update_division_id){
                                          jQuery.ajax({
                                              url:"includes/db_functions.php",
                                              method:"POST",
                                              data:{updatedivisionAction:updatedivisionAction, update_division_id:update_division_id},
                                              success:function(data){
                                                 jQuery("#txtEditUnit'.$loop_count.'").html(data);
                                              }
                                          });

                                        }else{
                                          jQuery("#txtEditUnit'.$loop_count.'").html("<option value=\'\'>SELECT DIVISION FIRST</option>");
                                        }
                                        
                                  });
                                </script>';

                          $loop_count++; 
                        } ?> 
                                           </table>
                                       </tbody>
<!--Modal Pop up for Add New-->
                                        <div class="modal fade" id="modalAddNewModal" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmAdd" method="POST">
                                                    <div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Add New Position Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="AddNewmodalbody">
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Division:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%" id="txtAddDivision" name="txtAddDivision" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_division($connP, null);
                                                                         ?>
                                                                      </select>                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <select class="form-control select2" style="width: 100%" id="txtAddUnit" name="txtAddUnit" required="true">
                                                                              <option value="">SELECT DIVISION FIRST</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Office Location/Official Station:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%" id="txtAddPositionStation" name="txtAddPositionStation" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_Station($connP, null);
                                                                         ?>
                                                                      </select>                                                                           
                                                                        </div>
                                                                    </div>                                                                                                                                                                                             
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Item Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddItemCode" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div>  
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Position:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddPositionName" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Salary Grade:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%"  id="txtAddSalaryGrade" name="txtAddSalaryGrade" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_Salary_Grade($connP, null);
                                                                         ?>
                                                                      </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Position Level:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="number" name="txtAddPositionLevel" id = "txtAddPositionLevel" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" hidden="true">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Step Increment:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="number" name="txtAddStepIncrement" id ="txtAddStepIncrement"class="form-control border-input" value="1" style="text-transform: uppercase;" readonly="true">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Monthly Salary
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtSalary" id="txtSalary" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
                                                                            <input type="hidden" name="txtSalaryId" id="txtSalaryId" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
                                                                        </div>
                                                                    </div>               


                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Status:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%" id="txtAddEmploymentStatus" name="txtAddEmploymentStatus" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_Employment_Status($connP, null);
                                                                         ?> 
                                                                      </select> 
                                                                    </div>
                                                                  </div>
                                                                   <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Fund Source:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%" id="txtAddFundSource" name="txtAddFundSource" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_Fund_Source($connP, null);
                                                                         ?>
                                                                      </select> 
                                                                        </div>
                                                                    </div>   
                                                                   <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                         Created Date:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                          <input type="date" name="txtAddCreatedDate" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div>                                                                                                                                     
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status(filled/unfilled):
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                        <select class="form-control select2" style="width: 100%" id="txtAddStatus" name="txtAddStatus" required="true">
                                                                         <?php
                                                                         echo fill_List_Position_Status($connP, null);
                                                                         ?>
                                                                      </select> 
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

  <script> 
$('#tbl_output').DataTable({
responsive: true,
});




   //kapag meg select add division
        
        //add
       jQuery(document).ready(function() {

        jQuery("#txtAddDivision").on('change',function(){
            var divisionAction = jQuery(this).attr("id");
            var division_id = jQuery(this).val();
            if(division_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{divisionAction:divisionAction, division_id:division_id},
                success:function(data){
                    jQuery('#txtAddUnit').html(data);
                }
            });
            }else{
                jQuery('#txtAddUnit').html('<option value="">SELECT DIVISION FIRST</option>');
            }
        });

        
        jQuery("#txtAddSalaryGrade").on('change',function(){
            var SG_id = jQuery(this).val(); 
            let PosLevel = "";
            if(SG_id < 11){
                PosLevel = 1;
            }
            else if(SG_id > 10 && SG_id < 25){
              PosLevel = 2;
            }
            else{
              PosLevel = 3;
            }
            jQuery('#txtAddPositionLevel').val(PosLevel);



            let positionLevelAction = 'positionLevelAction';
            jQuery.ajax({
              url:"includes/db_functions.php",
              method:"POST",
              data:{positionLevelAction:positionLevelAction, SG_id:SG_id},
              success:function(data){
                var json_data = JSON.parse(data);

                jQuery('#txtSalary').val(json_data.salary);
                jQuery('#txtSalaryId').val(json_data.id);
              }
            });
        });

      });

</script>
</body>
</html>
