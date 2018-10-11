<!-- BEGIN: Subheader -->
<style type="text/css">
	.error{
		color: red;
	}
</style>
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto" style="width: 100%">
			<h3 class="m-subheader__title ">Cash On Hand List</h3>
			<a href="<?php echo base_url('profit');?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill pull-right">
				<span><i class="la la-arrow-left"></i><span>Back</span></span>
			</a>
		</div>
		
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
			<div class="row align-items-center">
				<div class="col-xl-12 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<!-- <div class="col-md-3">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div> -->
						<div class="col-md-3 form-inline">
							<label>Start date:&nbsp;</label>
					     	<?php                                             
				                  $start_date = array ("name" => "start_date", "id"=>"start_date","type"=>"date",
				                                 "class" => "form-control m-input");
				                  echo form_input($start_date);                                                    
				            ?>
				            <span id="start_date_error" class="error" style="display: none;">Start date is required.</span>
						</div>
						<div class="col-md-3 form-inline">
							<label>End date:&nbsp;</label>
					     	<?php                                             
				                  $end_date = array ("name" => "end_date", "id"=>"end_date","type"=>"date",
				                                 "class" => "form-control m-input");
				                  echo form_input($end_date);                                                    
				            ?>
				            <span id="end_date_error" class="error" style="display: none;">End date is required.</span>
						</div>
						<div class="col-md-3">
							<input type="button" name="search" id="search" value="Submit" class="btn btn-info" />
						</div>
					</div>
				</div>
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
				<div class="m-separator m-separator--dashed d-xl-none"></div>
				</div>
			</div>
		</div>
		<span id="opening_balance" style="display: none;"></span>
		<input type="hidden" id="profit_datatableurl" value="<?php echo base_url('profit/dataTables');?>">
		<input type="hidden" id="openingbalance_url" value="<?php echo base_url('profit/openingBalance');?>">
		<div class="profit_table" id="ajax_data"></div>		
</div>



