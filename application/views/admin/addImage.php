<?php 

 $action = base_url('manage/'.$this->controller).'/';
 if(isset($tbl_data)&&count($tbl_data)>0)
 {
	$crumb = "Edit";
	$action.= "editRecord/".$cat_id.'/'.$tbl_data[$this->pKey]; 
	
 }
 else{
	$crumb = "Add";
	$action.= "addRecord/".$cat_id; 
 }
 ?>

<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.'portfolio';?>">Rooms</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller.'/index/'.$cat_id;?>"><i></i><?php echo $catData['cat_name'].' '.$this->moduleName;?></a></li>
<li class="active"><strong><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></strong></li>
</ol>
     
 

     
     

<h2><?php echo $crumb;?> <?php echo rtrim($this->moduleName,'s');?></h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="<?php echo $this->controller;?>_form" name="<?php echo $this->controller;?>_form" method="post" action="<?php echo $action;?>" enctype="multipart/form-data" class="validate" >
			<div class="form-group">
				<label class="control-label">Name :</label>
                
                  <input type="text" name="image_name" id="image_name" maxlength="100" value="<?php echo (isset($tbl_data['image_name'])) ? $tbl_data['image_name'] : '';?>" class="form-control" data-validate="required" placeholder="" />
			</div>
           
          <div class="form-group hidden">
				  <label  class="control-label">Description :</label>
               
                  <textarea rows="3" style="resize:none"  name="image_desc" id="image_desc" class="form-control" placeholder="" ><?php echo (isset($tbl_data['image_desc'])) ? $tbl_data['image_desc'] : '';?></textarea>
			</div> 
            <div class="form-group">
				 <label class="control-label">Select Image :</label>
               
                  <input accept="image/x-png,image/png,image/pjpeg,image/jpeg" <?php echo (isset($tbl_data) && $tbl_data['image_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['image_image'])) ? '' : 'class="required"';?> type="file" name="uploadfile" id="uploadfile" />
                  
			</div>
			
			<div class="form-group">
            
            
				 <label class="control-label"><?php if(isset($tbl_data))
				{?>
					<a class="fancybox" href="<?php echo ($tbl_data['image_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['image_image'])) ? FRONTEND_ASSETS.'images/'.$this->controller.'/'.$tbl_data['image_image'] : FRONTEND_ASSETS.'images/no_image.jpg';?>"><img width="100" src="<?php echo ($tbl_data['image_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['image_image'])) ? $this->imagethumb->image('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['image_image'],100,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a><br/><br/>
				<?php }?></label><br/><strong>Max Size:</strong> 50 Mb. <strong>Image Type:</strong> JPEG / PNG <br/> 
			</div>
            
            
            
      	
			<div class="form-group">
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="image_status" id="image_status">
                    <option value="Enable" <?php echo (isset($tbl_data['image_status'])&&$tbl_data['image_status']=="Enable") ? ' selected="selected"' : ''; ?>>Enable</option>
                    <option value="Disable" <?php echo (isset($tbl_data['image_status'])&&$tbl_data['image_status']=="Disable") ? ' selected="selected"' : ''; ?>>Disable</option>
                  </select>
			</div>
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL.$this->controller.'/index/'.$cat_id;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
</div>
  
  </div>

