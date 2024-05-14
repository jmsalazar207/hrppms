<!-- <?php
//  session_start();
//  if(isset($_SESSION['form_data'])){
//  $formdata = $_SESSION['form_data'];
//  unset($_SESSION['form_data']);
//} 
?> -->
<!DOCTYPE html>
<html>
<head>
  <?php
   include 'includes/db_functions.php'; 
  ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="images/dtricon.jpg">
    <title>Human Resource Management Information</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  form i {
    margin-left: -0px;
    cursor: pointer;
}
</style>
<style type="text/css">
  .g-recaptcha {
      transform:scale(0.77);
      -webkit-transform:scale(0.77);
      transform-origin:0 0;
      -webkit-transform-origin:0 0;
      
    }
</style>
<style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: -20px;
  margin-top: 5px;
}

#message p {
  padding: 0px 20px;
  font-size: 12px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -10px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -10px;
  content: "✖";
}
</style>
</head>
<?php
include 'includes/conn.php';
if(isset($_POST['btn_sign_up']))
{
 /* $_SESSION['form_data'] = $_POST;*/
/*CODE*/
        if(empty($_POST['g-recaptcha-response']))
        {
          $_SESSION['error'] = 'Please verify you are not an alien';
        }

    else
    {
      if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
      {
        $secret = "6LeCrsghAAAAAP-DU7KUaTKFeZjwAageuKyp0Gxu";
        $response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      
        $data=json_decode($response);
        if ($data -> success)
        {
            $Add_EmployeeNumber= $_POST['EmployeeNumber'];
            $Add_Password = md5($_POST['ConfirmPassword']);
            $Add_Surname =strtoupper($_POST['AddLastName']);
            $Add_FirstName = strtoupper($_POST['AddFirstName']);
            $Add_MiddleName = strtoupper($_POST['AddMiddleName']);
            $Add_ExtName = strtoupper($_POST['AddextName']);
            $Add_Birthday = $_POST['AddBirthdate'];
            $Add_Sex = $_POST['AddSex'];
            $Add_Civil_Status = $_POST['AddCivilStatus'];
            $Add_MobileNumber = $_POST['AddMobileNo'];
            $Add_EmailAddress = $_POST['AddEmail'];
            $Add_OtherCivil = $_POST['AddOthers'];
            $Add_PlaceBirth = strtoupper($_POST['AddPlaceOfBirth']);
            
            $Add_rNoBldg = $_POST['AddResidentialNoBldg'];
            $Add_rStreet = strtoupper($_POST['AddResidentialStreet']);
            $Add_rSubdivision = $_POST['AddResidentialSubdivision'];
            $Add_rBarangay = $_POST['AddResidentialBrgy'];
            $Add_rCity = $_POST['AddResidentialCity'];
            $Add_rProvince = $_POST['AddResidentialProvince'];
            $Add_rRegion = $_POST['AddResidentialRegion'];
            $Add_rZipCode = $_POST['AddResidentialZipCode'];


            $Add_pNoBldg = $_POST['AddPermanentNoBldg'];
            $Add_pStreet = strtoupper($_POST['AddPermanentStreet']);
            $Add_pSubdivision = $_POST['AddPermanentSubdivision'];
            $Add_pBarangay = $_POST['AddPermanentBrgy'];
            $Add_pCity = $_POST['AddPermanentCity'];
            $Add_pProvince = $_POST['AddPermanentProvince'];
            $Add_pRegion = $_POST['AddPermanentRegion'];
            $Add_pZipCode = $_POST['AddPermanentZipCode'];
            $Add_Newly_Hired_Output = $conn -> query("SELECT * FROM pds_personal_information WHERE surname = '$Add_Surname' AND firstname = '$Add_FirstName' AND middlename = '$Add_MiddleName'") or die(mysqli_error($conn));
              $Add_New_Query = $Add_Newly_Hired_Output -> num_rows;
              if($Add_New_Query ==1)
                {
                  echo '
                  <script>
                    alert("Information Already Register!");
                  </script>
                  ';
                }
                  else
                {
                  $conn -> query("INSERT INTO pds_personal_information(empno, surname, firstname, middlename, name_extension, date_of_birth, place_of_birth, sex, civil_status, other_civil_status, mobile_no, email_address, r_house_block_lot, r_street, r_subdivision_village, r_Areabrgy, r_Areacity, r_Areaprovince, r_Areareg, r_Zipcode, p_house_block_lot, p_street, p_subdivision_village, p_Areabrgy, p_Areacity, p_Areaprovince, p_Areareg, p_Zipcode) 
                    VALUES('$Add_EmployeeNumber','$Add_Surname','$Add_FirstName','$Add_MiddleName','$Add_ExtName','$Add_Birthday','$Add_PlaceBirth','$Add_Sex','$Add_Civil_Status','$Add_OtherCivil','$Add_MobileNumber','$Add_EmailAddress','$Add_rNoBldg','$Add_rStreet','$Add_rSubdivision','$Add_rBarangay','$Add_rCity','$Add_rProvince','$Add_rRegion','$Add_rZipCode','$Add_pNoBldg','$Add_pStreet','$Add_pSubdivision','$Add_pBarangay','$Add_pCity','$Add_pProvince','$Add_pRegion','$Add_pZipCode')");
                  
                  $conn -> query ("INSERT INTO userprofile (empno,password,updated) VALUES ('$Add_EmployeeNumber','$Add_Password','0')");

                  echo '
                    <script>
                      alert("Registration Successfully !");   
                    </script>  ';
                    /*unset($_SESSION['form_data']);*/
                }                

        }
      }
      else
        {
          $_SESSION['error'] = 'Invalid Captcha';
        }

    }
}
?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b>HR</b>PPMS Module</a>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="index.php">
                <span class="hidden-xs">Home</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">

      <!-- Main content -->
      <section class="content">
<!--CODE OF REGISTRATION HERE-->
            <!--Registration form-->
    <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Information</h3>
            </div>
            <form class="form-horizontal" method="POST">
              <div class="box-body">
                    <!--First Row-->
                    <div class="row">
                      <!--First Box-->
                      <div class="col-md-6">
                            <div class="form-group">
                                <label for="LastName" class="col-sm-2 control-label">SURNAME</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="AddLastName" name="AddLastName" placeholder="Surname" value="<?=(isset($formdata)?$formdata['AddLastName']:'')?>" style="text-transform: uppercase;" required="true">
                                </div>
                            </div> 
                            <div class="form-group">
                                  <label for="FirstName" class="col-sm-2 control-label">FIRSTNAME</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="AddFirstName" name="AddFirstName" placeholder="First Name" value="<?=(isset($formdata)?$formdata['AddFirstName']:'')?>" style="text-transform: uppercase;" required="true">
                                </div>                          
                            </div>
                            <div class="form-group">
                                <label for="MiddleName" class="col-sm-2 control-label">MIDDLENAME</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="AddMiddleName" name="AddMiddleName" placeholder="Middle Name" value="<?=(isset($formdata)?$formdata['AddMiddleName']:'')?>" style="text-transform: uppercase;">
                                </div>                              
                            </div>
                            <div class="form-group">
                                <label for="extName" class="col-sm-2 control-label">EXTNAME</label>
                              <div class="col-sm-10">
                                  <select class="form-control select2" id="AddextName" name="AddextName" value="<?=(isset($formdata)?$formdata['AddextName']:'')?>">
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
                                    <option value="Jr.">Jr</option>
                                    <option value="Sr.">Sr</option>
                                  </select>
                              </div>                          
                            </div>
                            <div class="form-group">
                              <label for="AddMobileNo" class="col-sm-2 control-label">Mobile Number</label>
                                <div class="col-sm-10">
                                  <input type="Number" class="form-control" id="AddMobileNo" name="AddMobileNo" placeholder="Mobile Number : 09xxxxxxxxx" style="text-transform: uppercase;" required="true">
                                </div>                          
                            </div>                                           
                      </div>
                       <!--Second Box-->
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="Birthdate" class="col-sm-2 control-label">BIRTHDATE</label>
                            <div class="col-sm-10">
                              <div class="input-group date col-sm-12">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="AddBirthdate" id="AddBirthdate" required="true">
                              </div>
                            </div>
                            </div>
                          <div class="form-group">
                            <label for="PlaceofBirth" class="col-sm-2 control-label">PLACE OF BIRTH</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="AddPlaceOfBirth" name="AddPlaceOfBirth" placeholder="Place of Birth" style="text-transform: uppercase;" required="true">
                            </div>                        
                          </div>
                          <div class="form-group">
                              <label for="sex" class="col-sm-2 control-label">SEX</label>
                              <div class="col-sm-10">
                                    <select class="form-control select2" id="AddSex" name="AddSex" required="true">
                                    <?php
                                     echo fill_sex($connP, null);
                                     ?>
                                    </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="Civil Status" class="col-sm-2 control-label">CIVIL STATUS</label>
                            <div class="col-sm-4">
                              <select class="form-control select2" id="AddCivilStatus" name="AddCivilStatus" required="true">
                                <?php
                                 echo fill_civil_status($connP, null);
                                 ?>
                              </select>                          
                            </div>
                              <label for="Civil Status" class="col-sm-2 control-label">OTHER/S</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="AddOthers" name="AddOthers" placeholder="Other/s" style="text-transform: uppercase;">
                            </div>                                                 
                          </div>
                          <div class="form-group">
                              <label for="AddEmail" class="col-sm-2 control-label">Email Address</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="AddEmail" name="AddEmail" placeholder="Email Address">
                            </div>                        
                          </div>                                                                                                            
                      </div>
                       <!--Second Box-->                
                    </div> 
                <!--END First Row-->
                      <div class="box-header with-border">
                      </div>
                <!--Second Row-->
                <div class="row">
                  <!--First Box-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="font-size: 20px;">Residential Address</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="AddResidentialNoBldg" name="AddResidentialNoBldg" placeholder="House/Block/Lot No." style="text-transform: uppercase;" required="true">
                           <label for="AddResidentialNoBldg" class="col-sm-6" style="font-size: 10px;">House/Block/Lot No.</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="AddResidentialStreet" name="AddResidentialStreet" placeholder="Street" style="text-transform: uppercase;" required="true">
                           <label for="AddResidentialStreet" class="col-sm-6" style="font-size: 10px;">Street</label>
                        </div>                                              
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="AddResidentialSubdivision" name="AddResidentialSubdivision" placeholder="Subdivision / Village" style="text-transform: uppercase;">
                           <label for="AddResidentialSubdivision" class="col-sm-12" style="font-size: 10px;">Subdivision / Village</label>
                        </div>                      
                    </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddResidentialRegion" name="AddResidentialRegion" required="true">
                           <?php
                           echo fill_region($connP, null);
                           ?>
                        </select>
                        <label for="AddResidentialRegion" class="col-sm-12" style="font-size: 10px;">Region</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddResidentialProvince" name="AddResidentialProvince" required="true">
                          <option value="">SELECT REGION FIRST</option>
                        </select>
                        <label for="AddResidentialProvince" class="col-sm-12" style="font-size: 10px;">Province</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddResidentialCity" name="AddResidentialCity" required="true">
                          <option value="">SELECT PROVINCE FIRST</option>
                        </select>
                        <label for="AddResidentialCity" class="col-sm-12" style="font-size: 10px;">City</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddResidentialBrgy" name="AddResidentialBrgy" required="true">
                          <option value="">SELECT CITY FIRST</option>
                        </select>
                        <label for="AddResidentialBrgy" class="col-sm-12" style="font-size: 10px;">Barangay</label>
                        </div>
                      </div> 
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="number" class="form-control" id="AddResidentialZipCode" name="AddResidentialZipCode" placeholder="Zip Code" required="true">
                           <label for="AddResidentialZipCode" class="col-sm-12" style="font-size: 10px;">Zip Code</label>
                        </div>             
                      </div> 
                      <div class="form-group">
                        <div class="col-sm-12">
                          <div class="checkbox">
                            <label style="font-size: 17px;">
                                <input type="checkbox" id="CheckSame" name="CheckSame"> Residential and Permanent addresses are the same 
                            </label>
                          </div>
                        </div>             
                      </div>                       
                                         
                  </div>
                  <!--Second Box-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="font-size: 20px;">Permanent Address</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="AddPermanentNoBldg" name="AddPermanentNoBldg" placeholder="House/Block/Lot No." style="text-transform: uppercase;" required="true">
                           <label for="AddPermanentNoBldg" class="col-sm-6" style="font-size: 10px;">House/Block/Lot No.</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="AddPermanentStreet" name="AddPermanentStreet" placeholder="Street" style="text-transform: uppercase;" required="true">
                           <label for="AddPermanentStreet" class="col-sm-6" style="font-size: 10px;">Street</label>
                        </div>                       
                    </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="AddPermanentSubdivision" name="AddPermanentSubdivision" placeholder="Subdivision/Village" style="text-transform: uppercase;" >
                           <label for="AddPermanentSubdivision" class="col-sm-12" style="font-size: 10px;">Subdivision / Village</label>
                        </div>                        
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddPermanentRegion" name="AddPermanentRegion" required="true">
                           <?php
                           echo fill_region($connP, null);
                           ?>
                        </select>
                        <label for="AddPermanentRegion" class="col-sm-12" style="font-size: 10px;">Region</label>
                        </div>                        
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddPermanentProvince" name="AddPermanentProvince" required="true">
                          <option value="">SELECT REGION FIRST</option>
                        </select>
                        <label for="AddPermanentProvince" class="col-sm-12" style="font-size: 10px;">Province</label>
                        </div>                         
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddPermanentCity" name="AddPermanentCity" required="true">
                          <option value="">SELECT PROVINCE FIRST</option>
                        </select>
                        <label for="AddPermanentCity" class="col-sm-12" style="font-size: 10px;">City</label>
                        </div>                         
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                        <select class="form-control select2" id="AddPermanentBrgy" name="AddPermanentBrgy" required="true">
                          <option value="">SELECT CITY FIRST</option>
                        </select>
                        <label for="AddPermanentBrgy" class="col-sm-12" style="font-size: 10px;">Barangay</label>
                        </div>                         
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="number" class="form-control" id="AddPermanentZipCode" name="AddPermanentZipCode" placeholder="Zip Code" required="true">
                           <label for="AddPermanentZipCode" class="col-sm-12" style="font-size: 10px;">Zip Code</label>
                        </div>                        
                      </div>                                                                                      
                  </div>
                </div>
                <!--END Second Row-->
                      <div class="box-header with-border">
                        <h3 class="box-title">Employment Information</h3>
                      </div>
                <!--Third Row-->
                  <div class="row">
                        <div class="col-md-6">
                            <div class="input-group col-sm-12">
                              <label class="col-sm-12"></label>
                                <input type="text" class="form-control col-sm-10" id="EmployeeNumber" name="EmployeeNumber" placeholder="Enter Employee Number" required="true">
                              <label for="DesiredPassword" class="col-sm-6" style="font-size: 15px;">Employee Number</label>
                            </div>
                            <div class="input-group has-feedback col-sm-12">
                                <input type="password" class="form-control col-sm-10" id="DesiredPassword" name="DesiredPassword" placeholder="Desired Password" required="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                <span class="input-group-addon"><i class="fa fa-eye-slash toggle-DesiredPassword " toggle = "#DesiredPassword"  id="toggleDesiredPassword"></i></span>
                            </div>
                            <label for="DesiredPassword" class="col-sm-6" style="font-size: 15px;">Desired Password</label><br>
                            <div class="input-group has-feedback col-sm-12">
                                <input type="password" class="form-control col-sm-10" id="ConfirmPassword" name = "ConfirmPassword" placeholder="Confirm Password" required="true">
                                <span class="input-group-addon"><i class="fa fa-eye-slash toggle-ConfirmPassword " toggle = "#ConfirmPassword"  id="toggleConfirmPassword"></i></span>
                            </div>
                            <small id='checkmessage'></small>
                            <label for="ConfirmPassword" class="col-sm-12" style="font-size: 15px;">Confirm Password</label>
                        </div>

                        <div class="col-md-6">
                              <div class="col-sm-12" id="message">
                                <h4>Password must contain the following:</h4>
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="special_char" class="invalid">A <b>special character</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                              </div>                                 
                        </div>
                  </div>
                  <!--END Third Row-->
                  <!--Fourth Row-->
                    <div class="row">
                            <div class="col-sm-3">
                              <!-- 6LeCrsghAAAAAP-DU7KUaTKFeZjwAageuKyp0Gxu -->
                              <div class="g-recaptcha" data-sitekey="6LeCrsghAAAAAClYPUayZB0fMI_KUP3IX4RYHssu"></div>
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>                              
                            </div> 
                            <div class="col-sm-9">
                              <div class="box">
                                <p style="font-size: 15px;">By Clicking submit button, <br>I hereby certify that all of the information provided by me in this registration are correct, accurate and complete to the best of my knowledge.
                                </p>
                              </div>
                            </div>                                                 
                    </div>
                   <!--End Fourth Row--> 
            </div>                                                                                                              
              <!-- /.END box-body -->
              <div class="box-footer">
               <!--  <div class="form-group"> -->
                  <div class="col-sm-1">
                    
                  </div>
                  <div class="col-sm-9">
                    
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-default pull-right">Cancel</button>
                  </div>                  
                  <div class="col-sm-1">
                    <button type="submit" class="btn btn-info pull-right" id="btn_sign_up" name="btn_sign_up">Submit</button>
                  </div>  
                <!-- </div> -->
              </div>
              <!-- /.box-footer -->
            </form>
            <?php if(isset($formdata)) unset($formdata); ?>
          </div>
    </section> 
  
    <!--End Registration form-->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>All right reserved</b>
      </div>
      <strong>Copyright &copy; 2018 ICTMU
    </div>
    <!-- /.container -->
  </footer>
</div>

<!-- ./wrapper -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<?php include 'includes/hrppms_scripts.php'; ?>
<script>
  $("#CheckSame").change(function() {
    if(this.checked) {
      rNoBldg = document.getElementById("AddResidentialNoBldg");
      rStreet = document.getElementById("AddResidentialStreet");
      rSubd = document.getElementById("AddResidentialSubdivision");
      rRegion = document.getElementById("AddResidentialRegion");
      rZcode = document.getElementById("AddResidentialZipCode");
          $("#AddPermanentNoBldg").attr("disabled", "disabled");
          $("#AddPermanentStreet").attr("disabled", "disabled");
          $("#AddPermanentSubdivision").attr("disabled", "disabled");
          $("#AddPermanentBrgy").attr("disabled", "disabled");
          $("#AddPermanentCity").attr("disabled", "disabled");
          $("#AddPermanentProvince").attr("disabled", "disabled");
          $("#AddPermanentRegion").attr("disabled", "disabled");
          $("#AddPermanentZipCode").attr("disabled", "disabled");    
      document.getElementById("AddPermanentNoBldg").value = rNoBldg.value;
      document.getElementById("AddPermanentStreet").value = rStreet.value;
      document.getElementById("AddPermanentSubdivision").value = rSubd.value;
      document.getElementById("AddPermanentZipCode").value = rZcode.value;
          $("#AddPermanentRegion").val(rRegion.value).change();
    }
    else
    {
      document.getElementById("AddPermanentNoBldg").value = "";
      document.getElementById("AddPermanentStreet").value = "";
      document.getElementById("AddPermanentSubdivision").value = "";
      document.getElementById("AddPermanentZipCode").value = "";
      $("#AddPermanentRegion").val("").change();
      $("#AddPermanentProvince").val("").change();
      $("#AddPermanentCity").val("").change();
      $("#AddPermanentBrgy").val("").change();

      $("#AddPermanentNoBldg").removeAttr("disabled");
      $("#AddPermanentStreet").removeAttr("disabled");
      $("#AddPermanentSubdivision").removeAttr("disabled");
      $("#AddPermanentBrgy").removeAttr("disabled");
      $("#AddPermanentCity").removeAttr("disabled");
      $("#AddPermanentProvince").removeAttr("disabled");
      $("#AddPermanentRegion").removeAttr("disabled");
      $("#AddPermanentZipCode").removeAttr("disabled");
    }
});
</script>
<script>
$( document ).ready(function() {
    $("#ConfirmPassword").keyup(checkPasswordMatch);
  });
  function checkPasswordMatch() {
        var DesiredPassword = $("#DesiredPassword").val();
        var confirmPassword = $("#ConfirmPassword").val();
        if (DesiredPassword != confirmPassword){
            $("#checkmessage").html("Passwords does not match!").css('color', 'red');
            $("#btn_sign_up").attr('disabled', true);
        }else{
            $("#checkmessage").html("Passwords match.").css('color', 'green');
            $("#btn_sign_up").attr('disabled', false);
        }
        if(DesiredPassword=='' || DesiredPassword == '') $("#checkmessage").html("");
    }
</script>
<script>
    var myInput = document.getElementById("DesiredPassword");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var special_char = document.getElementById("special_char");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if(myInput.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
      } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
      }
      
      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if(myInput.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
      } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
      } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
      }
      
      // Validate special
      var special_chars = /[!@#$%^.+=~-]/g;
      if(myInput.value.match(special_chars)) {  
      special_char.classList.remove("invalid");
      special_char.classList.add("valid");
      } else {
      special_char.classList.remove("valid");
      special_char.classList.add("invalid");
      }
      
      // Validate length
      if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
      } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
      }
    }
</script>
<script>
  $(".toggle-DesiredPassword").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>
<script>
  $(".toggle-ConfirmPassword").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>

<script>
  //for Residential
  //Kapag meg select Region
       jQuery(document).ready(function() {
        jQuery("#AddResidentialRegion").on('change',function(){
            var regionAction = jQuery(this).attr("id");
            var region_id = jQuery(this).val();
            if(region_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{regionAction:regionAction, region_id:region_id},
                success:function(data){
                    jQuery('#AddResidentialProvince').html(data);
                    jQuery('#AddResidentialCity').html('<option value="">SELECT PROVINCE FIRST</option>');  
                }
            });
            }else{
                jQuery('#AddResidentialProvince').html('<option value="">SELECT REGION FIRST</option>');
                jQuery('#AddResidentialCity').html('<option value="">SELECT PROVINCE FIRST</option>');
                jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');
            }
        });
          });
//End select Region
//Kapag meg Select province
          jQuery(document).ready(function() {
        jQuery("#AddResidentialProvince").on('change',function(){
            var provinceAction = jQuery(this).attr("id");
            var province_id = jQuery(this).val();
            if(province_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{provinceAction:provinceAction, province_id:province_id},
                success:function(data){
                    jQuery('#AddResidentialCity').html(data);
                    jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');  
                }
            });
            }else{
                jQuery('#AddResidentialCity').html('<option value="">SELECT PROVINCE FIRST</option>');
                jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');
            }
        });
          });
//end select province
//kapag meg select city
          jQuery(document).ready(function() {
        jQuery("#AddResidentialProvince").on('change',function(){
            var provinceAction = jQuery(this).attr("id");
            var province_id = jQuery(this).val();
            if(province_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{provinceAction:provinceAction, province_id:province_id},
                success:function(data){
                    jQuery('#AddResidentialCity').html(data);
                    jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');  
                }
            });
            }else{
                jQuery('#AddResidentialCity').html('<option value="">SELECT PROVINCE FIRST</option>');
                jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');
            }
        });
          });
//end select city
//kapag meg select barangay
          jQuery(document).ready(function() {
        jQuery("#AddResidentialCity").on('change',function(){
            var cityAction = jQuery(this).attr("id");
            var city_id = jQuery(this).val();
            if(city_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{cityAction:cityAction, city_id:city_id},
                success:function(data){
                    jQuery('#AddResidentialBrgy').html(data);
                     
                }
            });
            }else{
                jQuery('#AddResidentialBrgy').html('<option value="">SELECT CITY FIRST</option>');
               
            }
        });
          });
//end select brgy

</script>

<script>
  //Permanent
  //Kapag meg select Region
       jQuery(document).ready(function() {

        jQuery("#AddPermanentRegion").on('change',function(){
            
            var regionAction = jQuery(this).attr("id");
            var region_id = jQuery(this).val();
            if(region_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{regionAction:regionAction, region_id:region_id},
                success:function(data){
                    jQuery('#AddPermanentProvince').html(data);
                    rProv = document.getElementById("AddResidentialProvince");        
                    $("#AddPermanentProvince").val(rProv.value).change(); 
                    jQuery('#AddPermanentCity').html('<option value="">SELECT PROVINCE FIRST</option>');  
                }
            });
            }else{
                jQuery('#AddPermanentProvince').html('<option value="">SELECT REGION FIRST</option>');
                jQuery('#AddPermanentCity').html('<option value="">SELECT PROVINCE FIRST</option>');
                jQuery('#AddPermanentBrgy').html('<option value="">SELECT CITY FIRST</option>');
            }
        });
          });
//End select Region
//Kapag meg Select province
          jQuery(document).ready(function() {
        jQuery("#AddPermanentProvince").on('change',function(){
            var provinceAction = jQuery(this).attr("id");
            var province_id = jQuery(this).val();
            if(province_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{provinceAction:provinceAction, province_id:province_id},
                success:function(data){
                    jQuery('#AddPermanentCity').html(data);
                    rCity = document.getElementById("AddResidentialCity");
                    $("#AddPermanentCity").val(rCity.value).change();
                    jQuery('#AddPermanentBrgy').html('<option value="">SELECT CITY FIRST</option>');  
                }
            });
            }else{
                jQuery('#AddPermanentCity').html('<option value="">SELECT PROVINCE FIRST</option>');
                jQuery('#AddPermanentBrgy').html('<option value="">SELECT CITY FIRST</option>');
            }
        });
          });
//end select province

//kapag meg select barangay
          jQuery(document).ready(function() {
        jQuery("#AddPermanentCity").on('change',function(){
            var cityAction = jQuery(this).attr("id");
            var city_id = jQuery(this).val();
            if(city_id){
                jQuery.ajax({
                url:"includes/db_functions.php",
                method:"POST",
                data:{cityAction:cityAction, city_id:city_id},
                success:function(data){
                    jQuery('#AddPermanentBrgy').html(data);
                    rBrgy = document.getElementById("AddResidentialBrgy");
                    $("#AddPermanentBrgy").val(rBrgy.value).change();
                }
            });
            }else{
                jQuery('#AddPermanentBrgy').html('<option value="">SELECT PROVINCE FIRST</option>');
               
            }
        });
          });
//end select brgy

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#month").change(function(){
    var month_id= $(this).val();
    if(month_id != 0)  {
    $.ajax
    ({
     type: "POST",
         url: "get_cutoff.php",
         data: "month_id="+ month_id,
         success: function(option)
         {
           $("#cutoff").html(option);
         }
      });
     }
     else
     {
       $("#cutoff").html("<option value=''>-- No category selected --</option>");
     }
    return false;
  });
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
