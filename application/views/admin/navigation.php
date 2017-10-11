<body class="page-body">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo inner-logo">
				<a href="<?php echo ADMIN_URL;?>">
               
               		<?php 
					$logo = './assets/frontend/images/logo/'.$this->SqlModel->getSingleField('logo2','site_settings',array('id'=>1));
					if(file_exists($logo))
					{
					?>
					<img src="<?php echo $this->imagethumb->image($logo,150,0);?>" alt="Admin Logo" />
					
                    <?php } ?>
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
				
		<ul id="main-menu" class="">
		 
			<li <?php echo (isset($dashBoard))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>">
					<i class="entypo-gauge"></i>
					<span>Dashboard</span>
				</a>
				
			</li>
            
            
           <?php
		if ($this->SqlModel->checkAccess('access_users', $this->user_data) == true) {
			?>	 
			<li <?php echo (isset($adminsActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>admins">
					<i class="entypo-users"></i>
					<span>Admin Users</span>
				</a>
				
			</li>
       
            <?php
		}
		if ($this->SqlModel->checkAccess('access_users', $this->user_data) == true) {
			?>	 
			<li <?php echo (isset($website_usersActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>website_users">
					<i class="entypo-user-add"></i>
					<span>Website Users</span>
				</a>
				
			</li>
			<?php }
			if (isset($lock)&&$this->SqlModel->checkAccess('access_sliders', $this->user_data) == true) {
			?>
			<li <?php echo (isset($sliderActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>sliders">
					<i class="entypo-camera"></i>
					<span>Image Sliders</span>
				</a>
				
			</li>
           <?php }
			if ($this->SqlModel->checkAccess('access_menu', $this->user_data) == true) {
			?>
            <li <?php echo (isset($menuActive))? 'class="opened"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>menu">
					<i class="entypo-flow-tree"></i>
					<span>Menu Manager</span>
				</a>
				<ul>
                <li <?php echo (isset($menuMainActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>menu">
							<span>Main Menu</span>
						</a>
					</li>
                    <li <?php echo (isset($menuFootActive)&&$menuFootActive=="one")? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>foot/index/one">
							<span>Footer Menu</span>
						</a>
					</li>
                  <!--  <li <?php echo (isset($menuFootActive)&&$menuFootActive=="two")? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>foot/index/two">
							<span>Footer Menu Two</span>
						</a>
					</li>
					
                   <li <?php echo (isset($menuFootActive)&&$menuFootActive=="two")? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>foot/index/two">
							<span>Portfolio</span>
						</a>
					</li>
                   <li <?php echo (isset($menuFootActive)&&$menuFootActive=="three")? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>foot/index/three">
							<span>Company</span>
						</a>
					</li>
                  -->
					
			</ul>
			</li>
           <?php }
			if ($this->SqlModel->checkAccess('access_pages', $this->user_data) == true) {
			?>
            <li <?php echo (isset($pagesActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>pages">
					<i class="entypo-doc-text-inv"></i>
					<span>Web Pages</span>
				</a>
				
			</li>
            <?php }
			if ($this->SqlModel->checkAccess('access_pages', $this->user_data) == true) {
			?>
          <li <?php echo (isset($team_membersActive))? 'class="active"' : '';?>>
            <a href="<?php echo ADMIN_URL;?>team_members">
                <i class="entypo-star-empty"></i>
                <span>Team Members</span>
            </a>
            
       	 </li>
        <?php
			}
			if ($this->SqlModel->checkAccess('access_contacts', $this->user_data) == true) {
			?>
            <li <?php echo (isset($contactusActive))? 'class="active"' : '';?>>
            <a href="<?php echo ADMIN_URL;?>contactus">
                <i class="entypo-paper-plane"></i>
                <span>Contact Us</span>
            </a>
         	 </li>
             <li <?php echo (isset($contactsActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>home/contacts">
					<i class="entypo-mail"></i>
					<span>Contact Settings</span>
				</a>
				
			</li>
            
        <?php }
			if ($this->SqlModel->checkAccess('access_settings', $this->user_data) == true) {
			?>
            
            <li <?php echo (isset($wsettingActive))? 'class="active"' : '';?>>
				<a href="<?php echo ADMIN_URL;?>home/websettings">
					<i class="entypo-cog"></i>
					<span>Website Settings</span>
				</a>
				
			</li>
           <?php }?> 
            
            <li>
				<a href="<?php echo ADMIN_URL;?>home/logout">
					<i class="entypo-logout"></i>
					<span>Logout</span>
				</a>
				
			</li>
  		
			
			
			
			
		</ul>
				
	</div>
<?php ################# END of Navigation ##################### ?>
<div class="main-content">
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info"><!-- add class "pull-right" if you want to place this from right -->
				
					<strong>Welcome!</strong> <?php echo $userdata['full_name'];?> <br/><strong>Last login:</strong> <?php echo ($this->session->userdata('last_login')!="") ? date('M d, Y h:i a',strtotime($this->session->userdata('last_login'))) : '-';?> | <strong>IP Address:</strong> <?php echo ($this->session->userdata('last_ip')!="") ? $this->session->userdata('last_ip') : '';?><br> <strong>Server Time:</strong> <?php echo date('M d, Y h:i a');?>
				
			</li>
		
		</ul>
		
		
	
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			<li>
				<a href="<?php echo ADMIN_URL.'home/settings';?>">
					Account Settings <i class="entypo-tools right"></i>
				</a>
			</li>
			
			
			<li class="sep"></li>
			
			<li>
				<a href="<?php echo ADMIN_URL.'home/logout';?>">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
		
	</div>
	
</div>
<hr />

<script type="text/javascript">
function getRandomInt(min, max) 
{
	return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>