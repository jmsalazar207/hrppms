<!--Modal Pop up for Approve-->
<div class="modal fade" id="modalEdit<?=$Employment_Status_Code?>" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmEdit" method="POST">
                                                    <div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Updating Employment Status Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="Editmodalbody">
                                                                    <div class="row" hidden="true">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Status Code:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditEmploymentStatusCode" class="form-control border-input" readonly="true" value="<?=$Employment_Status_Code?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Status Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditEmploymentStatusName" class="form-control border-input" value="<?=$Employment_Status_Name?>" style="text-transform: uppercase;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Status Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtEditEmploymentStatusDescription" class="form-control border-input" value="<?=$Employment_Status_Description?>" style="text-transform: uppercase;">
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
<!--Modal Pop up for Add New-->
<div class="modal fade" id="modalAddNewModal" role = "dialog">
                                            <div class="modal-dialog">
                                                <form name="frmAdd" method="POST">
                                                    <div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-left">Add New Employment Status Modal</h4>
                                                        </div>
                                                            <div class="modal-body" id="AddNewmodalbody">                                                 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Status Name:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddEmploymentStatusName" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-left float-left">
                                                                          Employment Description:
                                                                        </div>
                                                                        <div class="col-md-8 text-left float-left">
                                                                            <input type="text" name="txtAddEmploymentStatusDescription" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
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
<!--Delete Confirmation modal-->
<div class="modal fade" id="modalDeleteClassStatus" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <form name = "frmDelete"method="POST">
            <div class="modal-contenterror">
              <div class="modal-headererror">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Classification of Status?</h4>
              </div>
              <div class="modal-bodyerror">
                <p align="center"><span class="glyphicon glyphicon-question-sign s_icon"></span></p>
                <h4>By clicking YES, you are going to delete the <i id="ClassStatusName"></i> in the list.</h4>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                            Status Code:
                        </div>
                        <div class="col-md-8 text-left float-left">
                            <input type="hidden" name="txtDeleteClassStatusCode" id="txtDeleteClassStatusCode" class="form-control border-input" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-left float-left" hidden>
                        Status Name:
                        </div>
                        <div class="col-md-8 text-left float-left" > 
                            <input type="hidden" name="txtDeleteClassStatusName" id="txtDeleteClassStatusName" class="form-control border-input" style="text-transform: uppercase;" readonly>
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