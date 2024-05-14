
                                        <div class="modal modal-wide fade" id="modalEdit" role = "dialog">
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
                                                                                      <input type="text" name="txtEditLastName" id = "txtEditLastName" class="form-control border-input input-sm" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    First Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditFirstName" id = "txtEditFirstName" class="form-control border-input input-sm" value="" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Middle Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditMiddleName" id = "txtEditMiddleName" class="form-control border-input input-sm" value="" style="text-transform: uppercase;">
                                                                                  </div>
                                                                              </div> 
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Extention Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <select class="form-control select2" style="width:100%" id="txtEditExtName" name="txtEditExtName">
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
                                                                                        <select class="form-control select2" style="width:100%" id="txtEditSex" name="txtEditSex">
                                                                                  <!--   <?php
                                                                                      //echo fill_List_Position_Update_Sex($connP,$Sex_Code);
                                                                                    ?> -->
                                                                                  </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Date of Birth:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <input type="Date" name="txtEditBirthday" id = "txtEditBirthday" class="form-control border-input input-sm" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Age:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <input type="text" name="txtEditAge" id = "txtEditAge" class="form-control border-input input-sm" readonly="true" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                      Civil Status:
                                                                                    </div>
                                                                                    <div class="col-sm-12 text-left float-left">
                                                                                        <select class="form-control select2" style="width:100%" id="txtEditCivilStatus" name="txtEditCivilStatus">
                                                                                   <!--  <?php
                                                                                      //echo fill_List_Position_Update_Civil_Status($connP,$Civil_Status_Code);
                                                                                    ?> -->
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
                                                                                      <select class="form-control select2" style="width:100%" id="txtEditCitizenship" name="txtEditCitizenship">
                                                                                       <!--  <?php
                                                                                          //echo fill_List_Position_Update_Citizenship($connP,$Citizenship_Code);
                                                                                        ?> -->
                                                                                      </select>         
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Email Address
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    <input type="text" name="txtEditEmailAddress" id = "txtEditEmailAddress" class="form-control border-input input-sm" value="">
                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Contact No.
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                     <input type="text" name="txtEditContactNo" id = "txtEditContactNo" class="form-control border-input input-sm" value="">
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
                                                <input type="text" name="txtEditEmpNo" id = "txtEditEmpNo" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>                                          
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Division
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditDivisionName" id = "txtEditDivisionName" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Unit
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditUnitName" id = "txtEditUnitName" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div  class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Office Location / Official Station
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditOLOS" id = "txtEditOLOS" class="form-control border-input input-sm" value="" readonly>
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
                                              <input type="hidden" name="txtHiddenItemNumber" id = "txtHiddenItemNumber" class="form-control border-input input-sm" readonly="true">
                                              <select class="form-control select2" style="width:100%" id="txtEditItemNumber" name="txtEditItemNumber">
                                              </select> 
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Date Creation
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditDateCreation" id = "txtEditDateCreation" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Position Title
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditPositionTitle" id = "txtEditPositionTitle" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Parenthetical Title
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style="width:100%" id="txtEditParenthetical" name="txtEditParenthetical">
                                                <!-- <?php
                                                 // echo fill_List_Position_Update_Parenthetical($connP,$Parenthetical_Code);
                                                ?> -->
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
                                                <input type="text" name="txtEditPositionLevel" id = "txtEditPositionLevel" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              SG
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditGrade" id = "txtEditGrade" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Step Increment
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditIncrement" id = "txtEditIncrement" class="form-control border-input input-sm" value="" readonly>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Monthly Salary
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                <input type="text" name="txtEditSalary" id = "txtEditSalary" class="form-control border-input input-sm" value="" readonly>
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
                                          <select class="form-control select2" style="width:100%"  id="txtEditDesignation" name="txtEditDesignation">
                                                <!-- <?php
                                                  //echo fill_List_Position_Update_Designation($connP,$Designation_Code);
                                                ?> -->
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Designation Date
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                                  <input type="date" name="txtDesignationDate" id = "txtDesignationDate" class="form-control border-input input-sm" value="">
                                            </div>
                                          </div> 
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Special Order
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                          <select class="form-control select2" style="width:100%"  id="txtEditSpecialOrder" name="txtEditSpecialOrder">
                                                <!-- <?php
                                                  //echo fill_List_Position_Update_Special_Order($connP,$Special_Order_Code);
                                                ?> -->
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Office/Bureau/Service/Program
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                          <select class="form-control select2" style="width:100%"  id="txtEditOBSP" name="txtEditOBSP">
                                               <!--  <?php
                                                  //echo fill_List_Position_Update_OBSP($connP,$OBSP_Code);
                                                ?> -->
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
                                                <input type="text" name="txtEditFundSource" id = "txtEditFundSource" class="form-control border-input input-sm" value="" readonly>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Classification of Employment
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                  <input type="text" name="txtEditEmployment" id = "txtEditEmployment" class="form-control border-input input-sm" value="" readonly>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Mode of Accession
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                <select class="form-control select2" style="width:100%"  id="txtEditModeAccession" name="txtEditModeAccession">
                                                 <!--  <?php
                                                   // echo fill_List_Position_Update_Mode_Accession($connP,$Mode_Accession_Code);
                                                  ?> -->
                                                </select>
                                              </div>
                                            </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date Filled Up:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFilledUp" id = "txtEditDateFilledUp" class="form-control border-input input-sm" value="">
                                                      <input type="Hidden" name="txtEditDateFilledUpLast" id = "txtEditDateFilledUpLast" class="form-control border-input input-sm" value="">
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
                                                      <input type="Date" name="txtEditDateOriginal" id = "txtEditDateOriginal" class="form-control border-input input-sm" value="">
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date of Last Promotion:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDatePromotion" id = "txtEditDatePromotion" class="form-control border-input input-sm" value="">
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date Entry in DSWD:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFirstEntry" id = "txtEditDateFirstEntry" class="form-control border-input input-sm" value="">
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
                                                                    <button type = "button" class = "btn btn-success btn-round btnULupdate" name = "btnULupdate" data-toggle = "modal" href ="#confirm_edit">UPDATE</button>
                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                                      <div class="modal modal-confirm fade" id="confirm_edit" role="dialog">
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
                                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" onclick="modalCloseConfirm()">NO</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                      <div class="modal modal-confirm fade" id="confirm_date" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title text-left">
                                                                                     Please fillup date.
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                      <div class="col-sm-12 text-left float-left">
                                                                                          Date End of Previous Position 
                                                                                        </div>
                                                                                        <div class="col-sm-12 text-left float-left">
                                                                                            <input type="Date" name="txtPreviousPosition" id = "txtPreviousPosition" class="form-control border-input input-sm" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                      <div class="col-sm-12 text-left float-left">
                                                                                          Date Started
                                                                                        </div>
                                                                                        <div class="col-sm-12 text-left float-left">
                                                                                            <input type="Date" name="txtPromotedPosition" id = "txtPromotedPosition" class="form-control border-input input-sm" value="">
                                                                                        </div>
                                                                                    </div>                                                                                    
                                                                                </div>
                                                                                <div class="text-center modal-footer">
                                                                                    <button type="button" class="btn btn-success btn-round btnyesno" name="btnSubmit" onclick="modalCloseDate('confirm')">Confirm</button>
                                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" onclick="modalCloseDate('close')">NO</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                                                                                     
                                                    </div>                                                       
                                                </form>
                                            </div>
                                        </div>