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
			<h3 class="m-subheader__title ">Add Customer</h3>
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
			      	$customer_form = array('id'=>'customer_formadd','autocomplete'=>'off','name'=>'customer_formadd','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype'=>'multipart/form-data');
			    	echo form_open('customer/save',$customer_form);   
				?>
				<div class="m-portlet__body">
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Customer Name:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $customer_name = array ("name" => "customer_name", "id"=>"customer_name","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Name",
				                                 "value"=>set_value('customer_name'));
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
				                                 	"value"=>set_value('mobile'),"data-role"=>"tagsinput");
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
							   <option value="1">Monthly</option>
							   <option value="2">Weekly</option>
							</select>
						</div>
					</div>

					<div id="displayEmiDay" style="display: none;">
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Emi Day:
							</label>
							<div class="col-lg-6">
								<select name="emi_day" id="emi_day" class='form-control m-input displayEmiDay-required'>
								   <option value="">Select day</option>
								   <option value="Monday">Monday</option>
								   <option value="Tuesday">Tuesday</option>
								   <option value="Wednesday">Wednesday</option>
								   <option value="Thursday">Thursday</option>
								   <option value="Friday">Friday</option>
								   <option value="Saturday">Saturday</option>
								   <option value="Sunday">Sunday</option>
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
				                                 "class" => "form-control m-input total_month","placeholder"=>"Enter Amount","value"=>set_value('amount'),"maxlength"=>15);
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
				                                 "value"=>set_value('processing_charges'),"maxlength"=>10);
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
				                                 "value"=>set_value('emi_amount'),"maxlength"=>15);
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
				                                 "value"=>set_value('emi_interest'),"maxlength"=>10);
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
				                                 "value"=>set_value('total_emi'),"maxlength"=>15);
				                  echo form_input($total_emi);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label" id="labelChanged">
								Emi Month:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $emi_month = array ("name" => "emi_month", "id"=>"emi_month","type"=>"number",
				                                 "class" => "form-control m-input","min"=>"0","value"=>set_value('emi_month'));
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
				                                 "value"=>set_value('closing_balance'),"maxlength"=>15);
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
				                  $loan_date = array ("name" => "loan_date", "id"=>"loan_date","type"=>"date",
				                                 "class" => "form-control m-input","value"=>set_value('loan_date'));
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
							   <option value="0">Open</option>
							   <option value="1">Closed</option>
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
				                                 "class" => "form-control m-input","value"=>set_value('loan_closed_date'));
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



