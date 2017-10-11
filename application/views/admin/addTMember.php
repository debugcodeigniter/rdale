<?php 

 $action = base_url('manage/'.$this->controller).'/';
 if($alert=="edit")
 {
	$crumb = "Edit";
	$action.= "editRecord/".$tbl_data[$this->pKey]; 
	
 }
 else{
	$crumb = "Add";
	$action.= "addRecord"; 
 }
 ?>

<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller;?>"><i></i><?php echo $this->moduleName;?></a></li>
<li class="active"><strong><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></strong></li>
</ol>
     
 
<?php  if($alert=="image_error"||$editerror=="image_error"){ ?>
<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> Unable to upload the image, please check the file format and size.</div>
	</div>
</div>
  
<?php } ?>     
     
     

<h2><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="<?php echo $this->controller;?>_form" name="<?php echo $this->controller;?>_form" method="post" action="<?php echo $action;?>" enctype="multipart/form-data" class="validate" >
            <div class="form-group">
				<label class="control-label">Name :</label>
                
                  <input type="text" name="member_name" id="member_name" maxlength="255" value="<?php echo (isset($tbl_data['member_name'])) ? $tbl_data['member_name'] : '';?>" class="form-control" data-validate="required" placeholder="John Smith" />
			</div>
            <div class="form-group">
				<label class="control-label">Designation :</label>
                
                  <input type="text" name="member_designation" id="member_designation" maxlength="255" value="<?php echo (isset($tbl_data['member_designation'])) ? $tbl_data['member_designation'] : '';?>" class="form-control" data-validate="required" placeholder="Co-Founder / CEO" />
			</div>
             <div class="form-group">
				<label class="control-label">Quality :</label>
                
                  <input type="text" name="member_caption"  maxlength="255" value="<?php echo (isset($tbl_data['member_caption'])) ? $tbl_data['member_caption'] : '';?>" class="form-control" data-validate="required" placeholder="I am punctual" />
			</div>
           
          <div class="form-group">
				  <label class="control-label">Introduction :</label>
               
                  <textarea style="resize:none"  rows="4"  name="member_desc" id="member_desc" class="form-control" placeholder="" ><?php echo (isset($tbl_data['member_desc'])) ? $tbl_data['member_desc'] : '';?></textarea>
			</div> 
            
           <div class="form-group">
				<label class="control-label">Facebook :</label>
                
                  <input type="url" name="member_facebook" id="member_facebook" maxlength="255" value="<?php echo (isset($tbl_data['member_facebook'])) ? $tbl_data['member_facebook'] : '';?>" class="form-control"  placeholder="https://www.facebook.com/john-smith" />
			</div>
            
            <div class="form-group">
				<label class="control-label">Twitter :</label>
                
                  <input type="url" name="member_twitter" id="member_twitter" maxlength="255" value="<?php echo (isset($tbl_data['member_twitter'])) ? $tbl_data['member_twitter'] : '';?>" class="form-control" placeholder="https://www.twitter.com/john-smith" />
			</div>
            
            <div class="form-group">
				<label class="control-label">Google+ :</label>
                
                  <input type="url" name="member_google" id="member_google" maxlength="255" value="<?php echo (isset($tbl_data['member_google'])) ? $tbl_data['member_google'] : '';?>" class="form-control"  placeholder="https://plus.google.com/john-smith"  />
			</div>
            
            <div class="form-group">
				<label class="control-label">LinkedIn :</label>
                
                  <input type="url" name="member_linkedin" id="member_linkedin" maxlength="255" value="<?php echo (isset($tbl_data['member_linkedin'])) ? $tbl_data['member_linkedin'] : '';?>" class="form-control" placeholder="https://www.linkedin.com/john-smith" />
			</div>
           
           
            <hr />
            <div class="form-group ">
				 <label class="control-label">Picture :</label>
               
                  <input accept="image/x-png,image/png,image/pjpeg,image/jpeg" <?php echo (isset($tbl_data)&&$tbl_data['member_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['member_image'])) ? '' : 'required';?> type="file" name="uploadfile" id="uploadfile" />
                  
			</div>
			
			<div class="form-group ">
            
            <?php if($alert=="edit")
				{?>
				 <label class="control-label">
					<a class="fancybox" href="<?php echo ($tbl_data['member_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['member_image'])) ? FRONTEND_ASSETS.'images/'.$this->controller.'/'.$tbl_data['member_image'] : FRONTEND_ASSETS.'images/no_image.jpg';?>"><img width="100" src="<?php echo ($tbl_data['member_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['member_image'])) ? $this->imagethumb->image('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['member_image'],100,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a><br/>
				</label><br clear="all" /><?php }?><strong>Max Size:</strong> 50 Mb. <strong>Image Type:</strong> JPEG / PNG <strong>Width:</strong>450px <strong>Height:</strong>500px<br/>
			</div>
            <hr />
      	
			<div class="form-group">
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="member_status" id="member_status">
                    <option value="Enable" <?php echo (isset($tbl_data['member_status'])&&$tbl_data['member_status']=="Enable") ? ' selected="selected"' : ''; ?>>Enable</option>
                    <option value="Disable" <?php echo (isset($tbl_data['member_status'])&&$tbl_data['member_status']=="Disable") ? ' selected="selected"' : ''; ?>>Disable</option>
                  </select>
			</div>
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL.$this->controller;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
</div>
  
  </div>

