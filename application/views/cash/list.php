<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Cash List</h3>
		</div>
		
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
		<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
			<div class="row align-items-center">
				<div class="col-xl-8 order-2 order-xl-1">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-4">
							<div class="m-input-icon m-input-icon--left">
								<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 order-1 order-xl-2 m--align-right">
					<a href="<?php echo base_url('cash/add');?>" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
					<span><i class="la la-plus"></i><span>
						Add Cash
					</span>
					</span>
					</a>
				<div class="m-separator m-separator--dashed d-xl-none"></div>
				</div>
			</div>
		</div>
		<input type="hidden" id="cash_datatableurl" value="<?php echo base_url('cash/dataTables');?>">
		<input type="hidden" id="cash_edit_url" value="<?php echo base_url('cash/edit/');?>">
		<input type="hidden" id="cash_delete_url" value="<?php echo base_url('cash/delete/');?>">
		<div class="cash_table" id="ajax_data"></div>		
</div>

<!-- Delete popupModal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModal">
    <div class="modal-dialog" role="document">
      	<div id="modal_datas">
	        <div class="modal-content">
	          	<div class="modal-header">
		            <h2 class="modal-title" id="delModal" style="text-align:center">Are You Sure you want to delete?</h2>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              	<span aria-hidden="true">&times;</span>
		            </button>
	          	</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="del_id" id="del_id">
					<div class="form-Action " style="text-align:center">
						<button class="btn btn-default" onclick="delete_record();">Delete</button>                
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>     
	      	</div>
    	</div>  
  	</div>
</div>
<!-- End popupModal -->


<!-- view popupModal -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModal">
	<div class="modal-dialog" role="document">
		  <div id="modal_datas">
			    <div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="dataModal" style="text-align:center">Info</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						
					</div>
			      	<div class="modal-body" id="Wrapper-notify">
				          
			      	</div>     
			  	</div>
		</div>  
	</div>
</div>
<!-- End popupModal -->

