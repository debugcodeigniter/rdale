<?php 
$crumb2 = "";

 if($alert=="error"||$alert=="edit" || $alert=="image_error"){
	$slider_title = $tbl_data['slider_title'];
	$slider_heading = $tbl_data['slider_heading'];
	$slider_heading_color = $tbl_data['slider_heading_color'];
	$slider_status = $tbl_data['slider_status']; 
	$slider_url = $tbl_data['slider_url'];
	$slider_desc =  $tbl_data['slider_desc'];
	$slider_desc_color =  $tbl_data['slider_desc_color'];
	$url_target =  $tbl_data['url_target'];
	$slider_btn =  $tbl_data['slider_btn'];
	$slider_tour_btn =  $tbl_data['slider_tour_btn'];
	$slider_tour_url =  $tbl_data['slider_tour_url'];
	$tour_url_target =  $tbl_data['tour_url_target'];
 }
 else{
	$slider_title="";
	$slider_heading_color = "#fffff";
	$slider_desc_color = "#fffff";
	$slider_heading = "";
	$slider_status = "Enable";
	$url_target = "self";
	$slider_url = "";
	$slider_desc = "";
	$slider_btn = "Read more";
	$slider_tour_btn = "View Tour";
	$slider_tour_url = "";
	$tour_url_target = "self";
	
 }
 
 if($alert=="edit")
 {
	$crumb = "Edit";
	$action = "editRecord/".$slider_cat."/".$tbl_data['slider_id']; 
	
 }
 else{
	$crumb = "Add";
	$action = "addRecord/".$slider_cat; 
 }
 ?>

<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL;?>sliders">Image Sliders</a></li>
<li><a href="<?php echo ADMIN_URL;?>slider/index/page/<?php echo $slider_cat;?>"><?php echo $slider_name;?> Slider Images</a></li>
<li class="active"><strong><?php echo $crumb;?> Slider Image</strong></li>
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
     
     

<h2><?php echo $crumb;?> Slider Image</h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="slider_form" name="slider_form" method="post" action="<?php echo base_url();?>manage/slider/<?php echo $action;?>" enctype="multipart/form-data" class="validate">
			<div class="form-group">
				<label class="control-label">Title :</label>
                
                  <input type="text" name="slider_title" data-validate="required" id="slider_title" value="<?php echo $slider_title;?>" class="form-control" placeholder="Title" />
			</div>
            <div class="form-group ">
				<label class="control-label">Heading :</label>
                
                  <input type="text" name="slider_heading" id="slider_heading" value="<?php echo $slider_heading;?>" class="form-control" placeholder="Heading" />
			</div>
            <div class="form-group">
								<label class="control-label">Heading Color :</label>
								
								
									<div class="input-group">
										<input autocomplete="off" type="text" id="slider_heading_color" name="slider_heading_color" class="form-control colorpicker" data-format="hex" value="<?php echo $slider_heading_color;?>" />
										
										<div class="input-group-addon">
											<i class="color-preview"></i>
										</div>
									</div>
								
							</div>
            <div class="form-group ">
				<label class="control-label">Text :</label>
                
                  <textarea style="resize:none" name="slider_desc" id="slider_desc"  class="form-control" placeholder="Text" /><?php echo $slider_desc;?></textarea>
			</div>
            <div class="form-group">
								<label class="control-label">Text Color :</label>
								
								
									<div class="input-group">
										<input autocomplete="off" type="text" id="slider_desc_color" name="slider_desc_color" class="form-control colorpicker" data-format="hex" value="<?php echo $slider_desc_color;?>" />
										
										<div class="input-group-addon">
											<i class="color-preview"></i>
										</div>
									</div>
								
							</div>
            <div class="form-group hidden">
				 <label class="control-label">Read More Button Text :</label>
               
                  <input type="text" name="slider_btn" id="slider_btn" value="<?php echo $slider_btn;?>" class="form-control" placeholder="Read More" maxlength="50" />
			</div>
			
			<div class="form-group hidden">
				 <label class="control-label">Read More URL :</label>
               
                  <input type="text" name="slider_url" id="slider_url" value="<?php echo $slider_url;?>" class="form-control" placeholder="http://www.yourwebsite.com/yourpage.html" />
			</div>
            
			<div class="form-group hidden">
				 <label class="control-label">Read More URL Target :</label>
                
                  <select class="form-control"  name="url_target" id="url_target">
                    <option value="self" <?php if($url_target=="self"){ echo ' selected="selected"';} ?>>Current Window</option>
                    <option value="blank" <?php if($url_target=="blank"){ echo ' selected="selected"';} ?>>New Window</option>
                  </select>
			</div>
            
             <div class="form-group hidden">
				 <label class="control-label">View Tour Button Text :</label>
               
                  <input type="text" name="slider_tour_btn" id="slider_tour_btn" value="<?php echo $slider_tour_btn;?>" class="form-control" placeholder="View Tour" maxlength="50" />
			</div>
			
			<div class="form-group hidden">
				 <label class="control-label">View Tour URL :</label>
               
                  <input type="text" name="slider_tour_url" id="slider_tour_url" value="<?php echo $slider_tour_url;?>" class="form-control" placeholder="http://www.yourwebsite.com/tour/yourpage.html" />
			</div>
            
			<div class="form-group hidden">
				 <label class="control-label">View Tour URL Target :</label>
                
                  <select class="form-control"  name="tour_url_target" id="tour_url_target">
                    <option value="self" <?php if($tour_url_target=="self"){ echo ' selected="selected"';} ?>>Current Window</option>
                    <option value="blank" <?php if($tour_url_target=="blank"){ echo ' selected="selected"';} ?>>New Window</option>
                  </select>
			</div>
            
            
            
            
            
			<div class="form-group">
				 <label class="control-label">Select  Image :</label>
               
                 <input accept="image/x-png,image/png,image/pjpeg,image/jpeg" class="<?php echo ($alert=="edit") ? '' : 'required';?>" type="file" name="uploadfile" id="uploadfile" />

			</div>
			
			<div class="form-group">
            <label class="control-label"><?php if($alert=="edit")
				{?>
                <a href="<?php echo ($tbl_data['slider_large']!="" && file_exists('./assets/frontend/images/slider/'.$tbl_data['slider_large'])) ? FRONTEND_ASSETS.'images/slider/'.$tbl_data['slider_large'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
					<img width="180" src="<?php echo ($tbl_data['slider_thumb']!="" && file_exists('./assets/frontend/images/slider/'.$tbl_data['slider_thumb'])) ? FRONTEND_ASSETS.'images/slider/'.$tbl_data['slider_thumb'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a><br/>
				<?php }?></label>
				 <br/><strong>Max Size:</strong> 50 Mb. <strong>Image Type:</strong> JPEG / PNG<br/>
                 <strong>Width:</strong> 1800px <strong>Height: </strong> 700px
			</div>
            <hr />
            
			
			
			 
			<div class="form-group">
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="slider_status" id="slider_status">
                    <option value="Enable" <?php if($slider_status=="Enable"){ echo ' selected="selected"';} ?>>Enable</option>
                    <option value="Disable" <?php if($slider_status=="Disable"){ echo ' selected="selected"';} ?>>Disable</option>
                  </select>
			</div>
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>slider/index/page/<?php echo $slider_cat;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
</div>
  
  </div>

