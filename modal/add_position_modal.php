<!--Modal Pop up for Add New-->
<div class="modal fade" id="modalAddNewModal" role = "dialog">
	<div class="modal-dialog">
		<form name="frmAdd" method="POST">
			<div class="modal-content" name = "divmodalAddNew" id="divmodalAddNew">
				<div class="modal-header">
					<button type="button" class="close btnCloseULadd" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-left">Add New Position Modal</h4>
				</div>
					<div class="modal-body" id="AddNewmodalbody">
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Division:
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%" id="txtAddDivision" name="txtAddDivision" required="true">
								 <?php
								 echo fill_List_Position_division($connP, null);
								 ?>
							  </select>                                                                           
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Unit:
								</div>
								<div class="col-md-8 text-left float-left">
									<select class="form-control select2" style="width: 100%" id="txtAddUnit" name="txtAddUnit" required="true">
									  <option value="">SELECT DIVISION FIRST</option>
									</select>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Office Location/Official Station:
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%" id="txtAddPositionStation" name="txtAddPositionStation" required="true">
								 <?php
								 echo fill_List_Position_Station($connP, null);
								 ?>
							  </select>                                                                           
								</div>
							</div>                                                                                                                                                                                             
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Item Code:
								</div>
								<div class="col-md-8 text-left float-left">
									<input type="text" name="txtAddItemCode" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
								</div>
							</div>  
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Position:
								</div>
								<div class="col-md-8 text-left float-left">
									<input type="text" name="txtAddPositionName" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Salary Grade:
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%"  id="txtAddSalaryGrade" name="txtAddSalaryGrade" required="true">
								 <?php
								 echo fill_List_Position_Salary_Grade($connP, null);
								 ?>
							  </select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Position Level:
								</div>
								<div class="col-md-8 text-left float-left">
									<input type="number" name="txtAddPositionLevel" id = "txtAddPositionLevel" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
								</div>
							</div>
							<div class="row" hidden="true">
								<div class="col-md-4 text-left float-left">
								  Step Increment:
								</div>
								<div class="col-md-8 text-left float-left">
									<input type="number" name="txtAddStepIncrement" id ="txtAddStepIncrement"class="form-control border-input" value="1" style="text-transform: uppercase;" readonly="true">
								</div>
							</div> 
							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Monthly Salary
								</div>
								<div class="col-md-8 text-left float-left">
									<input type="text" name="txtSalary" id="txtSalary" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
									<input type="hidden" name="txtSalaryId" id="txtSalaryId" class="form-control border-input" value="" style="text-transform: uppercase;" required="true" readonly="true">
								</div>
							</div>               


							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Employment Status:
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%" id="txtAddEmploymentStatus" name="txtAddEmploymentStatus" required="true">
								 <?php
								 echo fill_List_Position_Employment_Status($connP, null);
								 ?> 
							  </select> 
							</div>
						  </div>
						   <div class="row">
								<div class="col-md-4 text-left float-left">
								  Fund Source:
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%" id="txtAddFundSource" name="txtAddFundSource" required="true">
								 <?php
								 echo fill_List_Position_Fund_Source($connP, null);
								 ?>
							  </select> 
								</div>
							</div>   
						   <div class="row">
								<div class="col-md-4 text-left float-left">
								 Created Date:
								</div>
								<div class="col-md-8 text-left float-left">
								  <input type="date" name="txtAddCreatedDate" class="form-control border-input" value="" style="text-transform: uppercase;" required="true">
								</div>
							</div>                                                                                                                                     
<!-- 							<div class="row">
								<div class="col-md-4 text-left float-left">
								  Status(filled/unfilled):
								</div>
								<div class="col-md-8 text-left float-left">
								<select class="form-control select2" style="width: 100%" id="txtAddStatus" name="txtAddStatus" required="true">
								 <?php
								 //echo fill_List_Position_Status($connP, null);
								 ?>
							  </select> 
								</div>
							</div>  -->                                                                        
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