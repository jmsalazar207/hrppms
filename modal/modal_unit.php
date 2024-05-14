
<link rel="stylesheet" href="includes/add.css">
<!--LIB DIVISION MODALS-->

<!--Modal Pop up for Approve-->
<div class="modal fade" id="modalEditUnit<?=$Unit_Code?>" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Updating Unit Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="Editmodalbody">
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left" hidden>
                                                                          Unit Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left"hidden>
                                                                            <input type="text" name="txtUnitCode" class="form-control border-input" readonly="true" value="<?=$Unit_Code?>" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtUnitName" class="form-control border-input" value="<?=$Unit_Name?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit Name Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtUnitNameCode" class="form-control border-input" value="<?=$Unit_Name_Code?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div>     
                                                                 <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Division Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                          <select class="form-control select2" style="width: 100%"  id="txtEditDivision" name="txtEditDivision">
                                                                            <?php
                                                                              echo fill_List_Unit_Update_Division($connP,$Division_Code);
                                                                            ?>
                                                                          </select>
                                                                        </div>
                                                                    </div>                                                                                                                       
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
<!--Delete Confirmation modal-->
<div class="modal fade" id="modalDeleteUnit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <form name = "frmDelete"method="POST">
            <div class="modal-contenterror">
              <div class="modal-headererror">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete unit?</h4>
              </div>
              <div class="modal-bodyerror">
                <p align="center"><span class="glyphicon glyphicon-question-sign s_icon"></span></p>
                <h4>By clicking YES, you are going to delete the <i id="UnitName"></i> in the list.</h4>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                            Unit Code:
                        </div>
                        <div class="col-md-8 text-left float-left">
                            <input type="hidden" name="txtDeleteUnitCode" id="txtDeleteUnitCode" class="form-control border-input" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                            Unit Name:
                        </div>
                        <div class="col-md-8 text-left float-left" > 
                            <input type="hidden" name="txtDeleteUnitName" id="txtDeleteUnitName" class="form-control border-input" style="text-transform: uppercase;" readonly>
                        </div>
                    </div>                
              </div>
              <div class="modal-footererror">
                <input type="submit" class="btn btn-modalConfirmYes btn-round btnyesno btn-sm" name="btnDeleteYes" value="YES" />
                <button type="button" class="btn btn-modalConfirmNo btn-round btnyesno btn-sm" data-dismiss="modal">NO</button>                
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


<!--End delete confirmation modal-->         

<!--Modal Pop up for Add New-->
<div class="modal fade" id="modalAddNewModalUnit" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmAdd" method="POST">
                                                    <div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Add New Unit Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="AddNewmodalbody">
                                                                 <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Division Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                          <select class="form-control select2" style="width: 100%" id="Unit_Division" name="Unit_Division" required="true">
                                                                            <?php
                                                                              echo fill_List_Unit_Add_division($connP,null);
                                                                            ?>
                                                                          </select>
                                                                        </div>
                                                                    </div>                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddUnitName" class="form-control border-input" value="" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Unit Name Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddUnitNameCode" class="form-control border-input" value="" style="text-transform: uppercase;">
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