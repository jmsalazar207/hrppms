<?php

	$connP = mysqli_connect('172.31.32.22', 'aics_staging', 'P@ssw0rd1.', 'dtr');
    $output = '';
//Drop down menu for Employment Status when Adding (Position.php)
function fill_List_Position_Employment_Status($connP,$employment_code=0){
    $employment_sql="SELECT employment_id, employment_name, employment_description, date_added, added_by FROM employment_lib WHERE deleted = 2";
    $employment="";
    $divoutput = $connP->prepare($employment_sql);
    $divoutput->execute();
    $divoutput->bind_result($employment_id, $employment_name, $employment_description, $date_added, $added_by);
    $employment .= '<option value="">SELECT EMPLOYMENT STATUS</option>';
    while($divoutput->fetch()){
       $employment .= '<option value='.$employment_id. ($employment_code==$employment_id?" selected":"") . ' >' .$employment_name.'</option>';
   }
    return $employment;
}

//Drop down menu for Status when Adding (Position.php)
function fill_List_Position_Status($connP,$status_id=0){
    $status_sql="SELECT status_code, status_name, status_description, date_added, added_by FROM lib_status";
    $status="";
    $divoutput = $connP->prepare($status_sql);
    $divoutput->execute();
    $divoutput->bind_result($status_code, $status_name, $status_description, $date_added, $added_by);
    $status .= '<option value="">SELECT STATUS</option>';
    while($divoutput->fetch()){
       $status .= '<option value='.$status_code. ($status_id==$status_code?" selected":"") . ' >' .$status_name.'</option>';
   }
    return $status;
}
//Drop down menu for Fund Source when Adding (Position.php)
function fill_List_Position_Fund_Source($connP,$fund_source_id=0){
    $fund_source_sql="SELECT fund_source_code, fund_source_name, fund_source_description, date_added, added_by FROM lib_fund_source WHERE deleted = 2";
    $fund_source="";
    $divoutput = $connP->prepare($fund_source_sql);
    $divoutput->execute();
    $divoutput->bind_result($fund_source_code, $fund_source_name, $fund_source_description, $date_added, $added_by);
    $fund_source .= '<option value="">SELECT FUND SOURCE</option>';
    while($divoutput->fetch()){
       $fund_source .= '<option value='.$fund_source_code. ($fund_source_id==$fund_source_code?" selected":"") . ' >' .$fund_source_name.'</option>';
   }
    return $fund_source;
}
//Drop down menu for Employment Status when Updating (Position.php)
   function fill_List_Position_Update_Employment($dtr,$Employment_ID=0){
        $employment_update_output = '';
        $employment_update_sql = "SELECT * FROM employment_lib ORDER BY employment_name";
        $employment_update_result = mysqli_query($dtr, $employment_update_sql);
        $employment_update_output .= "<option value=''>SELECT STATUS OF EMPLOYMENT</option>";
        while($employment_update_row = mysqli_fetch_array($employment_update_result)){
          $employment_code = $employment_update_row["employment_id"];
          $employment_name = $employment_update_row["employment_name"];
            $employment_update_output .= "<option value='$employment_code' ".($Employment_ID==$employment_code?'selected':'')."> $employment_name</option>";
        }
        return $employment_update_output;
    } 
//Drop down menu for Status(filled/unfilled) when Updating (Position.php)
   function fill_List_Position_Update_Status($dtr,$UPDATEStatus_ID=0){
        $status_update_output = '';
        $status_update_sql = "SELECT * FROM lib_status ORDER BY status_name";
        $status_update_result = mysqli_query($dtr, $status_update_sql);
        $status_update_output .= "<option value=''>SELECT STATUS</option>";
        while($status_update_row = mysqli_fetch_array($status_update_result)){
          $status_code = $status_update_row["status_code"];
          $status_name = $status_update_row["status_name"];
            $status_update_output .= "<option value='$status_code' ".($UPDATEStatus_ID==$status_code?'selected':'')."> $status_name</option>";
        }
        return $status_update_output;
    }   
    //Drop down menu for Salary when Adding (Position.php)
function fill_List_Position_Salary_Grade($connP,$sg_id=0){
     $salary_sql="SELECT DISTINCT grade FROM salary";
    $salary="";
    $divoutput = $connP->prepare($salary_sql);
    $divoutput->execute();
    $divoutput->bind_result($grade);
    $salary .= '<option value="">SELECT SALARY GRADE</option>';
    while($divoutput->fetch()){
       $salary .= '<option value='.$grade. ($sg_id==$grade?" selected":"") . ' >' .$grade.'</option>';
   }
    return $salary;
} 
//Drop down menu for division when Adding (Position.php)
function fill_List_Position_Station($connP,$station_id=0){
    $station_sql="SELECT station_code, station_name, station_description FROM lib_official_station WHERE deleted = 2";
    $station="";
    $divoutput = $connP->prepare($station_sql);
    $divoutput->execute();
    $divoutput->bind_result($station_code, $station_name, $station_description);
    $station .= '<option value="">SELECT OFFICE LOCATION/OFFICIAL STATION</option>';
    while($divoutput->fetch()){
       $station .= '<option value='.$station_code. ($station_id==$station_code?" selected":"") . ' >' .$station_name.'</option>';
   }
    return $station;
}

//Drop down menu for division when Adding (Position.php)
function fill_List_Position_division($connP,$division_id=0){
    $division_sql="SELECT division_code, division_name, division_name_code FROM lib_division WHERE deleted =2";
    $division="";
    $divoutput = $connP->prepare($division_sql);
    $divoutput->execute();
    $divoutput->bind_result($division_code, $division_name, $division_name_code);
    $division .= '<option value="">SELECT DIVISION</option>';
    while($divoutput->fetch()){
       $division .= '<option value='.$division_code. ($division_id==$division_code?" selected":"") . ' >' .$division_name.'</option>';
   }
    return $division;
}
//ONCHANGE Drop down menu for UNIT when selecting Division in Adding (Position.php)
if(isset($_POST["divisionAction"])){
  $unit_output = '';
  $unit_query = "SELECT unit_code, unit_name, unit_name_code, division_code FROM lib_unit WHERE deleted = 2 AND division_code = '".$_POST["division_ids"]."'";
  $unit_result = mysqli_query($connP, $unit_query);
  $unit_output .= '<option value="">SELECT UNIT</option>';
  while($row = mysqli_fetch_array($unit_result))  {
   $unit_output .= '<option value="'.$row["unit_code"].'">'.$row["unit_name"].'</option>';
  }
  echo $unit_output;
}
//ONCHANGE KAPAG MAG SELECT YANG SALARY GRADE IN ADDING POSITION
if(isset($_POST["positionLevelAction"])){
  $unit_query = "SELECT id, salary FROM salary WHERE id = '".$_POST["SG_id"]."'";
  $unit_result = mysqli_query($connP, $unit_query);
  $fetch_data = mysqli_fetch_array($unit_result);
  $salary = [];
  if($fetch_data){
    $salary['salary'] = number_format($fetch_data['salary']);
    $salary['id'] = $fetch_data['id'];
  }
  echo json_encode($salary);

}
//Drop down menu for Division when Updating (Position.php)
   function fill_List_Position_Update_division($dtr,$Division_Code=0){
        $division_update_output = '';
        $division_update_sql = "SELECT * FROM lib_division ORDER BY division_name";
        $division_update_result = mysqli_query($dtr, $division_update_sql);
        $division_update_output .= "<option value=''>SELECT DIVISION</option>";
        while($division_update_row = mysqli_fetch_array($division_update_result)){
          $div_code = $division_update_row["division_code"];
          $div_name = $division_update_row["division_name"];
            $division_update_output .= "<option value='$div_code' ".($Division_Code==$div_code?'selected':'')."> $div_name</option>";
        }
        return $division_update_output;
    }

//Drop down menu for UNIT when Updating (Position.php)
     function fill_List_Position_Update_Unit($dtr,$unit_id=0){ 
        $unit_update_output = '';
        $unit_update_sql = "SELECT * FROM lib_unit ORDER BY unit_name";
        $unit_update_result = mysqli_query($dtr, $unit_update_sql);
        $unit_update_output .= "<option value=''>SELECT UNIT</option>";
        while($unit_update_row = mysqli_fetch_array($unit_update_result)){
          $unit_code = $unit_update_row["unit_code"];
          $unit_name = $unit_update_row["unit_name"];
            $unit_update_output .= "<option value='$unit_code' ".($unit_id==$unit_code?'selected':'')."> $unit_name</option>";
        }
        return $unit_update_output;
    }
//Drop down menu for Division when Updating (Position.php)
   function fill_List_Position_Update_Station ($dtr,$Station_Code=0){
        $station_update_output = '';
        $station_update_sql = "SELECT * FROM lib_official_station ORDER BY station_name";
        $station_update_result = mysqli_query($dtr, $station_update_sql);
        $station_update_output .= "<option value=''>SELECT OFFICE LOCATION/OFFICIAL STATION</option>";
        while($station_update_row = mysqli_fetch_array($station_update_result)){
          $station_code = $station_update_row["station_code"];
          $station_name = $station_update_row["station_name"];
            $station_update_output .= "<option value='$station_code' ".($Station_Code==$station_code?'selected':'')."> $station_name</option>";
        }
        return $station_update_output;
    } 
//Drop down menu for Division when Updating (Position.php)
   function fill_List_Position_Update_Sex ($dtr,$Sex_Code=0){
        $sex_update_output = '';
        $sex_update_sql = "SELECT * FROM lib_sex ORDER BY sex_name";
        $sex_update_result = mysqli_query($dtr, $sex_update_sql);
        $sex_update_output .= "<option value=''>SELECT SEX</option>";
        while($sex_update_row = mysqli_fetch_array($sex_update_result)){
          $sex_code = $sex_update_row["sex_code"];
          $sex_name = $sex_update_row["sex_name"];
            $sex_update_output .= "<option value='$sex_code' ".($Sex_Code==$sex_code?'selected':'')."> $sex_name</option>";
        }
        return $sex_update_output;
    } 
   function fill_List_Position_Update_Mode_Accession ($dtr,$Mode_Accession_Code=0){
        $mode_accession_update_output = '';
        $mode_accession_update_sql = "SELECT * FROM lib_mode_accession WHERE deleted = 2 ORDER BY mode_accession_name";
        $mode_accession_update_result = mysqli_query($dtr, $mode_accession_update_sql);
        $mode_accession_update_output .= "<option value=''>SELECT MODE ACCESSION</option>";
        while($mode_accession_update_row = mysqli_fetch_array($mode_accession_update_result)){
          $mode_accession_code = $mode_accession_update_row["mode_accession_code"];
          $mode_accession_name = $mode_accession_update_row["mode_accession_name"];
            $mode_accession_update_output .= "<option value='$mode_accession_code' ".($Mode_Accession_Code==$mode_accession_code?'selected':'')."> $mode_accession_name</option>";
        }
        return $mode_accession_update_output;
    } 
   function fill_List_Position_Update_Special_Order ($dtr,$Special_Order_Code=0){
        $special_order_update_output = '';
        $special_order_update_sql = "SELECT * FROM lib_special_order WHERE deleted = 2 ORDER BY special_order_no";
        $special_order_update_result = mysqli_query($dtr, $special_order_update_sql);
        $special_order_update_output .= "<option value=''>SELECT SPECIAL ORDER</option>";
        while($special_order_update_row = mysqli_fetch_array($special_order_update_result)){
          $special_order_code = $special_order_update_row["special_order_code"];
          $special_order_no = $special_order_update_row["special_order_no"];
            $special_order_update_output .= "<option value='$special_order_code' ".($Special_Order_Code==$special_order_code?'selected':'')."> $special_order_no</option>";
        }
        return $special_order_update_output;
    } 
//Drop down menu for Division when Updating (Position.php)
   function fill_List_Position_Update_Parenthetical ($dtr,$Parenthetical_Code=0){
        $parenthetical_update_output = '';
        $parenthetical_update_sql = "SELECT * FROM lib_parenthetical_title WHERE deleted = 2 ORDER BY parenthetical_name";
        $parenthetical_update_result = mysqli_query($dtr, $parenthetical_update_sql);
        $parenthetical_update_output .= "<option value=''>SELECT PARENTHETICAL</option>";
        while($parenthetical_update_row = mysqli_fetch_array($parenthetical_update_result)){
          $parenthetical_code = $parenthetical_update_row["parenthetical_code"];
          $parenthetical_name = $parenthetical_update_row["parenthetical_name"];
            $parenthetical_update_output .= "<option value='$parenthetical_code' ".($Parenthetical_Code==$parenthetical_code?'selected':'')."> $parenthetical_name</option>";
        }
        return $parenthetical_update_output;
    }
   function fill_List_Position_Update_New_Position ($dtr,$Item_Code=0){
        $position_update_output = '';
        $position_update_sql = "SELECT * FROM lib_position WHERE item_code != '' AND status_code = 2 ORDER BY item_code";
        $position_update_result = mysqli_query($dtr, $position_update_sql);
        $position_update_output .= "<option value=''>SELECT POSITION</option>";
        while($position_update_row = mysqli_fetch_array($position_update_result)){
          $item_code = $position_update_row["item_code"];
          $position_name = $position_update_row["position_name"];
            $position_update_output .= "<option value='$item_code' ".($Item_Code==$item_code?'selected':'')."> $item_code</option>";
        }
        return $position_update_output;
    }       
   function fill_List_Position_Update_Position ($dtr,$Item_Code=0){
        $position_update_output = '';
        $position_update_sql = "SELECT * FROM lib_position WHERE item_code != '' ORDER BY item_code";
        $position_update_result = mysqli_query($dtr, $position_update_sql);
        $position_update_output .= "<option value=''>SELECT POSITION</option>";
        while($position_update_row = mysqli_fetch_array($position_update_result)){
          $item_code = $position_update_row["item_code"];
          $position_name = $position_update_row["position_name"];
            $position_update_output .= "<option value='$item_code' ".($Item_Code==$item_code?'selected':'')."> $item_code</option>";
        }
        return $position_update_output;
    }              
   function fill_List_Position_Update_Designation  ($dtr,$Designation_Code=0){
        $designation_update_output = '';
        $designation_update_sql = "SELECT * FROM lib_designation WHERE deleted = 2 ORDER BY designation_name";
        $designation_update_result = mysqli_query($dtr, $designation_update_sql);
        $designation_update_output .= "<option value=''>SELECT DESIGNATION</option>";
        while($designation_update_row = mysqli_fetch_array($designation_update_result)){
          $designation_code = $designation_update_row["designation_code"];
          $designation_name = $designation_update_row["designation_name"];
            $designation_update_output .= "<option value='$designation_code' ".($Designation_Code==$designation_code?'selected':'')."> $designation_name</option>";
        }
        return $designation_update_output;
    }   
    
function fill_List_Position_Update_OBSP  ($dtr,$OBSP_Code=0){
        $obsp_update_output = '';
        $obsp_update_sql = "SELECT * FROM lib_obsp WHERE deleted = 2 ORDER BY obsp_name";
        $obsp_update_result = mysqli_query($dtr, $obsp_update_sql);
        $obsp_update_output .= "<option value=''>SELECT OBSP</option>";
        while($obsp_update_row = mysqli_fetch_array($obsp_update_result)){
          $obsp_code = $obsp_update_row["obsp_code"];
          $obsp_name = $obsp_update_row["obsp_name"];
            $obsp_update_output .= "<option value='$obsp_code' ".($OBSP_Code==$obsp_code?'selected':'')."> $obsp_name</option>";
        }
        return $obsp_update_output;
    }           
   function fill_List_Position_Update_Civil_Status ($dtr,$Civil_Status_Code=0){
        $civil_status_update_output = '';
        $civil_status_update_sql = "SELECT * FROM lib_civil_status ORDER BY civil_status_name";
        $civil_status_update_result = mysqli_query($dtr, $civil_status_update_sql);
        $civil_status_update_output .= "<option value=''>SELECT Civil Status</option>";
        while($civil_status_update_row = mysqli_fetch_array($civil_status_update_result)){
          $civil_status_code = $civil_status_update_row["civil_status_code"];
          $civil_status_name = $civil_status_update_row["civil_status_name"];
            $civil_status_update_output .= "<option value='$civil_status_code' ".($Civil_Status_Code==$civil_status_code?'selected':'')."> $civil_status_name</option>";
        }
        return $civil_status_update_output;
    }    
       function fill_List_Position_Update_Citizenship ($dtr,$Citizenship_Code=0){
        $citizenship_update_output = '';
        $citizenship_update_sql = "SELECT * FROM lib_citizenship ORDER BY citizenship_name";
        $citizenship_update_result = mysqli_query($dtr, $citizenship_update_sql);
        $citizenship_update_output .= "<option value=''>SELECT CITIZENSHIP</option>";
        while($citizenship_update_row = mysqli_fetch_array($citizenship_update_result)){
          $citizenship_code = $citizenship_update_row["citizenship_code"];
          $citizenship_name = $citizenship_update_row["citizenship_name"];
            $citizenship_update_output .= "<option value='$citizenship_code' ".($Citizenship_Code==$citizenship_code?'selected':'')."> $citizenship_name</option>";
        }
        return $citizenship_update_output;
    }      


//ONCHANGE Drop down menu for UNIT when selecting Division in Updating (Position.php)
  if(isset($_POST["updatedivisionAction"])){
    $update_unit_output = '';
    $update_unit_query = "SELECT unit_code, unit_name, unit_name_code, division_code FROM lib_unit WHERE deleted = 2 AND division_code = '".$_POST["update_division_id"]."'";
    $update_unit_result = mysqli_query($connP, $update_unit_query);
    $update_unit_output .= '<option value="">SELECT UNIT</option>';
    while($update_row = mysqli_fetch_array($update_unit_result))  {
     $update_unit_output .= '<option value="'.$update_row["unit_code"].'">'.$update_row["unit_name"].'</option>';
    }
    echo $update_unit_output;
  }

//Drop down menu for UNIT when Updating (Unit.php)
     function fill_List_Unit_Update_Division($dtr,$Division_ID=0){ 
        $division_update_output = '';
        $division_update_sql = "SELECT * FROM lib_division ORDER BY division_name";
        $division_update_result = mysqli_query($dtr, $division_update_sql);
        $division_update_output .= "<option value=''>SELECT Division</option>";
        while($division_update_row = mysqli_fetch_array($division_update_result)){
          $division_code = $division_update_row["division_code"];
          $division_name = $division_update_row["division_name"];
            $division_update_output .= "<option value='$division_code' ".($Division_ID==$division_code?'selected':'')."> $division_name</option>";
        }
        return $division_update_output;
    }  
//Drop down menu for division when Adding (Unit.php)
function fill_List_Unit_Add_division($connP,$division_id=0){
    $division_sql="SELECT division_code, division_name, division_name_code FROM lib_division WHERE deleted =2";
    $division="";
    $divoutput = $connP->prepare($division_sql);
    $divoutput->execute();
    $divoutput->bind_result($division_code, $division_name, $division_name_code);
    $division .= '<option value="">SELECT DIVISION</option>';
    while($divoutput->fetch()){
       $division .= '<option value='.$division_code. ($division_id==$division_code?" selected":"") . ' >' .$division_name.'</option>';
   }
    return $division;
}











  //OLD FUNCTIONS----------------------------------------------------------------------------------------------------------------------------------------------------------
 //Drop down ning Position
   function fill_position($dtr){
        $position_output = '';
        $position_sql = "SELECT * FROM lib_position ORDER BY position_name";
        $position_result = mysqli_query($dtr, $position_sql);
        while($position_row = mysqli_fetch_array($position_result)){
            $position_output .= '<option value="'.$position_row["item_code"].'">'.$position_row["item_code"].'</option>';
        }
        return $position_output;
    }
   
 
    //Drop down ning Division keng Update
   function fill_Update_Unit_division($dtr){
        $division_update_output = '';
        $division_update_sql = "SELECT * FROM lib_division ORDER BY division_name";
        $division_update_result = mysqli_query($dtr, $division_update_sql);
        while($division_update_row = mysqli_fetch_array($division_update_result)){
            $division_update_output .= '<option value="'.$division_update_row["division_code"].'">'.$division_update_row["division_name"].'</option>';
        }
        return $division_update_output;
    } 
//Drop down ning Civil Status
function fill_civil_status($connP,$civil_status_id=0){
    $civil_status_sql="SELECT civil_status_code, civil_status_name, civil_status_description FROM lib_civil_status";
    $civil_status="";
    $civil_statusgoutput = $connP->prepare($civil_status_sql);
    $civil_statusgoutput->execute();
    $civil_statusgoutput->bind_result($civil_status_code, $civil_status_name, $civil_status_description);
    $civil_status .= '<option value="">SELECT CIVIL STATUS</option>';
    while($civil_statusgoutput->fetch()){
       $civil_status .= '<option value='.$civil_status_code. ($civil_status_id==$civil_status_code?" selected":"") . ' >' .$civil_status_name.'</option>';
   }
    return $civil_status;
}       
//Drop down ning Sex
function fill_sex($connP,$sex_id=0){
    $sex_sql="SELECT sex_code, sex_name, sex_description FROM lib_sex";
    $sex="";
    $sexgoutput = $connP->prepare($sex_sql);
    $sexgoutput->execute();
    $sexgoutput->bind_result($sex_code, $sex_name, $sex_description);
    $sex .= '<option value="">SELECT SEX</option>';
    while($sexgoutput->fetch()){
       $sex .= '<option value='.$sex_code. ($sex_id==$sex_code?" selected":"") . ' >' .$sex_name.'</option>';
   }
    return $sex;
}
//Drop down ning Region
function fill_region($connP,$region_id=0){
    $region_sql="SELECT region_code, region_name, region_nick FROM lib_regions";
    $region="";
    $rgoutput = $connP->prepare($region_sql);
    $rgoutput->execute();
    $rgoutput->bind_result($region_code,$region_name, $region_nick);
    $region .= '<option value="">SELECT REGION</option>';
    while($rgoutput->fetch()){
       $region .= '<option value='.$region_code. ($region_id==$region_code?" selected":"") . ' >' .$region_name.'</option>';
   }
    return $region;
}
//Kapag Onchange ning region
if(isset($_POST["regionAction"])){
  $province_query = "SELECT prov_code,prov_name FROM lib_provinces WHERE region_code = '".$_POST["region_id"]."'";
  $province_result = mysqli_query($connP, $province_query);
  $province_output .= '<option value="">SELECT PROVINCE</option>';
  while($row = mysqli_fetch_array($province_result))  {
   $province_output .= '<option value="'.$row["prov_code"].'">'.$row["prov_name"].'</option>';
  }
  echo $province_output;
}
//Kapag Onchange ning province
if(isset($_POST["provinceAction"])){
  $city_query = "SELECT city_code, city_name,prov_code FROM lib_cities WHERE prov_code = '".$_POST["province_id"]."'";
  $city_result = mysqli_query($connP, $city_query);
  $city_output .= '<option value="">SELECT CITY</option>';
  while($row = mysqli_fetch_array($city_result))  {
   $city_output .= '<option value="'.$row["city_code"].'">'.$row["city_name"].'</option>';
  }
  echo $city_output;
}
//Kapag Onchange ning city
if(isset($_POST["cityAction"])){
  $brgy_query = "SELECT brgy_code, brgy_name, city_code FROM lib_brgy WHERE city_code = '".$_POST["city_id"]."'";
  $brgy_result = mysqli_query($connP, $brgy_query);
  $brgy_output .= '<option value="">SELECT BARANGAY</option>';
  while($row = mysqli_fetch_array($brgy_result))  {
   $brgy_output .= '<option value="'.$row["brgy_code"].'">'.$row["brgy_name"].'</option>';
  }
  echo $brgy_output;
}
//MODAL EDIT POSITION
if(isset($_POST["position_code"])){
  $position_code = $_POST["position_code"];
  $sqlposition = "SELECT position_code, item_code, station_code, division_code, unit_code FROM lib_position WHERE position_code = $position_code";
  $result = mysqli_query($connP, $sqlposition);

  $position = mysqli_fetch_assoc($result);

  echo json_encode($position);
}

if(isset($_POST["division_id"])){
  $param_division_id = $_POST["division_id"];

  $division_update_output = '';
  $division_update_sql = "SELECT * FROM lib_division WHERE deleted = 2 ORDER BY division_name";
  $division_update_result = mysqli_query($connP, $division_update_sql);
  $division_update_output .= "<option value=''>SELECT DIVISION</option>";
  while($division_update_row = mysqli_fetch_array($division_update_result)){
    $div_code = $division_update_row["division_code"];
    $div_name = $division_update_row["division_name"];
    $division_update_output .= "<option value='$div_code' ".($param_division_id==$div_code?'selected':'')."> $div_name</option>";
  }
  echo $division_update_output;
}


if(isset($_POST["station_code"])){ 
  $param_station_id = $_POST["station_code"];

  $station_update_output = '';
  $station_update_sql = "SELECT * FROM lib_official_station ORDER BY station_name";
  $station_update_result = mysqli_query($connP, $station_update_sql);
  $station_update_output .= "<option value=''>SELECT OFFICE LOCATION/OFFICIAL STATION</option>";
  while($station_update_row = mysqli_fetch_array($station_update_result)){
    $station_code = $station_update_row["station_code"];
    $station_name = $station_update_row["station_name"];
      $station_update_output .= "<option value='$station_code' ".($param_station_id==$station_code?'selected':'')."> $station_name</option>";
  }
  echo $station_update_output;
}


if(isset($_POST["unit_code"])&& isset($_POST['update_region_id'])){ 
    $param_unit_id = $_POST["unit_code"];
    $param_division_id = $_POST['whereDivCode']; 
    $unit_update_output = '';
    $unit_update_sql = "SELECT unit_code,unit_name FROM lib_unit WHERE division_code = '$param_division_id' ORDER BY unit_name";
    $unit_update_result = mysqli_query($connP, $unit_update_sql);
    $unit_update_output .= "<option value=''>SELECT UNIT</option>";
    while($unit_update_row = mysqli_fetch_array($unit_update_result)){
      $unit_code = $unit_update_row["unit_code"];
      $unit_name = $unit_update_row["unit_name"];
        $unit_update_output .= "<option value='$unit_code' ".($param_unit_id==$unit_code?'selected':'')."> $unit_name</option>";
    }
    echo $unit_update_output;
}
//MODAL EDIT STAFF
if(isset($_POST["item_code"])){
  $item_code = $_POST["item_code"];
/*echo $empno;
die();*/
  $sqlstaff = "SELECT userprofile.empno, userprofile.item_code, userprofile.parenthetical_code, userprofile.designation_code, userprofile.designation_date, userprofile.special_order_code, userprofile.obsp_code, userprofile.mode_accession_code, userprofile.date_filled_up, userprofile.date_original_appointment, userprofile.date_first_entry, userprofile.date_last_promotion, pds_personal_information.surname, pds_personal_information.firstname, pds_personal_information.middlename, pds_personal_information.name_extension, pds_personal_information.sex, pds_personal_information.date_of_birth, pds_personal_information.age, pds_personal_information.civil_status, pds_personal_information.citizenship, pds_personal_information.email_address, pds_personal_information.mobile_no, lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, lib_position.position_name, lib_position.position_level, salary.grade, salary.increment, salary.salary, lib_fund_source.fund_source_name, employment_lib.employment_name
FROM userprofile
INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno
INNER JOIN lib_position ON lib_position.item_code = userprofile.item_code
INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
INNER JOIN lib_official_station ON lib_position.station_code = lib_official_station.station_code
INNER JOIN lib_position_salary ON lib_position.item_code = lib_position_salary.item_code
INNER JOIN salary ON lib_position_salary.salary_id = salary.id
LEFT JOIN lib_fund_source ON lib_position.fund_source_code = lib_fund_source.fund_source_code
LEFT JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id
WHERE userprofile.empno != '' AND userprofile.item_code !='' AND userprofile.item_code = '$item_code'";
  $result = mysqli_query($connP, $sqlstaff);
  $staff = mysqli_fetch_assoc($result);

  echo json_encode($staff);
}
if(isset($_POST["extname"])){ 
    $param_extname = $_POST["extname"];
    $extname_update_output = "<option value=''>SELECT EXTENSION NAME</option>";
    $extname_update_output .= "<option value='I' ".($param_extname=='I'?'selected':'').">I</option>";
    $extname_update_output .= "<option value='II' ".($param_extname=='II'?'selected':'').">II</option>";
    $extname_update_output .= "<option value='III' ".($param_extname=='III'?'selected':'').">III</option>";
    $extname_update_output .= "<option value='IV' ".($param_extname=='VI'?'selected':'').">IV</option>";
    $extname_update_output .= "<option value='V' ".($param_extname=='V'?'selected':'').">V</option>";
    $extname_update_output .= "<option value='VI' ".($param_extname=='VI'?'selected':'').">VI</option>";
    $extname_update_output .= "<option value='VII' ".($param_extname=='VII'?'selected':'').">VII</option>";
    $extname_update_output .= "<option value='VIII' ".($param_extname=='VIII'?'selected':'').">VIII</option>";
    $extname_update_output .= "<option value='IX' ".($param_extname=='IX'?'selected':'').">IX</option>";
    $extname_update_output .= "<option value='X' ".($param_extname=='X'?'selected':'').">X</option>";
    $extname_update_output .= "<option value='JR.' ".($param_extname=='JR.'?'selected':'').">JR.</option>";
    $extname_update_output .= "<option value='SR.' ".($param_extname=='SR.'?'selected':'').">SR.</option>" ;
    /*    $extname_update_sql = "SELECT DISTINCT name_extension FROM pds_personal_information";
    $extname_update_result = mysqli_query($connP, $extname_update_sql);
    $extname_update_output .= "<option value=''>SELECT EXTENSION NAME</option>";
    while($extname_update_row = mysqli_fetch_array($extname_update_result)){
      $extname = $extname_update_row["name_extension"];
        $extname_update_output .= "<option value='$extname' ".($param_extname==$extname?'selected':'')."> $extname</option>";
    }*/
    echo $extname_update_output;
}
if(isset($_POST["sex"])){ 

    $param_sex = $_POST["sex"];
    $sex_update_output = '';
    $sex_update_sql = "SELECT * FROM lib_sex ORDER BY sex_name";
    $sex_update_result = mysqli_query($connP, $sex_update_sql);
    $sex_update_output .= "<option value=''>SELECT SEX</option>";
    while($sex_update_row = mysqli_fetch_array($sex_update_result)){
      $sex_code = $sex_update_row["sex_code"];
      $sex_name = $sex_update_row["sex_name"];
        $sex_update_output .= "<option value='$sex_code' ".($param_sex==$sex_code?'selected':'')."> $sex_name</option>";
    }
    echo $sex_update_output;
}
if(isset($_POST["civil_status_code"])){ 

    $param_civil_status_code = $_POST["civil_status_code"];
    $civil_status_code_update_output = '';
    $civil_status_code_update_sql = "SELECT * FROM lib_civil_status ORDER BY civil_status_name";
    $civil_status_code_update_result = mysqli_query($connP, $civil_status_code_update_sql);
    $civil_status_code_update_output .= "<option value=''>SELECT CIVIL STATUS</option>";
    while($civil_status_code_update_row = mysqli_fetch_array($civil_status_code_update_result)){
      $civil_status_code = $civil_status_code_update_row["civil_status_code"];
      $civil_status_name = $civil_status_code_update_row["civil_status_name"];
        $civil_status_code_update_output .= "<option value='$civil_status_code' ".($param_civil_status_code==$civil_status_code?'selected':'')."> $civil_status_name</option>";
    }
    echo $civil_status_code_update_output;
}
if(isset($_POST["citizenship_code"])){ 

    $param_citizenship_code = $_POST["citizenship_code"];
    $citizenship_code_update_output = '';
    $citizenship_code_update_sql = "SELECT * FROM lib_citizenship ORDER BY citizenship_name";
    $citizenship_code_update_result = mysqli_query($connP, $citizenship_code_update_sql);
    $citizenship_code_update_output .= "<option value=''>SELECT CITIZENSHIP</option>";
    while($citizenship_code_update_row = mysqli_fetch_array($citizenship_code_update_result)){
      $citizenship_code = $citizenship_code_update_row["citizenship_code"];
      $citizenship_name = $citizenship_code_update_row["citizenship_name"];
        $citizenship_code_update_output .= "<option value='$citizenship_code' ".($param_citizenship_code==$citizenship_code?'selected':'')."> $citizenship_name</option>";
    }
    echo $citizenship_code_update_output;
}
if(isset($_POST["parenthetical_code"])){ 

    $param_parenthetical_code = $_POST["parenthetical_code"];
    $parenthetical_code_update_output = '';
    $parenthetical_code_update_sql = "SELECT * FROM lib_parenthetical_title WHERE deleted = 2 ORDER BY parenthetical_name";
    $parenthetical_code_update_result = mysqli_query($connP, $parenthetical_code_update_sql);
    $parenthetical_code_update_output .= "<option value=''>SELECT PARENTHETICAL</option>";
    while($parenthetical_code_update_row = mysqli_fetch_array($parenthetical_code_update_result)){
      $parenthetical_code = $parenthetical_code_update_row["parenthetical_code"];
      $parenthetical_name = $parenthetical_code_update_row["parenthetical_name"];
        $parenthetical_code_update_output .= "<option value='$parenthetical_code' ".($param_parenthetical_code==$parenthetical_code?'selected':'')."> $parenthetical_name</option>";
    }
    echo $parenthetical_code_update_output;
}
if(isset($_POST["designation_code"])){ 

    $param_designation_code = $_POST["designation_code"];
    $designation_code_update_output = '';
    $designation_code_update_sql = "SELECT * FROM lib_designation WHERE deleted = 2 ORDER BY designation_name";
    $designation_code_update_result = mysqli_query($connP, $designation_code_update_sql);
    $designation_code_update_output .= "<option value=''>SELECT DESIGNATION</option>";
    while($designation_code_update_row = mysqli_fetch_array($designation_code_update_result)){
      $designation_code = $designation_code_update_row["designation_code"];
      $designation_name = $designation_code_update_row["designation_name"];
        $designation_code_update_output .= "<option value='$designation_code' ".($param_designation_code==$designation_code?'selected':'')."> $designation_name</option>";
    }
    echo $designation_code_update_output;
}
if(isset($_POST["special_order_code"])){ 

    $param_special_order_code = $_POST["special_order_code"];
    $special_order_code_update_output = '';
    $special_order_code_update_sql = "SELECT * FROM lib_special_order WHERE deleted = 2 ORDER BY special_order_no";
    $special_order_code_update_result = mysqli_query($connP, $special_order_code_update_sql);
    $special_order_code_update_output .= "<option value=''>SELECT SPECIAL ORDER NUMBER</option>";
    while($special_order_code_update_row = mysqli_fetch_array($special_order_code_update_result)){
      $special_order_code = $special_order_code_update_row["special_order_code"];
      $special_order_name = $special_order_code_update_row["special_order_no"];
        $special_order_code_update_output .= "<option value='$special_order_code' ".($param_special_order_code==$special_order_code?'selected':'')."> $special_order_name</option>";
    }
    echo $special_order_code_update_output;
}
if(isset($_POST["obsp_code"])){ 

    $param_obsp_code = $_POST["obsp_code"];
    $obsp_code_update_output = '';
    $obsp_code_update_sql = "SELECT * FROM lib_obsp WHERE deleted = 2 ORDER BY obsp_name";
    $obsp_code_update_result = mysqli_query($connP, $obsp_code_update_sql);
    $obsp_code_update_output .= "<option value=''>SELECT OBSP</option>";
    while($obsp_code_update_row = mysqli_fetch_array($obsp_code_update_result)){
      $obsp_code = $obsp_code_update_row["obsp_code"];
      $obsp_name = $obsp_code_update_row["obsp_name"];
        $obsp_code_update_output .= "<option value='$obsp_code' ".($param_obsp_code==$obsp_code?'selected':'')."> $obsp_name</option>";
    }
    echo $obsp_code_update_output;
}
if(isset($_POST["mode_accession_code"])){ 

    $param_mode_accession_code = $_POST["mode_accession_code"];
    $mode_accession_code_update_output = '';
    $mode_accession_code_update_sql = "SELECT * FROM lib_mode_accession WHERE deleted = 2 ORDER BY mode_accession_name";
    $mode_accession_code_update_result = mysqli_query($connP, $mode_accession_code_update_sql);
    $mode_accession_code_update_output .= "<option value=''>SELECT MODE OF ACCESSION</option>";
    while($mode_accession_code_update_row = mysqli_fetch_array($mode_accession_code_update_result)){
      $mode_accession_code = $mode_accession_code_update_row["mode_accession_code"];
      $mode_accession_name = $mode_accession_code_update_row["mode_accession_name"];
        $mode_accession_code_update_output .= "<option value='$mode_accession_code' ".($param_mode_accession_code==$mode_accession_code?'selected':'')."> $mode_accession_name</option>";
    }
    echo $mode_accession_code_update_output;
}
if(isset($_POST["item_number"])){ 

    $param_item_code = $_POST["item_number"];
    $item_code_update_output = '';
    $item_code_update_sql = "SELECT item_code FROM lib_position WHERE item_code !='' AND status_code != 1 OR item_code = '$param_item_code'";
    $item_code_update_result = mysqli_query($connP, $item_code_update_sql);
    $item_code_update_output .= "<option value=''>SELECT ITEM CODE</option>";
    while($item_code_update_row = mysqli_fetch_array($item_code_update_result)){
      $item_code = $item_code_update_row["item_code"];
        $item_code_update_output .= "<option value='$item_code' ".($param_item_code==$item_code?'selected':'')."> $item_code</option>";
    }
    echo $item_code_update_output;
}
//ONCHANGE KAPAG MAG SELECT YANG SALARY GRADE IN ADDING POSITION
if(isset($_POST["ItemNumberAction"])){
  $query = "SELECT lib_division.division_name, lib_unit.unit_name, lib_official_station.station_name, lib_position.date_creation_position, 
                  lib_position.position_name, lib_position.position_level, salary.grade, salary.increment, salary.salary, lib_fund_source.fund_source_name, employment_lib.employment_name
                  FROM lib_position
                  INNER JOIN lib_division ON lib_position.division_code = lib_division.division_code
                  INNER JOIN lib_unit ON lib_position.unit_code = lib_unit.unit_code
                  INNER JOIN lib_official_station ON lib_position.station_code = lib_official_station.station_code
                  INNER JOIN lib_position_salary ON lib_position.item_code = lib_position_salary.item_code
                  INNER JOIN salary ON lib_position_salary.salary_id = salary.id
                  LEFT JOIN lib_fund_source ON lib_position.fund_source_code = lib_fund_source.fund_source_code
                  LEFT JOIN employment_lib ON lib_position.employment_id = employment_lib.employment_id 
                  WHERE lib_position.item_code = '".$_POST["ItemCode"]."'";
                  $result = mysqli_query($connP, $query);
                  $fetch_data = mysqli_fetch_array($result);
                  $item = [];
  if($fetch_data){
    $item['division_name'] = $fetch_data['division_name'];
    $item['unit_name'] = $fetch_data['unit_name'];
    $item['station_name'] = $fetch_data['station_name'];
    $item['date_creation_position'] = $fetch_data['date_creation_position'];
    $item['position_name'] = $fetch_data['position_name'];
    $item['grade'] = $fetch_data['grade'];
    $item['increment'] = $fetch_data['increment'];
    $item['fund_source_name'] = $fetch_data['fund_source_name'];
    $item['employment_name'] = $fetch_data['employment_name'];
    $item['salary'] = number_format($fetch_data['salary']);
    $item['position_level'] = $fetch_data['position_level'];

  }
  echo json_encode($item);

}

//MODAL EDIT POSITION
if(isset($_POST["empno"])){
  $empno = $_POST["empno"];
  $sqlnew = "SELECT userprofile.empno, userprofile.password,pds_personal_information.firstname, pds_personal_information.surname, pds_personal_information.middlename, pds_personal_information.name_extension
    FROM userprofile
    INNER JOIN pds_personal_information ON pds_personal_information.empno = userprofile.empno
    WHERE userprofile.empno = '$empno'";
  $result = mysqli_query($connP, $sqlnew);
  $empno = mysqli_fetch_assoc($result);

  echo json_encode($empno);
}
//Checking ing delete
//MODAL EDIT POSITION
if(isset($_POST["check_division_code"])){
  $check_division_code = $_POST["check_division_code"];
  $sqlcheckdivision = "SELECT COUNT(position_code) AS bilang FROM lib_position WHERE division_code = '$check_division_code'";
  $check_result = mysqli_query($connP, $sqlcheckdivision);

  $result = mysqli_fetch_assoc($check_result);

  echo json_encode($result);
}
if(isset($_POST["check_division_name"])){
  $check_division_name = $_POST["check_division_name"];
  $sqlcheckdivname = "SELECT division_name FROM lib_division WHERE division_code = $check_division_name";
  $div_name_result = mysqli_query($connP, $sqlcheckdivname);
  $check_div_name = mysqli_fetch_assoc($div_name_result);

  echo $check_div_name['division_name'];
}
if(isset($_POST["check_division_name_code"])){
  $check_division_name_code = $_POST["check_division_name_code"];
  $sqlcheckdivnamecode = "SELECT division_name_code FROM lib_division WHERE division_code = $check_division_name_code";
  $div_name_code_result = mysqli_query($connP, $sqlcheckdivnamecode);
  $check_div_name_code = mysqli_fetch_assoc($div_name_code_result);

  echo $check_div_name_code['division_name_code'];
}

// if(isset($_POST["check_unit_name"])){
//   $check_unit_name = $_POST[""];
//   $sqlcheckdivnamecode = "SELECT division_name_code FROM lib_division WHERE division_code = $check_division_name_code";
//   $div_name_code_result = mysqli_query($connP, $sqlcheckdivnamecode);
//   $check_div_name_code = mysqli_fetch_assoc($div_name_code_result);

//   echo $check_div_name_code['division_name_code'];
// }

// Checking ajax ning unit modal

if(isset($_POST["check_unit_code"])){
  $check_unit_code = $_POST["check_unit_code"];
  $sqlcheckunit = "SELECT COUNT(position_code) AS bilang FROM lib_position WHERE unit_code = '$check_unit_code'";
  $check_result_unit = mysqli_query($connP, $sqlcheckunit);

  $result = mysqli_fetch_assoc($check_result_unit);

  echo json_encode($result);
}
if(isset($_POST["check_delete_unit_name"])){
  $check_unit_name = $_POST["check_delete_unit_name"];
  $sqlcheckunitname = "SELECT unit_name FROM lib_unit WHERE unit_code = $check_unit_name";
  $unit_name_result = mysqli_query($connP, $sqlcheckunitname);
  $check_unit_name = mysqli_fetch_assoc($unit_name_result);

  echo $check_unit_name['unit_name'];
}

if(isset($_POST["check_designation_code"])){
  $check_designation_code = $_POST["check_designation_code"];
  $sqlcheckdesignation = "SELECT COUNT(designation_code) AS bilang FROM userprofile WHERE designation_code = '$check_designation_code'";
  $check_result_designation = mysqli_query($connP, $sqlcheckdesignation);

  $result = mysqli_fetch_assoc($check_result_designation);

  echo json_encode($result);
}
if(isset($_POST["check_delete_designation_name"])){
  $check_designation_name = $_POST["check_delete_designation_name"];
  $sqlcheckdesignationname = "SELECT designation_name FROM lib_designation WHERE designation_code = $check_designation_name";
  $designation_name_result = mysqli_query($connP, $sqlcheckdesignationname);
  $check_designation_name = mysqli_fetch_assoc($designation_name_result);

  echo $check_designation_name['designation_name'];
}

if(isset($_POST["check_CS_code"])){
  $check_CS_code = $_POST["check_CS_code"];
  $sqlcheckcs = "SELECT COUNT(employment_id) AS bilang FROM lib_position WHERE employment_id = '$check_CS_code'";
  $check_result_CS = mysqli_query($connP, $sqlcheckcs);

  $result = mysqli_fetch_assoc($check_result_CS);

  echo json_encode($result);
}
if(isset($_POST["check_delete_CS_name"])){
  $check_CS_name = $_POST["check_delete_CS_name"];
  $sqlcheckCSname = "SELECT employment_name FROM employment_lib WHERE employment_id = $check_CS_name";
  $CS_name_result = mysqli_query($connP, $sqlcheckCSname);
  $check_CS_name = mysqli_fetch_assoc($CS_name_result);

  echo $check_CS_name['employment_name'];
}

if(isset($_POST["check_parenthetical_code"])){
  $check_parenthetical_code = $_POST["check_parenthetical_code"];
  $sqlcheckparenthetical = "SELECT COUNT(parenthetical_code) AS bilang FROM userprofile WHERE parenthetical_code = '$check_parenthetical_code'";
  $check_result_parenthetical = mysqli_query($connP, $sqlcheckparenthetical);

  $result = mysqli_fetch_assoc($check_result_parenthetical);

  echo json_encode($result);
}
if(isset($_POST["check_delete_parenthetical_name"])){
  $check_parenthetical_name = $_POST["check_delete_parenthetical_name"];
  $sqlcheckParentheticalTitle = "SELECT parenthetical_name FROM lib_parenthetical_title WHERE parenthetical_code = $check_parenthetical_name";
  $parenthetical_name_result = mysqli_query($connP, $sqlcheckParentheticalTitle);
  $check_parenthetical_name = mysqli_fetch_assoc($parenthetical_name_result);

  echo $check_parenthetical_name['parenthetical_name'];
}
if(isset($_POST["check_FS_code"])){
  $check_FS_code = $_POST["check_FS_code"];
  $sqlcheckfs = "SELECT COUNT(fund_source_code) AS bilang FROM lib_position WHERE fund_source_code = '$check_FS_code'";
  $check_result_fs = mysqli_query($connP, $sqlcheckfs);

  $result = mysqli_fetch_assoc($check_result_fs);

  echo json_encode($result);
}
if(isset($_POST["check_delete_fs_name"])){
  $check_fs_name = $_POST["check_delete_fs_name"];
  $sqlcheckfs = "SELECT fund_source_name FROM lib_fund_source WHERE fund_source_code = $check_fs_name";
  $fs_name_result = mysqli_query($connP, $sqlcheckfs);
  $check_fs_name = mysqli_fetch_assoc($fs_name_result);

  echo $check_fs_name['fund_source_name'];
}

if(isset($_POST["check_MA_code"])){
  $check_MA_code = $_POST["check_MA_code"];
  $sqlcheckma = "SELECT COUNT(mode_accession_code) AS bilang FROM userprofile WHERE mode_accession_code = '$check_MA_code'";
  $check_result_ma = mysqli_query($connP, $sqlcheckma);

  $result = mysqli_fetch_assoc($check_result_ma);

  echo json_encode($result);
}
if(isset($_POST["check_delete_ma_name"])){
  $check_ma_name = $_POST["check_delete_ma_name"];
  $sqlcheckma = "SELECT mode_accession_name FROM lib_mode_accession WHERE mode_accession_code = $check_ma_name";
  $ma_name_result = mysqli_query($connP, $sqlcheckma);
  $check_ma_name = mysqli_fetch_assoc($ma_name_result);

  echo $check_ma_name['mode_accession_name'];
}

if(isset($_POST["check_RSO_code"])){
  $check_RSO_code = $_POST["check_RSO_code"];
  $sqlcheckrso = "SELECT COUNT(special_order_code) AS bilang FROM userprofile WHERE special_order_code = '$check_RSO_code'";
  $check_result_rso = mysqli_query($connP, $sqlcheckrso);

  $result = mysqli_fetch_assoc($check_result_rso);

  echo json_encode($result);
}
if(isset($_POST["check_delete_rso_name"])){
  $check_rso_name = $_POST["check_delete_rso_name"];
  $sqlcheckrso = "SELECT special_order_no FROM lib_special_order WHERE special_order_code = $check_rso_name";
  $rso_name_result = mysqli_query($connP, $sqlcheckrso);
  $check_rso_name = mysqli_fetch_assoc($rso_name_result);

  echo $check_rso_name['special_order_no'];
}

if(isset($_POST["check_OLOS_code"])){
  $check_OLOS_code = $_POST["check_OLOS_code"];
  $sqlcheckolos = "SELECT COUNT(station_code) AS bilang FROM lib_position WHERE station_code = '$check_OLOS_code'";
  $check_result_olos = mysqli_query($connP, $sqlcheckolos);

  $result = mysqli_fetch_assoc($check_result_olos);

  echo json_encode($result);
}

if(isset($_POST["check_delete_olos_name"])){
  $check_olos_name = $_POST["check_delete_olos_name"];
  $sqlcheckolos = "SELECT station_name FROM lib_official_station WHERE station_code = $check_olos_name";
  $station_name_result = mysqli_query($connP, $sqlcheckolos);
  $check_station_name = mysqli_fetch_assoc($station_name_result);

  echo $check_station_name['station_name'];
}

if(isset($_POST["check_OBSP_code"])){
  $check_OBSP_code = $_POST["check_OBSP_code"];
  $sqlcheckobsp = "SELECT COUNT(obsp_code) AS bilang FROM userprofile WHERE obsp_code = '$check_OBSP_code'";
  $check_result_obsp = mysqli_query($connP, $sqlcheckobsp);

  $result = mysqli_fetch_assoc($check_result_obsp);

  echo json_encode($result);
}

if(isset($_POST["check_delete_obsp_name"])){
  $check_delete_obsp_name = $_POST["check_delete_obsp_name"];
  $sqlcheckobsp = "SELECT obsp_name FROM lib_obsp WHERE obsp_code = $check_delete_obsp_name";
  $obsp_name_result = mysqli_query($connP, $sqlcheckobsp);
  $check_obsp_name = mysqli_fetch_assoc($obsp_name_result);

  echo $check_obsp_name['obsp_name'];
}
?>
