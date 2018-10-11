<style type="text/css">
	.error{
		color: red;
	}
	.btn-container {
	    float: right;
	    margin-top: 15px;
	}
</style>
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
								Profile Form
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
				    $profile_form = array('id'=>'profile_form','name'=>'profile_form','method'=>'post','autocomplete'=>'off','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed');
				    echo form_open('profile/update',$profile_form); 
				?>
				<div class="m-portlet__body">
					<?php
			    		$admin_id = !isset($admin_data[0]['id'])?'':$admin_data[0]['id'];
						$full_name = !isset($admin_data[0]['full_name'])?'':$admin_data[0]['full_name'];
						$email = !isset($admin_data[0]['email'])?'':$admin_data[0]['email']; 
					?>
					<input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id;?>">
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Full Name:
						</label>
						<div class="col-lg-6">
							<?php 
							    $full_name = array ("name" => "full_name", "id"=>"full_name","type"=>"text" , "class" => "form-control m-input","placeholder"=>"Enter Full Name","value"=>$full_name);
							    echo form_input($full_name);
							?>
						</div>
					</div>

					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Email:
						</label>
						<div class="col-lg-6">
							<?php 
							    $email = array ("name" => "email", "id"=>"email","type"=>"text" , "class" => "form-control m-input","placeholder"=>"Enter Email","value"=>$email,"readonly"=>true);
							    echo form_input($email);
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
				              		<a href="<?php echo base_url('dashboard')?>" class="btn btn-secondary">Cancel</a>
									<!-- <button type="reset" class="btn btn-secondary">
										Cancel
									</button> -->
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