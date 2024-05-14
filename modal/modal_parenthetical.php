<!--Modal Pop up for Add New-->
                                        <div class="modal fade" id="modalAddNewModal" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmAdd" method="POST">
                                                    <div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Add New Parenthetical Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="AddNewmodalbody">                                                 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Parenthetical Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddParentheticalName" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Parenthetical Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddParentheticalDescription" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
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

<!--Modal Pop up for Approve-->
<div class="modal fade" id="modalEdit<?=$Parenthetical_Code?>" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Updating Parenthetical Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="Editmodalbody">
                                                                    <div class="row" hidden="true">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Parenthetical Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditParentheticalCode" class="form-control border-input" readonly="true" value="<?=$Parenthetical_Code?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Parenthetical Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditParentheticalName" class="form-control border-input" value="<?=$Parenthetical_Name?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Parenthetical Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditParentheticalDesription" class="form-control border-input" value="<?=$Parenthetical_Description?>" style="text-transform: uppercase;">
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
<div class="modal fade" id="modalDeleteParenthetical" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <form name = "frmDelete"method="POST">
            <div class="modal-contenterror">
              <div class="modal-headererror">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Parenthetical Title?</h4>
              </div>
              <div class="modal-bodyerror">
                <p align="center"><span class="glyphicon glyphicon-question-sign s_icon"></span></p>
                <h4>By clicking YES, you are going to delete the <i id="ParentheticalTitle"></i> in the list.</h4>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                            Parenthetical Code:
                        </div>
                        <div class="col-md-8 text-left float-left">
                            <input type="hidden" name="txtDeleteParentheticalCode" id="txtDeleteParentheticalCode" class="form-control border-input" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                        Parenthetical Name:
                        </div>
                        <div class="col-md-8 text-left float-left" > 
                            <input type="hidden" name="txtDeleteParentheticalName" id="txtDeleteParentheticalName" class="form-control border-input" style="text-transform: uppercase;" readonly>
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