<div class="modal fade" id="modalEdit" role = "dialog">
	<div class="modal-dialog">
		<form name="frmEdit" method="POST">
			<div class="modal-content" name = "divmodalEdit" id="divmodalEdit">
				<div class="modal-header">
					<button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-left">Updating Position Modal</h4>
				</div>
				<div class="modal-body" id="Editmodalbody">
				  <!--HIDDEN-->
					<div class="row" hidden="true">
						<div class="col-md-4 text-left float-left">
						  Position Code:
						</div>
						<div class="col-md-8 text-left float-left">
							<input type="text" id="txtEditPositionCode" name="txtEditPositionCode" class="form-control border-input" readonly="true">
						</div>
					</div>
				  <!--HIDDEN-->      
					<div class="row">
						<div class="col-md-4 text-left float-left">
						  Item Code:
						</div>
						<div class="col-md-8 text-left float-left">
							<input type="text" id="txtEditItemCode" name="txtEditItemCode" class="form-control border-input" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-left float-left">
						  Office Location/Official Station:
						</div>
						<div class="col-md-8 text-left float-left">
							<select class="form-control select2" style="width: 100%" id="txtEditStation" name="txtEditStation">
							<!--?php echo fill_List_Position_Update_Station($connP,$Station_Code); ?-->
						  </select>                                                                            
						</div>
					</div>   
					<div class="row">
						<div class="col-md-4 text-left float-left">
						  Division:
						</div>
						<div class="col-md-8 text-left float-left">
							<select class="form-control select2" style="width:100%" id="txtEditDivision" name="txtEditDivision">
							<!--?php echo fill_List_Position_Update_Division($connP,$Division_Code); ?-->
						  </select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-left float-left">
						  Unit:
						</div>
						<div class="col-md-8 text-left float-left">
							<select class="form-control select2" style="width:100%" id="txtEditUnit" name="txtEditUnit">
							 
							 <!--?php echo fill_List_Position_Update_Unit($connP,$Unit_Code);?-->
							
						  </select>
						</div>
					</div>                                                                       
				</div>
				<div class="text-center modal-footer">
					<button type = "button" class = "btn btn-success btn-round btnULupdate" name = "btnULupdate" data-toggle = "modal" href ="#confirm_edit">UPDATE</button>
					<button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">NO</button>
                                                                      <div class="modal fade" id="confirm_edit" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title text-left"></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-left float-left">
                                                                                            Are you sure you want to update position details?
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center modal-footer">
                                                                                    <input type="submit" class="btn btn-success btn-round btnyesno" name="btnUpdateYes" value="YES" />
                                                                                    <button type="button" class="btn btn-danger btn-round btnyesno" data-dismiss="modal">NO</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>					
				</div>
			</div>                                                       
		</form>
	</div>
</div>