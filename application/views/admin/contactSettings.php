<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li class="active"><strong>Contact Settings</strong></li>
</ol>
     
<?php if($alert=="success") { ?>
<div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Contact settings has been saved successfully.</div>
	</div>
</div>
<?php } if($alert=="error") { ?>
<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong>  Error occurred while saving the record, please try again.</div>
	</div>
</div>
<?php }?>     
     
     

<h2>Contacts</h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="slider_form" name="slider_form" method="post" action="<?php echo base_url();?>manage/home/savecontacts" enctype="multipart/form-data" class="validate" >
			
            
            <div class="form-group">
				 <label class="control-label">Sender Name :</label>
                
                  <input type="text" data-validate="required" name="sender_name" id="sender_name" value="<?php echo $web['sender_name'];?>" class="form-control" placeholder="Sender Name" />
			</div>
            <div class="form-group">
				 <label class="control-label">Sender Email :</label>
                
                  <input type="email" data-validate="required" name="sender_email" id="sender_email" value="<?php echo $web['sender_email'];?>" class="form-control" placeholder="Sender Email" />
			</div>
           
            <div class="form-group">
				 <label class="control-label">Contact Form Thank You Message :</label>
                
                  <textarea style="resize:none" name="contact_text" id="contact_text" class="form-control required"  ><?php echo $web['contact_text'];?></textarea>
			</div>
            
           
            
          
            <div class="form-group">
				 <label class="control-label">Contact Form Email :</label>
                
                  <input type="text" data-validate="required" name="contact_form_email" id="contact_form_email" value="<?php echo $web['contact_form_email'];?>" class="form-control" placeholder="Enter Comma Separated Email Address" />
			</div>
			<div class="form-group ">
            
				 <label class="control-label">Contact Email :</label>
                
                  <input type="email" data-validate="required,email" name="email" id="email" value="<?php echo $web['email'];?>" class="form-control" placeholder="Email Address" />
			</div>
            <div class="form-group ">
				  <label class="control-label">Phone :</label>
				<input type="text"  name="phone" id="phone" value="<?php echo $web['phone'];?>"  class="form-control" placeholder="Phone" />

			</div>
            
             <div class="form-group ">
				 <label class="control-label">Office Image :</label>
               
                  <input type="file" name="uploadfile" id="uploadfile" />
                 <br/> <strong>Image Type:</strong> JPEG / PNG <br/>
                  <br/>
			
            <a href="<?php echo ($web['map_image']!="" && file_exists('./assets/frontend/images/map/'.$web['map_image'])) ? FRONTEND_ASSETS.'images/map/'.$web['map_image'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                  
                  <img width="240"  src="<?php echo ($web['logo']!="" && file_exists('./assets/frontend/images/map/'.$web['map_image'])) ? $this->imagethumb->image('./assets/frontend/images/map/'.$web['map_image'],240,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
            
            </div>
            <div class="form-group">
				 <label class="control-label">Office Location :</label>
               
                  <input type="text"  name="lat_long" id="lat_long" value="<?php echo $web['lat_long'];?>" class="form-control" placeholder="San Francisco Office" />
			</div>
            
             <div class="form-group ">
				<label class="control-label">Address :</label>
                
                  <textarea style="resize:none" name="address" id="address"  class="form-control" placeholder="Address" ><?php echo $web['address'];?></textarea>
			</div>
            
			
           
			<div class="form-group hidden">
				<label class="control-label">Fax :</label>
                                 <input type="text"  name="fax" id="fax" value="<?php echo $web['fax'];?>" class="form-control" placeholder="Fax" />

			</div>
            
           
             <div class="form-group ">
				<label  class="control-label">Google Map :</label>
                
                  <textarea style="resize:none" rows="5"  name="map_iframe" id="map_iframe" class="form-control" placeholder="" ><?php echo $web['map_iframe'];?></textarea>
			</div>
          
            
             
            
            
            
            
            
		<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	
  </div>
  
  </div>

