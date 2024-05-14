
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
$searchQuery = " WHERE lib_position.item_code != '' ";
if($searchValue != ''){
   $searchQuery .= " AND (lib_division.division_name LIKE '%$searchValue%' OR
                  lib_unit.unit_name LIKE '%$searchValue%' OR
                  lib_official_station.station_name LIKE '%$searchValue%' OR
                  lib_position.item_code LIKE '%$searchValue%' OR
                  lib_position.position_name LIKE '%$searchValue%' OR
                  salary.grade LIKE '%$searchValue%' OR
                  lib_position.position_level LIKE '%$searchValue%' OR
                  salary.salary LIKE '%$searchValue%' OR
                  employment_lib.employment_name LIKE '%$searchValue%' OR
                  lib_fund_source.fund_source_name LIKE '%$searchValue%' OR
                  lib_position.date_creation_position LIKE '%$searchValue%' OR
                  lib_status.status_name LIKE '%$searchValue%') ";
}


## Total number of records without filtering
$sqlall = "SELECT COUNT(lib_position.position_code) AS allcount
            FROM lib_position
            INNER JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id
            INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
            INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
            INNER JOIN lib_status ON lib_status.status_code = lib_position.status_code
            LEFT JOIN lib_fund_source ON lib_fund_source.fund_source_code = lib_position.fund_source_code
            INNER JOIN lib_official_station on lib_official_station.station_code = lib_position.station_code
            LEFT JOIN lib_position_salary ON lib_position_salary.item_code = lib_position.item_code
            LEFT JOIN salary ON lib_position_salary.salary_id = salary.id" .$searchQuery;
$records = mysqli_query($conn,$sqlall) or die(mysqli_error($conn));
$total_count = mysqli_fetch_assoc($records);
$totalRecords = $total_count['allcount'];


## Total number of records with filtering
$sqlfilter = "SELECT COUNT(lib_position.position_code) AS allcount
            FROM lib_position
            INNER JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id
            INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
            INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
            INNER JOIN lib_status ON lib_status.status_code = lib_position.status_code
            LEFT JOIN lib_fund_source ON lib_fund_source.fund_source_code = lib_position.fund_source_code
            INNER JOIN lib_official_station on lib_official_station.station_code = lib_position.station_code
            LEFT JOIN lib_position_salary ON lib_position_salary.item_code = lib_position.item_code
            LEFT JOIN salary ON lib_position_salary.salary_id = salary.id ".$searchQuery;
$records = mysqli_query($conn,$sqlfilter) or die(mysqli_error($conn));
$filter_count = mysqli_fetch_assoc($records);
$totalRecordwithFilter = $filter_count['allcount'];


## Fetch records
$sqllist = "SELECT lib_position.position_code, lib_position.position_name, employment_lib.employment_name,
               lib_division.division_name, lib_unit.unit_name, lib_position.item_code, lib_status.status_name,
               employment_lib.employment_id, lib_division.division_code, lib_unit.unit_code, lib_status.status_code,
               lib_fund_source.fund_source_name, lib_position.date_creation_position, salary.grade, lib_position.position_level,
               lib_official_station.station_name, lib_official_station.station_code, salary.salary 
            FROM lib_position
            INNER JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id
            INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
            INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
            INNER JOIN lib_status ON lib_status.status_code = lib_position.status_code
            LEFT JOIN lib_fund_source ON lib_fund_source.fund_source_code = lib_position.fund_source_code
            INNER JOIN lib_official_station on lib_official_station.station_code = lib_position.station_code
            LEFT JOIN lib_position_salary ON lib_position_salary.item_code = lib_position.item_code
            LEFT JOIN salary ON lib_position_salary.salary_id = salary.id";
$group_by = " GROUP BY lib_position.position_code, lib_position.position_name, employment_lib.employment_name,
            lib_division.division_name, lib_unit.unit_name, lib_position.item_code, lib_status.status_name,
            employment_lib.employment_id, lib_division.division_code, lib_unit.unit_code, lib_status.status_code,
            lib_fund_source.fund_source_name, lib_position.date_creation_position, salary.grade, lib_position.position_level,
            lib_official_station.station_name, lib_official_station.station_code, salary.salary";

$sql_records = "$sqllist $searchQuery $group_by ORDER BY $columnName $columnSortOrder limit $row, $rowperpage";

$Position_result = mysqli_query($conn,$sql_records) or die(mysqli_error($conn));

$data = array();

while($Position_output = mysqli_fetch_array($Position_result)){
   $Position_Code = $Position_output['position_code'];
   $action = "<td class='center' style='text-align: center;'>
                  <button class='btn btn-primary btn-sm btnEdit' id='btnEdit' name ='btnEdit' value= '$Position_Code' onclick='modalEdit(this.value)'  title='Edit Position'>
                  <i class='fa fa-edit' aria-hidden='true'> </i></button>
               </td>";

   $data[] = array(
      'division_name' => $Position_output['division_name'],
      'unit_name' => $Position_output['unit_name'],
      'station_name' => $Position_output['station_name'],
      'item_code' => $Position_output['item_code'],
      'position_name' => $Position_output['position_name'],
      'grade' => $Position_output['grade'],
      'position_level' => $Position_output['position_level'],
      'salary' => number_format($Position_output['salary']),
      'employment_name' => $Position_output['employment_name'],
      'fund_source_name' => $Position_output['fund_source_name'],
      'date_creation_position' => $Position_output['date_creation_position'],
      'status_name' => $Position_output['status_name'],
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
