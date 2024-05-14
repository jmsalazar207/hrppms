<?php

include 'includes/hrppms_session.php';
include 'includes/db_functions.php';
include 'includes/conn.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


## Search 
$searchQuery = " WHERE userprofile.item_code !='' AND userprofile.empno !='' AND pds_personal_information.empno !='' AND userprofile.updated ='1' ";
if($searchValue != ''){
   $searchQuery .= " AND (userprofile.empno LIKE '%$searchValue%' OR
                  userprofile.item_code LIKE '%$searchValue%' OR
                  lib_position.position_name LIKE '%$searchValue%' OR
                  lib_position.item_code LIKE '%$searchValue%' OR
                  pds_personal_information.surname LIKE '%$searchValue%' OR
                  pds_personal_information.firstname LIKE '%$searchValue%' OR
                  pds_personal_information.middlename LIKE '%$searchValue%' OR
                  lib_division.division_name LIKE '%$searchValue%' OR
                  lib_unit.unit_name LIKE '%$searchValue%' OR
                  lib_official_station.station_name LIKE '%$searchValue%') ";
}

## Total number of records without filtering
$sqlall = "SELECT COUNT(userprofile.item_code) AS allcount
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
                  LEFT JOIN lib_citizenship ON lib_citizenship.citizenship_code = pds_personal_information.citizenship ".$searchQuery;
$records = mysqli_query($conn,$sqlall) or die(mysqli_error($conn));
$total_count = mysqli_fetch_assoc($records);
$totalRecords = $total_count['allcount'];


## Total number of records with filtering
$sqlfilter = "SELECT COUNT(userprofile.item_code) AS allcount
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
                  LEFT JOIN lib_citizenship ON lib_citizenship.citizenship_code = pds_personal_information.citizenship ".$searchQuery;
$records = mysqli_query($conn,$sqlfilter) or die(mysqli_error($conn));
$filter_count = mysqli_fetch_assoc($records);
$totalRecordwithFilter = $filter_count['allcount'];


## Fetch records
$sqllist = "SELECT pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension, userprofile.date_original_appointment, userprofile.date_last_promotion, userprofile.date_first_entry, lib_sex.sex_name, pds_personal_information.sex, pds_personal_information.date_of_birth, pds_personal_information.age, lib_civil_status.civil_status_name, pds_personal_information.civil_status, pds_personal_information.citizenship, lib_citizenship.citizenship_name, pds_personal_information.mobile_no, pds_personal_information.email_address,userprofile.empno, userprofile.password, userprofile.item_code, lib_position.position_name, lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, lib_parenthetical_title.parenthetical_code, lib_parenthetical_title.parenthetical_name, lib_position.position_level, salary.grade, salary.salary, userprofile.increment, lib_designation.designation_name, userprofile.designation_code, userprofile.designation_date, lib_special_order.special_order_no, userprofile.special_order_code, lib_obsp.obsp_name, lib_obsp.obsp_code, lib_fund_source.fund_source_code, lib_fund_source.fund_source_name, employment_lib.employment_name, lib_status.status_name, lib_mode_accession.mode_accession_name, lib_mode_accession.mode_accession_code, userprofile.date_filled_up, lib_position.division_code, lib_position.unit_code, lib_position.station_code
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
                  LEFT JOIN lib_citizenship ON lib_citizenship.citizenship_code = pds_personal_information.citizenship";

$group_by = " GROUP BY pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension, userprofile.date_original_appointment, userprofile.date_last_promotion, userprofile.date_first_entry, lib_sex.sex_name, pds_personal_information.sex, pds_personal_information.date_of_birth, pds_personal_information.age, lib_civil_status.civil_status_name, pds_personal_information.civil_status, pds_personal_information.citizenship, lib_citizenship.citizenship_name, pds_personal_information.mobile_no, pds_personal_information.email_address,userprofile.empno, userprofile.password, userprofile.item_code, lib_position.position_name, lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, lib_parenthetical_title.parenthetical_code, lib_parenthetical_title.parenthetical_name, lib_position.position_level, salary.grade, salary.salary, userprofile.increment, lib_designation.designation_name, userprofile.designation_code, userprofile.designation_date, lib_special_order.special_order_no, userprofile.special_order_code, lib_obsp.obsp_name, lib_obsp.obsp_code, lib_fund_source.fund_source_code, lib_fund_source.fund_source_name, employment_lib.employment_name, lib_status.status_name, lib_mode_accession.mode_accession_name, lib_mode_accession.mode_accession_code, userprofile.date_filled_up, lib_position.division_code, lib_position.unit_code, lib_position.station_code";

$sql_records = "$sqllist $searchQuery $group_by ORDER BY $columnName $columnSortOrder limit $row, $rowperpage";
/* */
$Position_result = mysqli_query($conn,$sql_records) or die(mysqli_error($conn));

$data = array();

while($Position_output = mysqli_fetch_array($Position_result)){
   $item_code = $Position_output['item_code'];
/*   echo $EmpNo;
   die();*/
   $action = "<td class='center' style='text-align: center;'>
                   <button class='btn btn-primary btn-sm btnEdit' id='btnEdit' name ='btnEdit' value= '$item_code' onclick='modalEdit(this.value)'  title='Edit Position'><i class='fa fa-eye' aria-hidden='true'> </i></button>
                    </td>";

   $data[] = array(
      'empno' => $Position_output['empno'],
      'item_code' => $Position_output['item_code'],
      'position_name' => $Position_output['position_name'],
      'surname' => $Position_output['surname'],
      'firstname' => $Position_output['firstname'],
      'middlename' => $Position_output['middlename'],
/*      'division_name' => $Position_output['division_name'],
      'unit_name' => $Position_output['unit_name'],
      'station_name' => $Position_output['station_name'],*/
      'action' => $action
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);
