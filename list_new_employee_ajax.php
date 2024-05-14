
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
$searchQuery = " WHERE userprofile.updated = '0' ";
if($searchValue != ''){
   $searchQuery .= " AND (userprofile.empno LIKE '%$searchValue%' OR
                  pds_personal_information.surname LIKE '%$searchValue%' OR
                  pds_personal_information.firstname LIKE '%$searchValue%' OR
                  pds_personal_information.middlename LIKE '%$searchValue%' OR
                  pds_personal_information.name_extension LIKE '%$searchValue%') ";
}


## Total number of records without filtering
$sqlall = "SELECT COUNT(userprofile.empno) AS allcount
            FROM userprofile
            INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno" .$searchQuery;
$records = mysqli_query($conn,$sqlall) or die(mysqli_error($conn));
$total_count = mysqli_fetch_assoc($records);
$totalRecords = $total_count['allcount'];


## Total number of records with filtering
$sqlfilter = "SELECT COUNT(userprofile.empno) AS allcount
            FROM userprofile
            INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno ".$searchQuery;
$records = mysqli_query($conn,$sqlfilter) or die(mysqli_error($conn));
$filter_count = mysqli_fetch_assoc($records);
$totalRecordwithFilter = $filter_count['allcount'];


## Fetch records
$sqllist = "SELECT userprofile.empno, userprofile.item_code, userprofile.parenthetical_code, userprofile.designation_code, userprofile.obsp_code, userprofile.designation_date, userprofile.special_order_code, userprofile.mode_accession_code, userprofile.date_filled_up, userprofile.date_original_appointment, userprofile.date_first_entry, pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension
            FROM userprofile
            INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno";
$group_by = " GROUP BY userprofile.empno, userprofile.item_code, userprofile.parenthetical_code, userprofile.designation_code, userprofile.obsp_code, userprofile.designation_date, userprofile.special_order_code, userprofile.mode_accession_code, userprofile.date_filled_up, userprofile.date_original_appointment, userprofile.date_first_entry, pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension";

$sql_records = "$sqllist $searchQuery $group_by ORDER BY $columnName $columnSortOrder limit $row, $rowperpage";

$employee_result = mysqli_query($conn,$sql_records) or die(mysqli_error($conn));

$data = array();

while($employee_output = mysqli_fetch_array($employee_result)){
   $empno = $employee_output['empno'];
   $action = "<td class='center' style='text-align: center;'>
                  <button class='btn btn-primary btn-sm btnEdit' id='btnEdit' name ='btnEdit' value= '$empno' onclick='modalEdit(this.value)'  title='Update Details'>
                  <i class='fa fa-edit' aria-hidden='true'> </i></button>
               </td>";

   $data[] = array(
      'empno' => $employee_output['empno'],
      'surname' => $employee_output['surname'],
      'firstname' => $employee_output['firstname'],
      'middlename' => $employee_output['middlename'],
      'name_extension' => $employee_output['name_extension'],
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
