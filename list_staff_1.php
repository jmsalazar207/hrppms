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
  $Edit_LastName = strtoupper($_POST['txtEditLastName']);
  $Edit_FirstName = strtoupper($_POST['txtEditFirstName']);
  $Edit_MiddleName = strtoupper($_POST['txtEditMiddleName']);
  $Edit_ExtName = $_POST['txtEditExtName'];
  $Edit_Sex = $_POST['txtEditSex'];
  $Edit_Birthday = $_POST['txtEditBirthday'];
  $Edit_Age = $_POST['txtEditAge'];
  $Edit_Civil_Status = $_POST['txtEditCivilStatus'];
  $Edit_Citizenship = $_POST['txtEditCitizenship'];
  $Edit_EmailAddress = $_POST['txtEditEmailAddress'];
  $Edit_MobileNo = $_POST['txtEditContactNo'];
  $Edit_EmpNo = $_POST['txtEditEmpNo'];

  $Edit_Parenthetical = $_POST['txtEditParenthetical'];
  $Edit_Designation = $_POST['txtEditDesignation'];
  $Edit_DesignationDate = $_POST['txtDesignationDate'];
  $Edit_SpecialOrder = $_POST['txtEditSpecialOrder'];
  $Edit_OBSP = $_POST['txtEditOBSP'];
  $Edit_ModeAccession = $_POST['txtEditModeAccession'];
  $Edit_FilledUp = $_POST['txtEditDateFilledUp'];
  $Edit_OriginalAppointment = $_POST['txtEditDateOriginal'];
  $Edit_LastPromotion = $_POST['txtEditDatePromotion'];
  $Edit_FirstEntry = $_POST['txtEditDateFirstEntry'];  


  $conn -> query("UPDATE pds_personal_information SET surname = '$Edit_LastName', firstname = '$Edit_FirstName', middlename = '$Edit_MiddleName', name_extension = '$Edit_ExtName', sex = '$Edit_Sex', date_of_birth = '$Edit_Birthday', age = '$Edit_Age', civil_status = '$Edit_Civil_Status', citizenship = '$Edit_Citizenship', email_address = '$Edit_EmailAddress', mobile_no = '$Edit_MobileNo' WHERE empno ='$Edit_EmpNo'");
    
  $conn -> query("UPDATE userprofile SET parenthetical_code ='$Edit_Parenthetical', designation_code ='$Edit_Designation', designation_date ='$Edit_DesignationDate', special_order_code ='$Edit_SpecialOrder', obsp_code ='$Edit_OBSP', mode_accession_code ='$Edit_ModeAccession', date_filled_up ='$Edit_FilledUp', date_original_appointment ='$Edit_OriginalAppointment', date_last_promotion ='$Edit_LastPromotion', date_first_entry ='$Edit_FirstEntry'  WHERE empno ='$Edit_EmpNo'");

    echo "
        <script>
        alert('Employee Information Successfully Updated!');
        window.location = 'list_staff.php';
                </script>
    ";
  
;
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
                        <h4 class="box-title">List of Staff</h4>
                        <!-- <a href="#modalAddNewModal" data-toggle="modal" class="btn btn-info btn-sm btn-round pull-right"><i class="fa fa-plus"></i> Add New Position</a> -->
                      </div>  
              <div class="box-body">
                <?php
               $sql = "SELECT pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension, userprofile.date_original_appointment, userprofile.date_last_promotion, userprofile.date_first_entry, lib_sex.sex_name, pds_personal_information.sex, pds_personal_information.date_of_birth, pds_personal_information.age, lib_civil_status.civil_status_name, pds_personal_information.civil_status, pds_personal_information.citizenship, lib_citizenship.citizenship_name, pds_personal_information.mobile_no, pds_personal_information.email_address,userprofile.empno, userprofile.password, userprofile.item_code, lib_position.position_name, lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, lib_parenthetical_title.parenthetical_code, lib_parenthetical_title.parenthetical_name, lib_position.position_level, salary.grade, salary.salary, userprofile.increment, lib_designation.designation_name, userprofile.designation_code, userprofile.designation_date, lib_special_order.special_order_no, userprofile.special_order_code, lib_obsp.obsp_name, lib_obsp.obsp_code, lib_fund_source.fund_source_code, lib_fund_source.fund_source_name, employment_lib.employment_name, lib_status.status_name, lib_mode_accession.mode_accession_name, lib_mode_accession.mode_accession_code, userprofile.date_filled_up, lib_position.division_code, lib_position.unit_code, lib_position.station_code
                  FROM userprofile
                  INNER JOIN lib_position ON lib_position.item_code = userprofile.item_code
                  INNER JOIN lib_division ON lib_division.division_code = lib_position.division_code
                  INNER JOIN lib_unit ON lib_unit.unit_code = lib_position.unit_code
                  INNER JOIN lib_official_station ON lib_official_station.station_code = lib_position.station_code
                  LEFT JOIN lib_parenthetical_title ON lib_parenthetical_title.parenthetical_code = userprofile.parenthetical_code
                  INNER JOIN lib_position_salary ON lib_position_salary.item_code = lib_position.item_code
                  INNER JOIN salary ON lib_position_salary.salary_id = salary.id 
                  LEFT JOIN lib_designation ON lib_designation.designation_code = userprofile.designation_code
                  LEFT JOIN lib_special_order ON lib_special_order.special_order_code = userprofile.special_order_code
                  LEFT JOIN lib_obsp ON lib_obsp.obsp_code = userprofile.obsp_code
                  LEFT JOIN lib_fund_source ON lib_fund_source.fund_source_code = lib_position.fund_source_code
                  LEFT JOIN employment_lib ON employment_lib.employment_id = lib_position.employment_id 
                  LEFT JOIN lib_status ON lib_status.status_code = lib_position.status_code
                  LEFT JOIN lib_mode_accession ON lib_mode_accession.mode_accession_code = userprofile.mode_accession_code

                  INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno
                  LEFT JOIN lib_sex ON lib_sex.sex_code = pds_personal_information.sex
                  LEFT JOIN lib_civil_status ON lib_civil_status.civil_status_code = pds_personal_information.civil_status
                  LEFT JOIN lib_citizenship ON lib_citizenship.citizenship_code = pds_personal_information.citizenship

                  WHERE userprofile.empno !='' AND userprofile.item_code !='' AND userprofile.updated = '1'
                  GROUP BY pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension, userprofile.date_original_appointment, userprofile.date_last_promotion, userprofile.date_first_entry, lib_sex.sex_name, pds_personal_information.sex, pds_personal_information.date_of_birth, pds_personal_information.age, lib_civil_status.civil_status_name, pds_personal_information.civil_status, pds_personal_information.citizenship, lib_citizenship.citizenship_name, pds_personal_information.mobile_no, pds_personal_information.email_address,userprofile.empno, userprofile.password, userprofile.item_code, lib_position.position_name, lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, lib_parenthetical_title.parenthetical_code, lib_parenthetical_title.parenthetical_name, lib_position.position_level, salary.grade, salary.salary, userprofile.increment, lib_designation.designation_name, userprofile.designation_code, userprofile.designation_date, lib_special_order.special_order_no, userprofile.special_order_code, lib_obsp.obsp_name, lib_obsp.obsp_code, lib_fund_source.fund_source_code, lib_fund_source.fund_source_name, employment_lib.employment_name, lib_status.status_name, lib_mode_accession.mode_accession_name, lib_mode_accession.mode_accession_code, userprofile.date_filled_up, lib_position.division_code, lib_position.unit_code, lib_position.station_code";

                    $sql_result = mysqli_query($conn,$sql) or die(mysqli_error());
                    echo "<table id='tbl_output' class='table table-bordered table-striped dataTable text-center'>";
                    echo "<thead>
                            <th>Employee Number</th>
                            <th>Item Number</th>
                            <th>Position Title</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Division</th>
                            <th>Unit</th>
                            <th>Office Location</th>
                            <th>Action</th>
                          </thead>
                          <tbody>";
                    $loop_count = 1;
                    while($Tbl_output = mysqli_fetch_array($sql_result)){
                    $Position_Name = $Tbl_output['position_name'];
                    $Division_Name = $Tbl_output['division_name'];
                    $Unit_Name = $Tbl_output['unit_name'];
                    $Item_Code = $Tbl_output['item_code'];
                    $Division_Code = $Tbl_output['division_code'];
                    $Unit_Code = $Tbl_output['unit_code'];
                    $EmpNo = $Tbl_output['empno'];
                    $LastName = $Tbl_output['surname'];
                    $MiddleName = $Tbl_output['middlename'];
                    $FirstName = $Tbl_output['firstname'];
                    $Station_Name = $Tbl_output['station_name'];
                    $Station_Code = $Tbl_output['station_code'];
                    $ExtName = $Tbl_output['name_extension'];
                    $Date_Original_Appointment = $Tbl_output['date_original_appointment'];
                    $First_Entry = $Tbl_output['date_first_entry'];
                    $Date_Last_Promotion = $Tbl_output['date_last_promotion'];
                    $Civil_Status_Name = $Tbl_output['civil_status_name'];
                    $Civil_Status_Code = $Tbl_output['civil_status'];
                    $Citizenship = $Tbl_output['citizenship_name'];
                    $Citizenship_Code = $Tbl_output['citizenship'];
                    $Mobile = $Tbl_output['mobile_no'];
                    $Email = $Tbl_output['email_address'];
                    $Date_Creation_Position = $Tbl_output['date_creation_position'];
                    $Parenthetical = $Tbl_output['parenthetical_name'];
                    $Parenthetical_Code = $Tbl_output['parenthetical_code'];
                    $Position_Level = $Tbl_output['position_level'];
                    $Grade = $Tbl_output['grade'];
                    $Salary = number_format($Tbl_output['salary']);
                    $Increment = $Tbl_output['increment'];
                    $Designation_Code = $Tbl_output['designation_code'];
                    $Designation_Name = $Tbl_output['designation_name'];
                    $Designation_Date = $Tbl_output['designation_date'];
                    $Special_Order = $Tbl_output['special_order_no'];
                    $Special_Order_Code = $Tbl_output['special_order_code'];
                    $OBSP_Name = $Tbl_output['obsp_name'];
                    $OBSP_Code = $Tbl_output['obsp_code'];
                    $Fund_Source_Name = $Tbl_output['fund_source_name'];
                    $Fund_Source_Code = $Tbl_output['fund_source_code'];
                    $Employment_Name = $Tbl_output['employment_name'];
                    $Status_Name = $Tbl_output['status_name'];
                    $Mode_Accession_Name = $Tbl_output['mode_accession_name'];
                    $Mode_Accession_Code = $Tbl_output['mode_accession_code'];
                    $Date_Flled_Up = $Tbl_output['date_filled_up'];
                    $Birthday = $Tbl_output['date_of_birth'];
                    $Sex_Code = $Tbl_output['sex'];
                    $Sex_Name = $Tbl_output['sex_name'];
                    $Age = $Tbl_output['age'];
                    ?>
                  <tr class="center" style="text-align: center;" id="<?=$Item_Code?>">
                    <td><?=$EmpNo?></td>
                    <td><?=$Item_Code?></td>
                    <td><?=$Position_Name?></td>
                    <td><?=$LastName?></td>
                    <td><?=$FirstName?></td> 
                    <td><?=$MiddleName?></td> 
                    <td><?=$Division_Name?></td>   
                    <td><?=$Unit_Name?></td>
                    <td><?=$Station_Name?></td>                                                                       
                    <td class="center" style="text-align: center;">
                    <button class="btn btn-primary btn-sm btnEdit" id="<?=$Item_Code?>" name = "btnEdit" data-toggle="modal" href = "#modalEdit<?=$Item_Code?>" value = "<?=$Item_Code?>" title="Modal View"><i class="fa fa-eye" aria-hidden="true"> </i></button>
                    </td>
                  </tr>
<!--Modal Pop up for Approve-->

                                        <div class="modal modal-wide fade" id="modalEdit<?=$Item_Code?>" role = "dialog">
                                            <div class="modal-dialog modal-lg">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Viewing Modal</h4>
                                                        </div>
                                                        <!--Start Modal Body-->
                                                            <div class="modal-body" id="Editmodalbody">
                                                    <!--Start 1st BOX-->
                                                                  <div class="box">
                                                                    <div class="box-header">
                                                                      <h3 class="box-title">Personal Information
                                                                      </h3>
                                                                      <!-- tools box -->
                                                                      <div class="pull-right box-tools">
                                                                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                                                title="Collapse">
                                                                          <i class="fa fa-minus"></i></button>
                                                                      </div>
                                                                    </div>
                                                    <!--START CODE-->
                                                                <div class="box-body pad">
                                                                          <div class="row col-md-12">
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Last Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditLastName" id = "txtEditLastName" class="form-control border-input input-sm" value="<?=$LastName?>" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    First Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditFirstName" id = "txtEditFirstName" class="form-control border-input input-sm" value="<?=$FirstName?>" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Middle Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditMiddleName" id = "txtEditMiddleName" class="form-control border-input input-sm" value="<?=$MiddleName?>" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div> 
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Extention Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <select class="form-control select2" style="width:100%" id="txtEditExtName" name="txtEditExtName">
                                                                                        <option value="<?=$ExtName?>"><?=$ExtName?></option>
                                                                                        <option value="">--</option>
                                                                                        <option value="I">I</option>
                                                                                        <option value="II">II</option>
                                                                                        <option value="III">III</option>
                                                                                        <option value="IV">IV</option>
                                                                                        <option value="V">V</option>
                                                                                        <option value="VI">VI</option>
                                                                                        <option value="VII">VII</option>
                                                                                        <option value="VIII">VIII</option>
                                                                                        <option value="IX">IX</option>
                                                                                        <option value="X">X</option>
                                                                                        <option value="Jr.">Jr.</option>
                                                                                        <option value="Sr.">Sr.</option>
                                                                                      </select>                                                                     
                                                                                  </div>
                                                                              </div>                                                
                                                                          </div>
                                                                            <div class="row row-top col-md-12">
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-11 text-left float-left">
                                                                                      Gender:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <select class="form-control select2" style="width:100%" id="txtEditSex<?=$loop_count?>" name="txtEditSex">
                                                                                    <?php
                                                                                      echo fill_List_Position_Update_Sex($connP,$Sex_Code);
                                                                                    ?>
                                                                                  </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Date of Birth:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <input type="Date" name="txtEditBirthday" id = "txtEditBirthday" class="form-control border-input input-sm" value="<?=$Birthday?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Age:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <input type="text" name="txtEditAge" id = "txtEditAge" class="form-control border-input input-sm" readonly="true" value="<?=$Age?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Civil Status:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <select class="form-control select2" style="width:100%" id="txtEditCivilStatus<?=$loop_count?>" name="txtEditCivilStatus">
                                                                                    <?php
                                                                                      echo fill_List_Position_Update_Civil_Status($connP,$Civil_Status_Code);
                                                                                    ?>
                                                                                  </select>       
                                                                                    </div>
                                                                                </div>                                                                           
                                                                              </div>
                                                                              <div class="row row-top col-md-12">
                                                                                <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Citizenship
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <select class="form-control select2" style="width:100%" id="txtEditCitizenship<?=$loop_count?>" name="txtEditCitizenship">
                                                                                        <?php
                                                                                          echo fill_List_Position_Update_Citizenship($connP,$Citizenship_Code);
                                                                                        ?>
                                                                                      </select>         
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Email Address
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    <input type="text" name="txtEditEmailAddress" id = "txtEditEmailAddress" class="form-control border-input input-sm" value="<?=$Email?>">
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Contact No.
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                     <input type="text" name="txtEditContactNo" id = "txtEditContactNo" class="form-control border-input input-sm" value="<?=$Mobile?>">
                                                                                  </div>
                                                                                </div>                                                                         
                                                                              </div>
                                                                </div>
                                                      <!--END CODE-->                                                      
                                                                  </div> 
                                                                  <!--1st END BOX-->
                                  <!--2nd Start Box-->
                                  <div class="box">
                                    <!--Header-->
                                      <div class="box-header">
                                        <h3 class="box-title">Employment Info</h3>
                                        <!-- tools box -->
                                        <div class="pull-right box-tools">
                                          <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fa fa-minus"></i></button>
                                        </div>
                                      </div>
                                    <!--Header-->
                                      <!--Start Code-->
                                      <div class="box-body pad">
                                        <!--Start 1st Row-->
                                        <div class="row col-md-12">
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Employee Number
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditEmpNo" id = "txtEditEmpNo" class="form-control border-input input-sm" value="<?=$EmpNo?>" readonly>
                                            </div>
                                          </div>                                          
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Division
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditDivisionName" id = "txtEditDivisionName" class="form-control border-input input-sm" value="<?=$Division_Name?>" readonly>
                                            </div>
                                          </div>
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Unit
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditUnitName" id = "txtEditUnitName" class="form-control border-input input-sm" value="<?=$Unit_Name?>" readonly>
                                            </div>
                                          </div>
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Office Location / Official Station
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditOLOS" id = "txtEditOLOS" class="form-control border-input input-sm" value="<?=$Station_Name?>" readonly>
                                            </div>
                                          </div>        
                                        </div>
                                        <!--End 1st Row-->
                                        <!--Start 2nd Row-->
                                        <div class="row row-top col-md-12">
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Item Number
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditItemNumber" id = "txtEditItemNumber" class="form-control border-input input-sm" value="<?=$Item_Code?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Date Creation
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditDateCreation" id = "txtEditDateCreation" class="form-control border-input input-sm" value="<?=$Date_Creation_Position?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Position Title
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditPositionTitle" id = "txtEditPositionTitle" class="form-control border-input input-sm" value="<?=$Position_Name?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Parenthetical Title
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style="width:100%" id="txtEditParenthetical<?=$loop_count?>" name="txtEditParenthetical">
                                                <?php
                                                  echo fill_List_Position_Update_Parenthetical($connP,$Parenthetical_Code);
                                                ?>
                                              </select>  
                                            </div>
                                          </div>                                                
                                        </div>
                                        <!--End 2nd Row-->
                                        <!--Start 3rd Row-->
                                        <div class="row row-top col-md-12">
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Position Level
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditPositionLevel" id = "txtEditPositionLevel" class="form-control border-input input-sm" value="<?=$Position_Level?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              SG
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditGrade" id = "txtEditGrade" class="form-control border-input input-sm" value="<?=$Grade?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Step Increment
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditIncrement" id = "txtEditIncrement" class="form-control border-input input-sm" value="<?=$Increment?>" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Monthly Salary
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditSalary" id = "txtEditSalary" class="form-control border-input input-sm" value="<?=$Salary?>" readonly>
                                            </div>
                                          </div>
                                        </div>
                                        <!--End 3rd Row-->
                                        <!--Start 4th Row-->
                                        <div class="row row-top col-md-12">
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Designation
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                          <select class="form-control select2" style="width:100%"  id="txtEditDesignation<?=$loop_count?>" name="txtEditDesignation">
                                                <?php
                                                  echo fill_List_Position_Update_Designation($connP,$Designation_Code);
                                                ?>
                                              </select>
                                              <!--
<select class="selectpicker form-control" data-container="body" data-live-search="true" data-hide-disabled="true" id="txtEditDesignation<?=$loop_count?>" name="txtEditDesignation">
<?php
//echo fill_List_Position_Update_Designation($connP,$Designation_Code);
?>
</select>
                                              -->
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Designation Date
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                  <input type="date" name="txtDesignationDate" id = "txtDesignationDate" class="form-control border-input input-sm" value="<?=$Designation_Date?>">
                                            </div>
                                          </div> 
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Special Order
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                          <select class="form-control select2" style="width:100%"  id="txtEditSpecialOrder<?=$loop_count?>" name="txtEditSpecialOrder">
                                                <?php
                                                  echo fill_List_Position_Update_Special_Order($connP,$Special_Order_Code);
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Office/Bureau/Service/Program
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                          <select class="form-control select2" style="width:100%"  id="txtEditOBSP<?=$loop_count?>" name="txtEditOBSP">
                                                <?php
                                                  echo fill_List_Position_Update_OBSP($connP,$OBSP_Code);
                                                ?>
                                              </select>
                                            </div>
                                          </div>                            
                                        </div>
                                         <!--End 4th Row-->
                                          <!--Start 5th Row-->
                                          <div class="row row-top col-md-12">
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Fund Source
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditSalary" id = "txtEditSalary" class="form-control border-input input-sm" value="<?=$Fund_Source_Name?>" readonly>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Classification of Employment
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                  <input type="text" name="txtEditEmployment" id = "txtEditEmployment" class="form-control border-input input-sm" value="<?=$Employment_Name?>" readonly>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Mode of Accession
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                <select class="form-control select2" style="width:100%"  id="txtEditModeAccession<?=$loop_count?>" name="txtEditModeAccession">
                                                  <?php
                                                    echo fill_List_Position_Update_Mode_Accession($connP,$Mode_Accession_Code);
                                                  ?>
                                                </select>
                                              </div>
                                            </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date Filled Up:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFilledUp" id = "txtEditDateFilledUp" class="form-control border-input input-sm" value="<?=$Date_Flled_Up?>">
                                                  </div>
                                              </div>                                          
                                          </div>
                                          <!--End 5th row-->
                                          <!--Start 6th Row-->
                                            <div class="row row-top col-md-12">
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date of Original Appointment:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateOriginal" id = "txtEditDateOriginal" class="form-control border-input input-sm" value="<?=$Date_Original_Appointment?>">
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date of Last Promotion:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDatePromotion" id = "txtEditDatePromotion" class="form-control border-input input-sm" value="<?=$Date_Last_Promotion?>">
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date Entry in DSWD:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFirstEntry" id = "txtEditDateFirstEntry" class="form-control border-input input-sm" value="<?=$First_Entry?>">
                                                  </div>
                                              </div>                                                                                                                                          
                                            </div>                                          
                                          <!--End 6th Row-->                                                            
                                      </div>  
                                      <!--End Code-->
                                  </div>
                                  <!--2nd End Box-->                                                          
                                                            </div>
                                                            <!--End Modal Body-->
                                                                <div class="text-center modal-footer">
                                                                    <button type = "button" class = "btn btn-success btn-round btnULupdate" name = "btnULupdate" data-toggle = "modal" href ="#confirm_edit<?=$EmpNo?>">UPDATE</button>
                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                                      <div class="modal modal-confirm fade" id="confirm_edit<?=$EmpNo?>" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title text-left"></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left float-left">
                                                                                            Are you sure you want to Update Employee Information?
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center modal-footer">
                                                                                    <input type="submit" class="btn btn-success btn-round btnyesno" name="btnUpdateYes" value="YES" />
                                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">NO</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                
                                                    </div>                                                       
                                                </form>
                                            </div>
                                        </div>
<!--End Modal Pop up for Approve-->   
                          <?php 
                          $loop_count++; 
                        } ?> 
                                           </table>
                                       </tbody>                        

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

</script>
</body>
</html>

