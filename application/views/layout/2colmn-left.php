<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo $page_title ?>
		</title>
		<meta name="description" content="<?php $page_description ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<link href="<?php echo base_url()?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="<?php echo base_url()?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/demo/default/media/img/logo/favicon.ico" />
		<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			
		<?php $this->view('layout/includes/header') ?>			
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<?php $this->view('layout/includes/leftsidebar') ?>				
				</div>
				<!-- END: Left Aside -->
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<?php $this->view($content) ?>
				</div>
			</div>
			<!-- end:: Body -->
			<?php $this->view('layout/includes/footer') ?>

		</div>
		<!-- end:: Page -->
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->		    
		
    	<!--begin::Base Scripts -->
		<script src="<?php echo base_url()?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
		<script src="<?php echo base_url()?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
		<script src="<?php echo base_url()?>assets/app/js/dashboard.js" type="text/javascript"></script>
		<!--end::Page Snippets -->
		
		<?php
  			if(isset($jsfilearray)){ foreach($jsfilearray as $jsfile){
          			echo '<script type="text/javascript" src="'.$jsfile.'?'.FINANCE_VERSION.'"></script>';
          			echo "\n";
  				}
  			}	  
		?>
	</body>
	<!-- end::Body -->
</html>
