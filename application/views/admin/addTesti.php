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
			<div class="row">
            <div class="form-group col-sm-8">
				<label class="control-label">Bride & Groom Name :</label>
                
                  <input type="text" name="testi_name" id="testi_name" maxlength="100" value="<?php echo (isset($tbl_data['testi_name'])) ? $tbl_data['testi_name'] : '';?>" class="form-control" data-validate="required" placeholder="Trina & Cornell" />
			</div>
            <div class="form-group col-sm-4">
                <label class="control-label">Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="testi_name_color" name="testi_name_color" class="form-control colorpicker" data-format="hex" value="<?php echo (isset($tbl_data['testi_name_color'])) ? $tbl_data['testi_name_color'] : '#ffffff';?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
            </div>
           
          <div class="form-group ">
				  <label class="control-label">Testimonial Text:</label>
               
                  <textarea style="resize:none" data-validate="required" rows="6"  name="testi_desc" id="testi_desc" class="form-control" placeholder="" ><?php echo (isset($tbl_data['testi_desc'])) ? $tbl_data['testi_desc'] : '';?></textarea>
			</div> 
           <div class="form-group">
                <label class="control-label">Text Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="testi_desc_color" name="testi_desc_color" class="form-control colorpicker" data-format="hex" value="<?php echo (isset($tbl_data['testi_desc_color'])) ? $tbl_data['testi_desc_color'] : '#ffffff';?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
              <script type="text/javascript">
	$(function(){
		$('#testi_rating').barrating({
            theme: 'bootstrap-stars',
            showSelectedRating: false
        });	
	});
	
	</script>
            <div class="form-group">
				 <label class="control-label">Rating :</label>
                
                  <select class="form-control"  name="testi_rating" id="testi_rating">
                   <?php 
				   for($i=1;$i<=5;$i++)
				   {
                    echo '<option value="'.$i.'" '.((isset($tbl_data['testi_rating'])&&$tbl_data['testi_rating']==(string)$i) ? ' selected="selected"' : '').'>'.$i.'</option>';
				   }
				   ?>
                   
                  </select>
			</div>
            <div class="form-group">
                <label class="control-label">Rating Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="testi_rating_color" name="testi_rating_color" class="form-control colorpicker" data-format="hex" value="<?php echo (isset($tbl_data['testi_rating_color'])) ? $tbl_data['testi_rating_color'] : '#ffffff';?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
            <hr />
            <div class="form-group ">
				 <label class="control-label">Picture :</label>
               
                  <input accept="image/x-png,image/png,image/pjpeg,image/jpeg" <?php echo (isset($tbl_data)&&$tbl_data['testi_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['testi_image'])) ? '' : 'required';?> type="file" name="uploadfile" id="uploadfile" />
                  
			</div>
			
			<div class="form-group ">
            
            <?php if($alert=="edit")
				{?>
				 <label class="control-label">
					<a class="fancybox" href="<?php echo ($tbl_data['testi_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['testi_image'])) ? FRONTEND_ASSETS.'images/'.$this->controller.'/'.$tbl_data['testi_image'] : FRONTEND_ASSETS.'images/no_image.jpg';?>"><img width="100" src="<?php echo ($tbl_data['testi_image']!="" && file_exists('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['testi_image'])) ? $this->imagethumb->image('./assets/frontend/images/'.$this->controller.'/'.$tbl_data['testi_image'],100,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a><br/>
				</label><br clear="all" /><?php }?><strong>Max Size:</strong> 50 Mb. <strong>Image Type:</strong> JPEG / PNG<br/>
			</div>
            <hr />
      	
			<div class="form-group">
				 <label class="control-label">Status :</label>
                
                  <select class="form-control"  name="testi_status" id="testi_status">
                    <option value="Enable" <?php echo (isset($tbl_data['testi_status'])&&$tbl_data['testi_status']=="Enable") ? ' selected="selected"' : ''; ?>>Enable</option>
                    <option value="Disable" <?php echo (isset($tbl_data['testi_status'])&&$tbl_data['testi_status']=="Disable") ? ' selected="selected"' : ''; ?>>Disable</option>
                  </select>
			</div>
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL.$this->controller;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
</div>
  
  </div>

