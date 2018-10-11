<style type="text/css">
	.error{
		color: red;
	}
	/* bootstrap-tagsinput.css file - add in local */
	.bootstrap-tagsinput {
	  display: block;
	    width: 100%;
	    padding: .65rem 1rem;
	    font-size: 1rem;
	    line-height: 1.25;
	    color: #495057;
	    background-color: #fff;
	    background-clip: padding-box;
	    border: 1px solid #ebedf2;
	    border-radius: .25rem;
	    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
	.bootstrap-tagsinput input {
	  border: none;
	  box-shadow: none;
	  outline: none;
	  background-color: transparent;
	  padding: 0 6px;
	  margin: 0;
	  width: auto;
	  max-width: inherit;
	}
	.bootstrap-tagsinput.form-control input::-moz-placeholder {
	  color: #777;
	  opacity: 1;
	}
	.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
	  color: #777;
	}
	.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
	  color: #777;
	}
	.bootstrap-tagsinput input:focus {
	  border: none;
	  box-shadow: none;
	}
	.bootstrap-tagsinput .tag {
	  margin-right: 2px;
	  color: #000;
	  background: #eee;
		padding: 2px 5px;
		border-radius: 2px;
		display: inline-block;
	    margin-bottom: 3px;
	}
	.bootstrap-tagsinput .tag [data-role="remove"] {
	  margin-left: 8px;
	  cursor: pointer;
	}
	.bootstrap-tagsinput .tag [data-role="remove"]:after {
	  content: "x";
	  padding: 0px 2px;
	}
	.bootstrap-tagsinput .tag [data-role="remove"]:hover {
	  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	}
	.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
	  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
	}
</style>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Edit Customer</h3>
		</div>
		
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Customer Form
							</h3>
						</div>
					</div>
				</div>
				<div style="margin-top: 20px;">
					<div class="col-lg-8">
						<?php $is_error = false; ?>
						<?php if(validation_errors() != ''){ $is_error = true; ?>
						    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible animated fadeIn">
						       <?php echo validation_errors(); ?>
						    </div>
						<?php } ?>
						<?php if($this->session->flashdata('success') != '' && $is_error==false){ ?>
						    <div class="m-alert m-alert--outline alert alert-success alert-dismissible animated fadeIn">
						       <?php echo $this->session->flashdata('success'); ?>
						    </div>
						<?php } ?>
						<?php if($this->session->flashdata('error') != '' && $is_error==false){ ?>
						    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible animated fadeIn">
						       <?php echo $this->session->flashdata('error'); ?>
						    </div>
						<?php } ?>
						<div class="alert" id="level-register-error-msg" style="display:none"></div>
					</div>	
				</div>
				<div class="clearfix"></div>
				
				<?php 
			      	$customerform_edit = array('id'=>'customer_formedit','autocomplete'=>'off','name'=>'customer_formedit','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype'=>'multipart/form-data');
			    	echo form_open('customer/update',$customerform_edit);   
				?>
				<div class="m-portlet__body">
					<?php  
							$customer_id = !isset($customer_data->id)?'':$customer_data->id;
							$customer_name_val = !isset($customer_data->name)?'':$customer_data->name;
							$mobile_val = !isset($customer_data->mobile)?'':$customer_data->mobile;
							$loan_date_val = ($customer_data->loan_date=='0000-00-00')?'':date('Y-m-d',strtotime($customer_data->loan_date));
							$amount_val = !isset($customer_data->amount)?'':$customer_data->amount;
							$processing_charges_val = !isset($customer_data->processing_charges)?'':$customer_data->processing_charges;
							$emi_amount_val = !isset($customer_data->emi_amount)?'':$customer_data->emi_amount;
							$emi_interest_val = !isset($customer_data->emi_interest)?'':$customer_data->emi_interest;
							$total_emi_val = !isset($customer_data->total_emi)?'':$customer_data->total_emi;
							$emi_month_val = !isset($customer_data->emi_month)?'':$customer_data->emi_month;
							$closing_balance_val = !isset($customer_data->closing_balance)?'':$customer_data->closing_balance;
							$loan_closed_val = !isset($customer_data->loan_closed)?'':$customer_data->loan_closed;
							if($customer_data->loan_closed_date==Null || $customer_data->loan_closed_date=='0000-00-00'){
								$loan_closed_date_val='';
							}else{
								$loan_closed_date_val = date('Y-m-d',strtotime($customer_data->loan_closed_date));
							}
							$emi_type_val = !isset($customer_data->emi_type)?'':$customer_data->emi_type;
							if($customer_data->emi_day==Null){
								$emi_day_val='';
							}else{
								$emi_day_val = $customer_data->emi_day;
							}


					?>
					<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id;?>">
					
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Customer Name:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $customer_name = array ("name" => "customer_name", "id"=>"customer_name","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Name",
				                                 "value"=>$customer_name_val);
				                  echo form_input($customer_name);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Mobile No.:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $mobile = array ("name" => "mobile", 
				                  					"id"=>"mobile",
				                  					"type"=>"text",
				                                 	"class" => "form-control m-input",
				                                 	"placeholder"=>"Enter Mobile No.",
				                                 	"value"=>$mobile_val,"data-role"=>"tagsinput");
				                  echo form_input($mobile);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Emi Type:
						</label>
						<div class="col-lg-6">
							<select name="emi_type" id="emi_type" class='form-control m-input'>
							   <option value="">Select type</option>
							   <option value="1" <?php if(isset($customer_data)){ if($emi_type_val == '1'){ echo 'Selected';}} ?>>Monthly</option>
							   <option value="2"<?php if(isset($customer_data)){ if($emi_type_val == '2'){ echo 'Selected';}} ?>>Weekly</option>
							</select>
						</div>
					</div>

					<div id="displayEmiDay" style="<?php if($emi_type_val == '2'){ echo 'display: block';}else{ echo 'display: none'; }?>">
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Emi Day:
							</label>
							<div class="col-lg-6">
								<select name="emi_day" id="emi_day" class='form-control m-input displayEmiDay-required'>
								   <option value="">Select day</option>
								   <option value="Monday" <?php if(isset($customer_data)){ if($emi_day_val == 'Monday'){ echo 'Selected';}} ?>>Monday</option>
								   <option value="Tuesday"<?php if(isset($customer_data)){ if($emi_day_val == 'Tuesday'){ echo 'Selected';}} ?>>Tuesday</option>
								   <option value="Wednesday" <?php if(isset($customer_data)){ if($emi_day_val == 'Wednesday'){ echo 'Selected';}} ?>>Wednesday</option>
								   <option value="Thursday"<?php if(isset($customer_data)){ if($emi_day_val == 'Thursday'){ echo 'Selected';}} ?>>Thursday</option>
								   <option value="Friday" <?php if(isset($customer_data)){ if($emi_day_val == 'Friday'){ echo 'Selected';}} ?>>Friday</option>
								   <option value="Saturday"<?php if(isset($customer_data)){ if($emi_day_val == 'Saturday'){ echo 'Selected';}} ?>>Saturday</option>
								   <option value="Sunday" <?php if(isset($customer_data)){ if($emi_day_val == 'Sunday'){ echo 'Selected';}} ?>>Sunday</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Amount:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $amount = array ("name" => "amount", "id"=>"amount","type"=>"number",
				                                 "class" => "form-control m-input total_month","placeholder"=>"Enter Amount","value"=>$amount_val,"maxlength"=>15);
				                  echo form_input($amount);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Processing Charges:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $processing_charges = array ("name" => "processing_charges", "id"=>"processing_charges","type"=>"number",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Processing Charges",
				                                 "value"=>$processing_charges_val,"maxlength"=>10);
				                  echo form_input($processing_charges);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Emi Amount:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $emi_amount = array ("name" => "emi_amount", "id"=>"emi_amount","type"=>"number",
				                                 "class" => "form-control m-input total_emi total_month","placeholder"=>"Enter Emi Amount",
				                                 "value"=>$emi_amount_val,"maxlength"=>15);
				                  echo form_input($emi_amount);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Emi Interest:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $emi_interest = array ("name" => "emi_interest", "id"=>"emi_interest","type"=>"number",
				                                 "class" => "form-control m-input total_emi","placeholder"=>"Enter Emi Interest",
				                                 "value"=>$emi_interest_val,"maxlength"=>10);
				                  echo form_input($emi_interest);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Total Emi:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $total_emi = array ("name" => "total_emi", "id"=>"total_emi","type"=>"number",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Total Emi",
				                                 "value"=>$total_emi_val,"maxlength"=>15);
				                  echo form_input($total_emi);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label" id="labelChanged">
								<?php echo ($emi_type_val=='1')?'Emi Month:':'Emi Count:'?>
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $emi_month = array ("name" => "emi_month", "id"=>"emi_month","type"=>"number",
				                                 "class" => "form-control m-input","min"=>"0","value"=>$emi_month_val);
				                  echo form_input($emi_month);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Closing Balance:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $closing_balance = array ("name" => "closing_balance", "id"=>"closing_balance","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Closing Balance",
				                                 "value"=>$closing_balance_val,"maxlength"=>15);
				                  echo form_input($closing_balance);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Loan Date:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $loan_date = array ("name" => "date_loan", "id"=>"date_loan","type"=>"date",
				                                 "class" => "form-control m-input","value"=>$loan_date_val);
				                  echo form_input($loan_date);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Loan Closed:
						</label>
						<div class="col-lg-6">
							<select name="loan_closed" id="loan_closed" class='form-control m-input'>
							   <option value="">Select type</option>
							   <option value="0" <?php if(isset($customer_data)){ if($loan_closed_val == '0'){ echo 'Selected';}} ?>>Open</option>
							   <option value="1"<?php if(isset($customer_data)){ if($loan_closed_val == '1'){ echo 'Selected';}} ?>>Closed</option>
							</select>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Loan Closed Date:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $loan_closed_date = array ("name" => "loan_closed_date", "id"=>"loan_closed_date","type"=>"date",
				                                 "class" => "form-control m-input","value"=>$loan_closed_date_val);
				                  echo form_input($loan_closed_date);                                                    
				            ?>
						</div>
					</div>
					
					
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-6">
									<button type="submit" class="btn btn-brand" name="submit_btn" id="submit_btn">
										Submit
									</button>
				              		<a href="<?php echo base_url('customer/list')?>" class="btn btn-secondary">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php echo form_close(); ?>
				<!--end::Form-->
			</div>
		</div>
	</div>
</div>



