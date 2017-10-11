
<?php 
$crumb2 = "";



 if($alert=="error"||$alert=="edit" || $alert=="image_error"){
	$sliders_title = $tbl_data['sliders_title'];
	$sliders_status = $tbl_data['sliders_status']; 
	
 }
 else{
	$sliders_title="";
	$sliders_status = "Enable";
	
 }
 
 if($alert=="edit")
 {
	$crumb = "Edit";
	$action = "editRecord/".$tbl_data['sliders_id']; 
	
 }
 else{
	$crumb = "Add";
	$action = "addRecord"; 
 }
 ?>

<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL;?>sliders"><i></i>Image Sliders</a></li>
<li class="active"><strong><?php echo $crumb;?> Slider</strong></li>
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
<?php } else if($alert=="image_error"||$editerror=="image_error"){ ?>
<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> Unable to upload the image, please check the file format and size.</div>
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
     
     

<h2><?php echo $crumb;?> Slider</h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="sliders_form" name="sliders_form" method="post" action="<?php echo base_url();?>manage/sliders/<?php echo $action;?>" enctype="multipart/form-data" class="validate" >
			<div class="form-group">
				<label class="control-label">Title :</label>
                
                  <input type="text" name="sliders_title" id="sliders_title" value="<?php echo $sliders_title;?>" class="form-control required" placeholder="Example: Home Page Slider" />
			</div>
            
      	
			<div class="form-group">
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="sliders_status" id="sliders_status">
                    <option value="Enable" <?php if($sliders_status=="Enable"){ echo ' selected="selected"';} ?>>Enable</option>
                    <option value="Disable" <?php if($sliders_status=="Disable"){ echo ' selected="selected"';} ?>>Disable</option>
                  </select>
			</div>
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>sliders'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
</div>
  
  </div>

