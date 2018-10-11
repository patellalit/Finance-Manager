<style type="text/css">
	.error{
		color: red;
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
								Change Password Form
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
				    $password_changeform = array('id'=>'password_changeform','name'=>'password_changeform','method'=>'post','autocomplete'=>'off','class'=>'m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed');
				    echo form_open('profile/pw_update',$password_changeform); 
					?>
				<div class="m-portlet__body">
					<?php
			    		$admin_id = !isset($admin_data[0]['id'])?'':$admin_data[0]['id'];
						$password = !isset($admin_data[0]['password'])?'':$admin_data[0]['password']; 
					?>
					<input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id;?>">
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							New Password:
						</label>
						<div class="col-lg-6">
							<?php 
							    $new_password = array ("name" => "new_password", "id"=>"new_password","type"=>"password" , "class" => "form-control m-input","placeholder"=>"Enter New Password","value"=>set_value("new_password"));
							    echo form_input($new_password);
							?>
						</div>
					</div>


					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">
							Confirm Password:
						</label>
						<div class="col-lg-6">
							<?php 
							    $r_password = array ("name" => "r_password", "id"=>"r_password","type"=>"password" , "class" => "form-control m-input","placeholder"=>"Enter Confirm Password","value"=>set_value("r_password"));
							    echo form_input($r_password);
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

