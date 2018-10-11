<style type="text/css">
	.error{
		color: red;
	}
</style>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Edit Receipt</h3>
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
								Receipt Form
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
						<div class="alert" id="exam-register-error-msg" style="display:none"></div>
					</div>	
				</div>
				<div class="clearfix"></div>
				
				<?php 
			      	$receiptform_edit = array('id'=>'receipt_formedit','autocomplete'=>'off','name'=>'receipt_formedit','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype'=>'multipart/form-data');
			    	echo form_open('receipt/update',$receiptform_edit);   
				?>
				<div class="m-portlet__body">
					<?php  
							$receipt_id = !isset($receipt_data->id)?'':$receipt_data->id;
							$customer_id_val = !isset($receipt_data->customer_id)?'':$receipt_data->customer_id;
							$emi_val = !isset($receipt_data->emi)?'':$receipt_data->emi;
							$interest_income_val = !isset($receipt_data->interest_income)?'':$receipt_data->interest_income;
							if($receipt_data->receipt_date==Null || $receipt_data->receipt_date=='0000-00-00'){
								$receipt_date_val='';
							}else{
								$receipt_date_val = date('Y-m-d',strtotime($receipt_data->receipt_date));
							}
							$type_val 			= !isset($receipt_data->load_closed_status)?'':$receipt_data->load_closed_status;
					?>
					<input type="hidden" id="receipt_id" name="receipt_id" value="<?php echo $receipt_id;?>">
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Customer Name:
						</label>
						<div class="col-lg-6">
							<?php $customer_options = array(''=>'Select Customer Name');
							  	foreach($customer_data as $customer){
							      	$customer_options[$customer['id']] = $customer['name'];
							 	}
							  	echo form_dropdown('customer_id',$customer_options,set_value('customer_id',$customer_id_val),'id="customer_id" class="form-control m-input"'); 
							?>  
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Receipt Date:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $receipt_date = array ("name" => "date_receipt", "id"=>"date_receipt","type"=>"date",
				                                 "class" => "form-control m-input","value"=>$receipt_date_val);
				                  echo form_input($receipt_date);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Emi:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $emi = array ("name" => "emi", "id"=>"emi","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Emi",
				                                 "value"=>$emi_val,"maxlength"=>15);
				                  echo form_input($emi);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Interest Income:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $interest_income = array ("name" => "interest_income", "id"=>"interest_income","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Interest Income",
				                                 "value"=>$interest_income_val,"maxlength"=>10);
				                  echo form_input($interest_income);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Loan Closed:
						</label>
						<div class="col-lg-6">
							<?php
								$active = FALSE;
								if(isset($type_val) && $type_val!=''){
					 	 			if($type_val == '1'){
										$active = TRUE;
								 	}
							 	}
							?>
							<div class="m-checkbox-list">
								<label class="m-checkbox">
									<?php $load_closed = array('name' => 'load_closed','id' => 'load_closed','value' => 'yes',
											'class'  => 'm-checkbox','checked'  =>$active);
											echo form_checkbox($load_closed); 
									?>Yes<span></span>
								</label>
							</div>
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
				              		<a href="<?php echo base_url('receipt/list')?>" class="btn btn-secondary">Cancel</a>
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



