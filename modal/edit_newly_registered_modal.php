<!--Modal Pop up for Approve-->

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
                                                                                      <input type="text" name="txtEditLastName" id = "txtEditLastName" class="form-control border-input input-sm" style="text-transform: uppercase;" readonly>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    First Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditFirstName" id = "txtEditFirstName" class="form-control border-input input-sm" style="text-transform: uppercase;" readonly>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Middle Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditMiddleName" id = "txtEditMiddleName" class="form-control border-input input-sm" style="text-transform: uppercase;" readonly>
                                                                                  </div>
                                                                              </div> 
                                                                              <div class="col-md-3">
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                    Extention Name:
                                                                                  </div>
                                                                                  <div class="col-sm-12 text-left float-left">
                                                                                      <input type="text" name="txtEditExtName" id = "txtEditExtName" class="form-control border-input input-sm" style="text-transform: uppercase;" readonly>
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
                                        <h3 class="box-title">Employment Info
                                        </h3>
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
                                                <input type="text" name="txtEditEmpNo" id = "txtEditEmpNo" class="form-control border-input input-sm" readonly="true">
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Item Number
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style = "width:100%" id="txtEditItemCode" name="txtEditItemCode">
                                              <?php
                                                  echo fill_List_Position_Update_New_Position($connP,$Item_Code);
                                                ?>                                                
                                              </select>                                               
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Parenthetical Title
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style = "width:100%" id="txtEditParenthetical" name="txtEditParenthetical">
                                                <?php
                                                  echo fill_List_Position_Update_Parenthetical($connP,$Parenthetical_Code);
                                                ?>
                                              </select>  
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Office/Bureau/Service/Program
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style = "width:100%" id="txtEditOBSP" name="txtEditOBSP">
                                                <?php
                                                  echo fill_List_Position_Update_OBSP($connP,$OBSP_Code);
                                                ?>
                                              </select>
                                            </div>
                                          </div>                                                                                           
                                        </div>
                                        <!--End 1st Row-->
                                        <!--Start 2nd Row-->
                                        <div class="row row-top col-md-12">
                                          <div class="col-md-3">
                                            <div class="col-sm-12 text-left float-left">
                                              Designation
                                            </div>
                                            <div class="col-sm-12 text-left float-left">
                                              <select class="form-control select2" style = "width:100%" id="txtEditDesignation" name="txtEditDesignation">
                                                <?php
                                                  echo fill_List_Position_Update_Designation($connP,$Designation_Code);
                                                ?>
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
                                              <select class="form-control select2" style = "width:100%" id="txtEditSpecialOrder" name="txtEditSpecialOrder">
                                                <?php
                                                  echo fill_List_Position_Update_Special_Order($connP,$Special_Order_Code);
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                            <div class="col-md-3">
                                              <div class="col-sm-12 text-left float-left">
                                                Mode of Accession
                                              </div>
                                              <div class="col-sm-12 text-left float-left">
                                                <select class="form-control select2" style="width:100%" id="txtEditModeAccession" name="txtEditModeAccession">
                                                <?php
                                                    echo fill_List_Position_Update_Mode_Accession($connP,Null);
                                                  ?>
                                                </select>
                                              </div>
                                            </div>                                                           
                                        </div>
                                        <!--End 2nd Row-->
                                        <!--Start 4th Row-->
                                        <div class="row row-top col-md-12">
                                              <div class="col-md-3">
                                                  <div class="col-sm-12 text-left float-left">
                                                    Date Filled Up:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFilledUp" id = "txtEditDateFilledUp" class="form-control border-input input-sm" value="">
                                                  </div>
                                              </div>
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
                                                    Date Entry in DSWD:
                                                  </div>
                                                  <div class="col-sm-12 text-left float-left">
                                                      <input type="Date" name="txtEditDateFirstEntry" id = "txtEditDateFirstEntry" class="form-control border-input input-sm" value="">
                                                  </div>
                                              </div>                                           
                                        </div>
                                         <!--End 4th Row-->                                                           
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
                                                                                            Are you sure you want to Update?
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center modal-footer">
                                                                                    <input type="submit" class="btn btn-success btn-round btnyesno" id = "btnUpdateYes" name="btnUpdateYes"  value="YES" />
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