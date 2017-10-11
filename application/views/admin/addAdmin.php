 <?php
 if($alert=="error"||$alert=="edit"){
	$full_name = $tbl_data['full_name'];
	$user_name = $tbl_data['user_name'];
	$email = $tbl_data['email'];
	$pwd = $tbl_data['pwd'];
	$pwd2 = $tbl_data['pwd'];
	$status = $tbl_data['status']; 
	$user_role = $tbl_data['user_role']; 
	
 }
 else{
	$full_name="";
	$user_name = "";
	$email = "";
	$pwd = "";
	$pwd2 = "";
	$user_role = "Super Admin";
	$status = "Enable";
 }
if($alert=="error")
{
$pwd = "";
$pwd2 = "";	
}

 
 if($alert=="edit")
 {
	$crumb = "Edit";
	$action = "editRecord/".$tbl_data['id']; 
 }
 else{
	$crumb = "Add";
	$action = "addRecord"; 
 }
 ?>
<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller;?>"><i></i><?php echo $this->moduleName;?></a></li>
<li class="active"><strong><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></strong></li>
</ol>
     
     
     
     
<?php if($alert=="success") { ?>
<div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Settings saved sucessfully.</div>
	</div>
</div>
<?php } if($alert=="error"||$editerror=="editerror") { ?>
<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> The user name or email you specified is already exist, please use different user name or email.</div>
	</div>
</div>
<?php } if($alert=="perror") { ?>
<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> Unable to change the password, please provide the correct current password.</div>
	</div>
</div>

<?php } ?>     
     
     

<h2><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
	
		<form role="form" id="admin_form"   name="admin_form" method="post" action="<?php echo ADMIN_URL.$this->controller.'/'.$action;?>" >
			
			<div class="form-group">
				<label class="control-label">Name :</label>
				
				<input type="text" class="form-control"   name="full_name" id="full_name" value="<?php echo $full_name;?>" placeholder="Example: John Smith" />
			</div>
            
            
			
			<div class="form-group">
				<label class="control-label">Email :</label>
                
                  <input type="text" class="form-control"   name="email" id="email" value="<?php echo $email;?>" placeholder="john_smith@dummyemail.com" />
			</div>
			
			<div class="form-group">
				 <label class="control-label">User Name :</label>
                
                  <input type="text" class="form-control uname"   name="user_name" id="user_name" value="<?php echo $user_name;?>" placeholder="john.smith" />
			</div>
			
			<div class="form-group">
				 <label class="control-label">Password :</label>
               
                  <input type="password" class="form-control"   name="pwd" id="pwd" value="<?php echo $pwd;?>" placeholder="sM!thJ@hN" />
			</div>
			
			<div class="form-group">
				 <label class="control-label">Confirm Password :</label>
               
                  <input type="password" class="form-control"   name="pwd2" id="pwd2" value="<?php echo $pwd2;?>" placeholder="sM!thJ@hN" />
				<input type="hidden" value="Super Admin" name="user_role" id="user_role" />
            </div>
            <?php
			if(isset($lock))
			{?>
			<div class="form-group  <?php echo (isset($tbl_data['id'])&&(int)$tbl_data['id']===(int)1) ? 'hidden' : '';?>">
				 <label class="control-label">User Type :</label>
                
                  <select autocomplete="off" class="form-control"  name="user_role" id="user_role">
                 	<option value="Admin" <?php if($user_role=="Admin"){ echo ' selected="selected"';} ?>>Admin</option>
                    <option value="Super Admin" <?php if($user_role=="Super Admin"){ echo ' selected="selected"';} ?>>Super Admin</option>
                  </select>
			</div>
            
            <section <?php echo ($user_role=="Super Admin") ? ' style="display:none"' : ''; ?> id="access_roles" >
				        <hr /> 
                        
 <label class="control-label">User Rights :</label>
<br clear="all" />                 
                 
                <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_destinations"  <?php echo (isset($tbl_data['access_destinations'])&&$tbl_data['access_destinations']=="Yes") ? 'checked="checked"' : '';?>>Destinations
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_vendors"  <?php echo (isset($tbl_data['access_vendors'])&&$tbl_data['access_vendors']=="Yes") ? 'checked="checked"' : '';?>>Vendors
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_inclusions"  <?php echo (isset($tbl_data['access_inclusions'])&&$tbl_data['access_inclusions']=="Yes") ? 'checked="checked"' : '';?>>Inclusions
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_packages"  <?php echo (isset($tbl_data['access_packages'])&&$tbl_data['access_packages']=="Yes") ? 'checked="checked"' : '';?>>Packages
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_galleries"  <?php echo (isset($tbl_data['access_galleries'])&&$tbl_data['access_galleries']=="Yes") ? 'checked="checked"' : '';?>>Galleries
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_testimonials"  <?php echo (isset($tbl_data['access_testimonials'])&&$tbl_data['access_testimonials']=="Yes") ? 'checked="checked"' : '';?>>testimonials
								</label>
					</div>
                   
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_sliders"  <?php echo (isset($tbl_data['access_sliders'])&&$tbl_data['access_sliders']=="Yes") ? 'checked="checked"' : '';?>>Image Slider
								</label>
					</div>
                     <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_menu"  <?php echo (isset($tbl_data['access_menu'])&&$tbl_data['access_menu']=="Yes") ? 'checked="checked"' : '';?>>Menu Manager
								</label>
					</div>
                    
                     <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_pages"  <?php echo (isset($tbl_data['access_pages'])&&$tbl_data['access_pages']=="Yes") ? 'checked="checked"' : '';?>>Web Pages
								</label>
					</div>
                     
                     <div class="checkbox col-md-3 col-sm-6 ">
								<label>
									<input type="checkbox" value="Yes" name="access_blog"  <?php echo (isset($tbl_data['access_blog'])&&$tbl_data['access_blog']=="Yes") ? 'checked="checked"' : '';?>>Blog
								</label>
					</div>
                   
                     <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_bookings"  <?php echo (isset($tbl_data['access_bookings'])&&$tbl_data['access_bookings']=="Yes") ? 'checked="checked"' : '';?>>Bookings
								</label>
					</div>
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_subscribers"  <?php echo (isset($tbl_data['access_subscribers'])&&$tbl_data['access_subscribers']=="Yes") ? 'checked="checked"' : '';?>>Subscriptions
								</label>
					</div>
                    
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_contacts"  <?php echo (isset($tbl_data['access_contacts'])&&$tbl_data['access_contacts']=="Yes") ? 'checked="checked"' : '';?>>Contacts
								</label>
					</div>
                     
                    <div class="checkbox col-md-3 col-sm-6">
								<label>
									<input type="checkbox" value="Yes" name="access_settings"  <?php echo (isset($tbl_data['access_settings'])&&$tbl_data['access_settings']=="Yes") ? 'checked="checked"' : '';?>>Web Settings
								</label>
					</div>             <br clear="all" />
 <hr />
			</section>
          <?php } ?>  
			<div class="form-group <?php echo (isset($tbl_data['id'])&&(int)$tbl_data['id']===(int)1) ? 'hidden' : '';?> " >
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="status" id="status">
                    <option value="Enable" <?php if($status=="Enable"){ echo ' selected="selected"';} ?>>Enable</option>
                    <option value="Disable" <?php if($status=="Disable"){ echo ' selected="selected"';} ?>>Disable</option>
                  </select>
			</div>
            
            
           
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL.$this->controller;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
 
</div>
  
  </div>


