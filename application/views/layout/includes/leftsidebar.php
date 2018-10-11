<!-- BEGIN: Aside Menu -->
<div id="m_ver_menu"
	class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
	m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
	<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
		<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a
			href="<?php echo base_url('dashboard');?>" class="m-menu__link "> <i
				class="m-menu__link-icon flaticon-line-graph"></i> <span
				class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span
						class="m-menu__link-text"> Dashboard </span> <!-- <span
						class="m-menu__link-badge"> <span class="m-badge m-badge--danger">
								1 </span>
					</span> -->
				</span>
			</span>
		</a></li>
		<li class="m-menu__section">
			<h4 class="m-menu__section-text">Components</h4> <i
			class="m-menu__section-icon flaticon-more-v2"></i>
		</li>
		<li class="m-menu__item  m-menu__item--submenu <?php echo ($this->uri->segment(1)=='customer')?'m-menu__item--expanded m-menu__item--open':'';?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
				class="m-menu__link m-menu__toggle"> <i
				class="m-menu__link-icon flaticon-user"></i> <span
				class="m-menu__link-text"> Customer management</span> <i
				class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu ">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='customer' && $this->uri->segment(2)=='add')?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('customer/add'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Add Customer </span>
					</a></li>
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='customer' && ($this->uri->segment(2)=='list' || $this->uri->segment(2)=='edit' || $this->uri->segment(2)=='ledger'))?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('customer/list'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Customer List</span>
					</a></li>
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='customer' && ($this->uri->segment(2)=='outstanding_list'))?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('customer/outstanding_list'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Outstanding List</span>
					</a></li>
				</ul>
			</div>
		</li>
		<li class="m-menu__item  m-menu__item--submenu <?php echo ($this->uri->segment(1)=='receipt')?'m-menu__item--expanded m-menu__item--open':'';?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
				class="m-menu__link m-menu__toggle"> <i
				class="m-menu__link-icon flaticon-interface-9"></i> <span
				class="m-menu__link-text"> Receipt management </span> <i
				class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu ">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='receipt' && $this->uri->segment(2)=='add')?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('receipt/add'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Add Receipt </span>
					</a></li>
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='receipt' && ($this->uri->segment(2)=='list' || $this->uri->segment(2)=='edit'))?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('receipt/list'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Receipt List</span>
					</a></li>
				</ul>
			</div>
		</li>
		<li class="m-menu__item  m-menu__item--submenu <?php echo ($this->uri->segment(1)=='expenses')?'m-menu__item--expanded m-menu__item--open':'';?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
				class="m-menu__link m-menu__toggle"> <i
				class="m-menu__link-icon flaticon-share"></i> <span
				class="m-menu__link-text"> Expenses management </span> <i
				class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu ">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='expenses' && $this->uri->segment(2)=='add')?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('expenses/add'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Add Expenses </span>
					</a></li>
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='expenses' && ( $this->uri->segment(2)=='list' || $this->uri->segment(2)=='edit') )?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('expenses/list'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Expenses List</span>
					</a></li>
				</ul>
			</div>
		</li>
		<li class="m-menu__item  m-menu__item--submenu <?php echo ($this->uri->segment(1)=='cash')?'m-menu__item--expanded m-menu__item--open':'';?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
				class="m-menu__link m-menu__toggle"> <i
				class="m-menu__link-icon flaticon-coins"></i> <span
				class="m-menu__link-text"> Cash management </span> <i
				class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu ">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='cash' && $this->uri->segment(2)=='add')?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('cash/add'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Add Cash </span>
					</a></li>
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='cash' && ( $this->uri->segment(2)=='list' || $this->uri->segment(2)=='edit') )?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('cash/list'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Cash List</span>
					</a></li>
				</ul>
			</div>
		</li>
		<li class="m-menu__item  m-menu__item--submenu <?php echo ($this->uri->segment(1)=='profit')?'m-menu__item--expanded m-menu__item--open':'';?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
				class="m-menu__link m-menu__toggle"> <i
				class="m-menu__link-icon flaticon-line-graph"></i> <span
				class="m-menu__link-text"> Profit management </span> <i
				class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div class="m-menu__submenu ">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item <?php echo ($this->uri->segment(1)=='profit')?'m-menu__item--active':'';?>" aria-haspopup="true"><a
						href="<?php echo base_url('profit'); ?>" class="m-menu__link "> <i
							class="m-menu__link-bullet m-menu__link-bullet--dot"> <span></span>
						</i> <span class="m-menu__link-text"> Profit </span>
					</a></li>
				</ul>
			</div>
		</li>
	</ul>
</div>
<!-- END: Aside Menu -->