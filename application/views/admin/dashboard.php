<div class="row">

	<?php if ($this->SqlModel->checkAccess('access_users', $this->user_data) == true) { ?>
	<div class="col-sm-3" onclick="javascript:window.location='<?php echo base_url('manage/admins/');?>'">
	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $totalAdmins;?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Admin Users</h3>
			
		</div>
		
	</div>
    <?php  } if ($this->SqlModel->checkAccess('access_users', $this->user_data) == true) { ?>
      <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/website_users/');?>'">
	
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-flow-tree"></i></div>
			<div class="num" data-start="0" style="visibility:hidden" data-end="<?php echo $totalUsers;?>" data-postfix="" data-duration="1500" data-delay="2000">0</div>
			
			<h3>Website Users</h3>
			
		</div>
		
	</div>
    <?php  } if ($this->SqlModel->checkAccess('access_menu', $this->user_data) == true) { ?>
      <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/menu/');?>'">
	
		<div class="tile-stats tile-steel">
			<div class="icon"><i class="entypo-flow-tree"></i></div>
			<div class="num" data-start="0" style="visibility:hidden" data-end="<?php echo $totalPages;?>" data-postfix="" data-duration="1500" data-delay="2000">0</div>
			
			<h3>Menu Management</h3>
			
		</div>
		
	</div>
     <?php  } if ($this->SqlModel->checkAccess('access_pages', $this->user_data) == true) { ?>
     <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/pages/');?>'">
	
		<div class="tile-stats tile-purple">
			<div class="icon"><i class="entypo-doc-text-inv"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $totalPages;?>" data-postfix="" data-duration="1500" data-delay="2000">0</div>
			
			<h3>Web Pages</h3>
			
		</div>
		
	</div>
    <?php  } if ($this->SqlModel->checkAccess('access_pages', $this->user_data) == true) { ?>
 <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/team_members/');?>'">
	
		<div class="tile-stats tile-plum">
			<div class="icon"><i class="entypo-star-empty"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $totalMembers;?>" data-postfix="" data-duration="1500" data-delay="2000">0</div>
			
			<h3>Team Members</h3>
			
		</div>
		
	</div>
  <?php  } if (isset($lock) && $this->SqlModel->checkAccess('access_sliders', $this->user_data) == true) { ?>
	<div class="col-sm-3" onclick="javascript:window.location='<?php echo ADMIN_URL;?>sliders'">
	
		<div class="tile-stats tile-purple"  >
			<div class="icon"><i class="entypo-camera"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $totalSliders;?>" data-postfix="" data-duration="1500" data-delay="400">0</div>
			
			<h3>Image Sliders</h3>
		</div>
		
	</div>
     
   
    
    
     <?php  } if ($this->SqlModel->checkAccess('access_contacts', $this->user_data) == true) { ?>
    
    <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/contactus/');?>'">
	
		<div class="tile-stats tile-lime">
			<div class="icon"><i class="entypo-paper-plane"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $totalContactus;?>" data-postfix="" data-duration="1500" data-delay="2800">0</div>
			
			<h3>Contact Us</h3>
			
		</div>
		
	</div>
    <?php  } if ($this->SqlModel->checkAccess('access_contacts', $this->user_data) == true) { ?>
    
    <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/home/contacts/');?>'">
	
		<div class="tile-stats tile-pink">
			<div class="icon"><i class="entypo-mail"></i></div>
			<div class="num" style="visibility:hidden" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="2800">0</div>
			
			<h3>Contact Settings</h3>
			
		</div>
		
	</div>
    <?php  } if ($this->SqlModel->checkAccess('access_settings', $this->user_data) == true) { ?>
    <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/home/websettings/');?>'">
	
		<div class="tile-stats tile-orange">
			<div class="icon"><i class="entypo-cog"></i></div>
			<div class="num" style="visibility:hidden" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="2800">0</div>
			
			<h3>Website Settings</h3>
			
		</div>
		
	</div>
   <?php } ?>
    <div class="col-sm-3"  onclick="javascript:window.location='<?php echo base_url('manage/home/logout');?>'">
	
		<div class="tile-stats tile-primary">
			<div class="icon"><i class="entypo-logout"></i></div>
			<div style="visibility:hidden" class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="2400">0</div>
			
			<h3>Logout</h3>
			
		</div>
		
	</div>
    
</div>
