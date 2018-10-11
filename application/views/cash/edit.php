<style type="text/css">
	.error{
		color: red;
	}
</style>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Cash Expenses</h3>
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
								Cash Form
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
						<div class="alert" id="question-register-error-msg" style="display:none"></div>
					</div>	
				</div>
				<div class="clearfix"></div>
				<?php
				    $cashform_edit = array('id'=>'cash_formedit','autocomplete'=>'off','name'=>'cash_formedit','method'=>'post','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'enctype'=>'multipart/form-data');
			    			echo form_open('cash/update',$cashform_edit);   
				    	
				?>
				<div class="m-portlet__body">

					<?php  
							$cash_id = !isset($cash_data->id)?'':$cash_data->id;
							$title_val = !isset($cash_data->title)?'':$cash_data->title;
							$amount_val = !isset($cash_data->amount)?'':$cash_data->amount;
							if($cash_data->cash_date==Null || $cash_data->cash_date=='0000-00-00'){
								$cash_date_val='';
							}else{
								$cash_date_val = date('Y-m-d',strtotime($cash_data->cash_date));
							}

					?>
					<input type="hidden" id="cash_id" name="cash_id" value="<?php echo $cash_id;?>">

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Title:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $title = array ("name" => "title", "id"=>"title","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter title",
				                                 "value"=>$title_val);
				                  echo form_input($title);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Amount:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $amount = array ("name" => "amount", "id"=>"amount","type"=>"text",
				                                 "class" => "form-control m-input","placeholder"=>"Enter Interest Income",
				                                 "value"=>$amount_val,"maxlength"=>15);
				                  echo form_input($amount);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Cash Date:
						</label>
						<div class="col-lg-6">
						 	<?php                                             
				                  $cash_date = array ("name" => "cash_date", "id"=>"cash_date","type"=>"date",
				                                 "class" => "form-control m-input","value"=>$cash_date_val);
				                  echo form_input($cash_date);                                                    
				            ?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Description:
						</label>
						<div class="col-lg-8">
							<?php 
								$description = array ("name" => "description", "id"=>"description","type"=>"text" , 
												"class" => "form-control m-input");
								if(isset($cash_data->description)){
									$description["value"]=$cash_data->description;
								}else{
									$description["value"]='';
								}
								echo form_textarea($description);
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
				              		<a href="<?php echo base_url('cash/list')?>" class="btn btn-secondary">Cancel</a>
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



