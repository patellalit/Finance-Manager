<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Customer ledger list</h3>
		</div>
		
	</div>
</div> -->
<!-- END: Subheader -->
<div class="m-content">
	<div class="row">
		<div class="col-xl-12">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">Customer ledger</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
				<!--begin::Section-->
					<div class="m-section">
						<span class="m-section__sub">
							Customer Name:&nbsp;<?php echo isset($customer_name)?$customer_name:''?>
						</span>
						<span class="m-section__sub">
							Mobile Number:&nbsp;
							<?php 
								$customer_mobile = explode(',', $mobile_no);
								$output_text='';
								if(!empty($customer_mobile)){
									if(count($customer_mobile)>1){
										foreach ($customer_mobile as $key => $value) {
											$output_text.='<a href="tel:'.$value.'">'.$value.'</a>,';
										}
									}else{
											$output_text.='<a href="tel:'.$mobile_no.'">'.$mobile_no.'</a>';
									}
									echo $output_text;
								}else{
									echo 'N/A';
								}
							?>
						</span>
						<br>
						<div class="m-section__content">
							<table class="table table-striped m-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Payment</th>
										<th>Receipt</th>
										<th>Closing balance</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1; 
									if(!empty($ledger_data)){ 
										$loan_amount = 0;
										foreach ($ledger_data as $key => $row) { 
										$date=isset($row['date'])?date('d-m-Y',strtotime($row["date"])):'';
										$payment=isset($row['payment'])?$row["payment"]:'';
										$receipt=isset($row['receipt'])?$row["receipt"]:'';
										if($i==1){
											$loan_amount = $payment;
											?>
											<tr>
												<th scope="row"><?php echo $i;?></th>
												<td><?php echo $date;?></td>
												<td><?php echo $payment;?></td>
												<td><?php echo $receipt;?></td>
												<td><?php echo number_format($payment,2);?></td>
											</tr>
											<?php }else{
												$loan_amount -= $receipt;
												?>
											<tr>
												<th scope="row"><?php echo $i;?></th>
												<td><?php echo $date;?></td>
												<td><?php echo $payment;?></td>
												<td><?php echo number_format($receipt,2);?></td>
												<td><?php echo number_format($loan_amount,2);?></td>
											</tr>
										<?php }
											$i++; 
										} 
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



