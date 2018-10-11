<!-- BEGIN: Subheader -->
<style type="text/css">
	.box-wrapper{border:solid 1px #CCC;padding:10px;margin-bottom: 25px;}
	.box-wrapper.red-bg{background-color:#f44336;}
	.box-wrapper.yellow-bg{background-color:#ff9800;}
	.box-wrapper.blue-bg{background-color:#55acee;}
	.box-wrapper.purple-bg{background-color:#9c27b0;}
	.box-wrapper h4{color:#FFF;}
	.box-wrapper p{color:#FFF; font-size:24px; font-weight:bold;}
	.box-wrapper a{text-decoration: none;}
</style>
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ">Profit</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	<?php
		//Cash on hand
		if(isset($cash)){
			$total_cash=$cash;
		}else{ 
			$total_cash=0;
		}
		if(isset($total_emi)){
			$grand_total_emi=$total_emi;
		}else{ 
			$grand_total_emi=0;
		}
		if(isset($total_loan_amount)){
			$grand_total_loan_amount=$total_loan_amount;
		}else{ 
			$grand_total_loan_amount=0;
		}
		//gross income 
		if(isset($processing_charges)){
			$total_processing_charges=$processing_charges;
		}else{ 
			$total_processing_charges=0;
		}
		if(isset($interest_income)){
			$total_interest_income=$interest_income;
		}else{ 
			$total_interest_income=0;
		}
		if(isset($expenses)){
			$total_expenses=$expenses;
		}else{ 
			$total_expenses=0;
		}
		$gross_income=$total_processing_charges+$total_interest_income;
		$net_income=$gross_income-$total_expenses;

		$cash_on_hand=(($total_cash+$grand_total_emi+$total_processing_charges)-($total_expenses+$grand_total_loan_amount));
		
	?>
	<?php /*<div class="row">
		<div class="col-md-4">
			<div class="box-wrapper purple-bg">
				<a href="<?php echo base_url('profit/cash_on_hand')?>">
					<h4>Cash On Hand:</h4>
					<p><?php echo $cash_on_hand;?></p>
				</a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper yellow-bg">
				<a href="<?php echo base_url('profit/gross_income')?>">
					<h4>Gross Income:</h4>
					<p><?php echo $gross_income;?></p>
				</a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper blue-bg">
					<h4>Total Expenses:</h4>
					<p><?php echo $total_expenses;?></p>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="box-wrapper red-bg">
					<h4>Net Income:</h4>
					<p><?php echo $net_income;?></p>
			</div>
		</div>
	</div>*/?>	
	
	<div class="row">
	    <div class="col-md-4">
			<div class="box-wrapper purple-bg">
					<h4>Capital:</h4>
					<p><?php echo $total_cash;?></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper purple-bg">
					<h4>Net Income:</h4>
					<p><?php echo $net_income;?></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper purple-bg">
			    <a href="<?php echo base_url('profit/gross_income')?>">
					<h4>Total:</h4>
					<p><?php echo $total_cash + $net_income;?></p>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-4">
			<div class="box-wrapper blue-bg">
					<h4>Closing Balance:</h4>
					<p><?php echo $outstanding;?></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper blue-bg">
			    <a href="<?php echo base_url('profit/cash_on_hand')?>">
					<h4>Cash on hand:</h4>
					<p><?php echo $cash_on_hand;?></p>
				</a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box-wrapper blue-bg">
					<h4>Total:</h4>
					<p><?php echo $outstanding + $cash_on_hand;?></p>
			</div>
		</div>
	</div>
</div>





