<style type="text/css">
	.error{
		color: red;
	}
</style>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Add Receipt</h3>
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
			      	$receipt_form = array('id'=>'receipt_formadd','autocomplete'=>'off','name'=>'receipt_formadd','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype'=>'multipart/form-data');
			    	echo form_open('receipt/save',$receipt_form);   
				?>
				<div class="m-portlet__body">

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Customer Name:
						</label>
						<div class="col-lg-6">
						 	<?php $customer_options = array(''=>'Select Customer Name');
							  	foreach($customer_data as $customer){
							      	$customer_options[$customer['id']] = $customer['name'];
							 	}
							  	echo form_dropdown('customer_id',$customer_options,set_value('customer_id'),'id="customer_id" class="form-control m-input"'); 
							?> 
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Receipt Date:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $receipt_date = array ("name" => "receipt_date", "id"=>"receipt_date","type"=>"date",
				                                 "class" => "form-control m-input","value"=>set_value('receipt_date'));
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
				                                 "value"=>set_value('emi'),"maxlength"=>15);
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
				                                 "value"=>set_value('interest_income'),"maxlength"=>10);
				                  echo form_input($interest_income);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Loan Closed:
						</label>
						<div class="col-lg-6">
							<div class="m-checkbox-list">
								<label class="m-checkbox">
									<?php $load_closed = array('name' => 'load_closed','id' => 'load_closed','value' => 'yes',
											'class'  => 'm-checkbox');
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

