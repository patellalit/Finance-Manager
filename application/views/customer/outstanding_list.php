<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Outstanding list</h3>
		</div>
		
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
			<div class="row align-items-center">
				<div class="col-xl-12 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-3">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label class="m-label m-label--single">
										Type:
									</label>
								</div>
								<div class="m-form__control">
									<select name="emi_type" id="emi_type" class='form-control m-input'>
										<option value="1" selected>Monthly</option>
										<option value="2">Weekly</option>
									</select>
								</div>
							</div>
						    <!-- <select name="emi_type" id="emi_type" class='form-control m-input'>
						        <option value="1" selected>Monthly</option>
						        <option value="2">Weekly</option>
						    </select> -->
						</div>
					</div>
				</div>
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
				<div class="m-separator m-separator--dashed d-xl-none"></div>
				</div>
			</div>
		</div>
		<input type="hidden" id="outstanding_datatableurl" value="<?php echo base_url('customer/outstanding_dataTables');?>">
		<input type="hidden" id="customerledger_datatableurl" value="<?php echo base_url('customer/ledger/');?>">
		<div class="outstanding_table" id="ajax_data"></div>		
</div>



