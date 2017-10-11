<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>

<li class="active"><strong>Website Settings</strong></li>
</ol>
     
     
     
<?php if($alert=="success") { ?>
<div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Website settings has been saved successfully.</div>
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
     
     

<h2>Website Settings</h2>
<br clear="all" />

<div class="row">
<div class="col-md-12">
			 <form  id="slider_form" name="slider_form" method="post" action="<?php echo base_url();?>manage/home/savewebsettings" enctype="multipart/form-data" class="validate" >
				<div class="panel minimal minimal-gray">
					
					<div class="panel-heading">
						<div class="panel-options">
							
							<ul class="nav nav-tabs">
								<li class="active"><a href="#web-info" data-toggle="tab">Website Info</a></li>
								<li><a href="#social-media" data-toggle="tab">Social Media</a></li>
                                <li><a href="#web-scripts" data-toggle="tab">Web Scripts</a></li>
                                <li><a href="#web-defaults" data-toggle="tab">Backgrounds</a></li>
                                <li class="hidden"><a href="#web-misc" data-toggle="tab">Miscellaneous</a></li>
							</ul>
						</div>
					</div>
					<div class="panel panel-primary">
					<div class="panel-body">
						
						<div class="tab-content">
                        
                        	<!-- Web Info-->
							<div class="tab-pane active" id="web-info">
										<div class="form-group">
                                            <label class="control-label">Website Name :</label>
                                           
                                              <input type="text" data-validate="required" name="website_title" id="website_title" value="<?php echo $web['website_title'];?>" class="form-control" placeholder="My Website" />
                                        </div>
                                        <div class="form-group hidden">
                                            <label class="control-label">Slogan :</label>
                                           
                                              <input type="text"  name="website_slogan" id="website_slogan" value="<?php echo $web['website_slogan'];?>" class="form-control" placeholder="" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Website URL :</label>
                                           
                                              <input type="text"  name="website_url" id="website_url" value="<?php echo $web['website_url'];?>" class="form-control" placeholder="www.mywebsite.com" />
                                        </div>
                                        <div class="form-group " >
                                             <label class="control-label">Website Under Construction :</label>
                                            
                                              <select autocomplete="off" class="form-control"  name="under_construction" id="under_construction">
                                                <option value="Yes" <?php echo (isset($web['under_construction'])&&$web['under_construction']=="Yes") ? ' selected="selected"' : ''; ?>>Yes</option>
                                                <option value="No" <?php echo (isset($web['under_construction'])&&$web['under_construction']=="No") ? ' selected="selected"' : ''; ?>>No</option>
                                              </select>
                                        </div>
                                        
                                            <hr />
            <div class="form-group">
				 <label class="control-label">Logo :</label>
               
                  <input type="file" name="uploadfile" id="uploadfile" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                 <br/> <strong>Image Type:</strong> JPEG / PNG<br/>
                  <br/>
                  <a href="<?php echo ($web['logo']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo'])) ? FRONTEND_ASSETS.'images/logo/'.$web['logo'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                  
                  <img width="240"  src="<?php echo ($web['logo']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo'])) ? $this->imagethumb->image('./assets/frontend/images/logo/'.$web['logo'],240,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
			</div>
            <hr />
            <div class="form-group">
				 <label class="control-label">Logo White :</label>
               
                  <input type="file" name="uploadfile6" id="uploadfile6" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                 <br/> <strong>Image Type:</strong> JPEG / PNG<br/>
                  <br/>
                  <a href="<?php echo ($web['logo']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo2'])) ? FRONTEND_ASSETS.'images/logo/'.$web['logo2'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                  
                  <img style="background:#CCC;padding:10px;" width="240"   src="<?php echo ($web['logo']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo'])) ? $this->imagethumb->image('./assets/frontend/images/logo/'.$web['logo2'],240,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
			</div>
            <div class="form-group hidden">
				 <label class="control-label">Footer Logo :</label>
               
                  <input type="file" name="uploadfile2" id="uploadfile2" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                 <br/> <strong>Image Type:</strong> JPEG / PNG<br/>
                  <br/>
                  <a href="<?php echo ($web['logo_sticky']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo_sticky'])) ? FRONTEND_ASSETS.'images/logo/'.$web['logo_sticky'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                  
                  <img width="180"  src="<?php echo ($web['logo_sticky']!="" && file_exists('./assets/frontend/images/logo/'.$web['logo_sticky'])) ? $this->imagethumb->image('./assets/frontend/images/logo/'.$web['logo_sticky'],180,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
			</div>
             <hr />
            <div class="form-group ">
				 <label class="control-label">Favicon :</label>
               
                  <input type="file" name="uploadfile3" id="uploadfile3" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                 <br/> <strong>Image Type:</strong> JPEG / PNG<br/>
                  <br/>
                  <a href="<?php echo ($web['logo_sticky']!="" && file_exists('./assets/frontend/images/logo/'.$web['favicon'])) ? FRONTEND_ASSETS.'images/logo/'.$web['favicon'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                  
                  <img width="80"  src="<?php echo ($web['favicon']!="" && file_exists('./assets/frontend/images/logo/'.$web['favicon'])) ? $this->imagethumb->image('./assets/frontend/images/logo/'.$web['favicon'],80,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
			</div>
            <hr />
            <div class="form-group hidden">
				<label class="control-label">PayPal Email :</label>
               
                  <input type="email"  name="paypal_email" id="paypal_email" value="<?php echo $web['paypal_email'];?>" class="form-control" placeholder="" />
			</div>
            <div class="form-group hidden">
				<label class="control-label">PayPal Mode :</label>
                <select autocomplete="off" class="form-control"  name="paypal_mode" id="paypal_mode">
                    <option value="Sandbox" <?php echo (isset($web['paypal_mode'])&&$web['paypal_mode']=="Sandbox") ? ' selected="selected"' : ''; ?>>Sandbox</option>
                    <option value="Live" <?php echo (isset($web['paypal_mode'])&&$web['paypal_mode']=="Live") ? ' selected="selected"' : ''; ?>>Live</option>
                  </select>
			</div>
            <div class="form-group hidden">
            
				 <label class="control-label">Header Phone :</label>
                
                  <input type="text"  name="head_phone" id="head_phone" value="<?php echo $web['head_phone'];?>" class="form-control" placeholder="Phone Number" />
			</div>
             
			
            
			<div class="form-group ">
				<label class="control-label">Google Analytics :</label>
                
                  <input type="text" name="analytics" id="analytics" class="form-control" placeholder="UA-XXXXX-X" value="<?php echo $web['analytics'];?>" />
			</div>
                                        <div class="form-group">
                                                
                                                <button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                
							</div>
							<!-- Web Info -->
						
                        
                        	<!-- Social Media-->
                            <div class="tab-pane " id="social-media">
										<div class="form-group ">
                                            <label class="control-label">Facebook :</label>
                                            
                                              <input type="url" name="facebook" id="facebook" class="form-control" placeholder="" value="<?php echo $web['facebook'];?>" data-validate="url"/>
                                        </div>
                                         <div class="form-group ">
                                            <label class="control-label">Twitter :</label>
                                            
                                              <input type="url" name="twitter" id="twitter" class="form-control" placeholder="" value="<?php echo $web['twitter'];?>" data-validate="url"/>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label">Google+ :</label>
                                            
                                              <input type="url" name="google" id="google" class="form-control" placeholder="" value="<?php echo $web['google'];?>" data-validate="url"/>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label class="control-label">Pinterest :</label>
                                            
                                              <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="" value="<?php echo $web['pinterest'];?>" data-validate="url"/>
                                        </div>
                                        
                                         <div class="form-group ">
                                            <label class="control-label">Instagram :</label>
                                            
                                              <input type="url" name="instagram" id="instagram" class="form-control" placeholder="" value="<?php echo $web['instagram'];?>" data-validate="url"/>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label">LinkedIn :</label>
                                            
                                              <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="" value="<?php echo $web['linkedin'];?>" data-validate="url"/>
                                        </div>
                                          <div class="form-group ">
                                            <label class="control-label">Youtube :</label>
                                            
                                              <input type="url" name="youtube" id="youtube" class="form-control" placeholder="" value="<?php echo $web['youtube'];?>" data-validate="url"/>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label">Flickr :</label>
                                            
                                              <input type="url" name="flickr" id="flickr" class="form-control" placeholder="" value="<?php echo $web['flickr'];?>" data-validate="url"/>
                                        </div>
                                         <div class="form-group ">
                                            <label class="control-label">Skype :</label>
                                            
                                              <input type="text" name="skype" id="skype" class="form-control" placeholder="" value="<?php echo $web['skype'];?>"/>
                                        </div>
                                                
                                        <div class="form-group">
                                                
                                                <button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                
							</div>
                            <!-- Social Media-->
                            
                            <!-- Scripts -->
                            
                            <div class="tab-pane" id="web-scripts">
										<div class="form-group ">
                                            <label class="control-label">&lt;head&gt; :</label>
                                            
                                              <textarea rows="15" name="head_scripts" id="head_scripts" class="form-control" placeholder=""><?php echo $web['head_scripts'];?></textarea>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label class="control-label">After &lt;body&gt; :</label>
                                            
                                              <textarea rows="15" name="body_scripts" id="body_scripts" class="form-control" placeholder="" ><?php echo $web['body_scripts'];?></textarea>
                                        </div>
                                        
                                         <div class="form-group ">
                                            <label class="control-label">Before &lt;/body&gt; :</label>
                                            
                                              <textarea rows="15" name="foot_scripts" id="foot_scripts" class="form-control" placeholder="" ><?php echo $web['foot_scripts'];?></textarea>
                                        </div>
                                                                                     
                                        <div class="form-group">
                                                
                                                <button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                
							</div>
                            <!-- Scripts -->
                            <!--Defaults-->
                           
                            <div class="tab-pane" id="web-defaults">
                           
                            <div class="form-group">
                                 <label class="control-label">Main Background :</label>
                               
                                  <input type="file" name="uploadfile4" id="uploadfile4" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                                 <br/> <strong>Image Type:</strong> JPEG / PNG  | <strong>Width: </strong>1250px | <strong>Height </strong>770px<br />
                                  <br/>
                                  <a href="<?php echo ($web['default_bg']!="" && file_exists('./assets/frontend/images/bg/'.$web['default_bg'])) ? FRONTEND_ASSETS.'images/bg/'.$web['default_bg'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                                  
                                  <img width="180"  src="<?php echo ($web['default_bg']!="" && file_exists('./assets/frontend/images/bg/'.$web['default_bg'])) ? $this->imagethumb->image('./assets/frontend/images/bg/'.$web['default_bg'],180,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                                  
                            </div><hr />
                            <div class="form-group hidden">
				<label class="control-label">Search Form Heading :</label>
                
                   <textarea name="page_head" id="page_head"  class="form-control" style="resize:none"/><?php echo (isset($web['page_head'])) ? $web['page_head'] : '';?></textarea>
			</div>
            
            <div class="form-group hidden">
                <label class="control-label">Search Form Heading Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="page_head_color" name="page_head_color" class="form-control colorpicker" data-format="hex" value="<?php echo (isset($web['page_head_color'])) ? $web['page_head_color'] : '#ffffff';?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
            
            <div class="form-group hidden" >
				<label class="control-label">Search Form Text :</label>
                
                  <textarea name="page_caption" id="page_caption"  class="form-control" style="resize:none"/><?php echo (isset($web['page_caption'])) ? $web['page_caption'] : '';?></textarea>
			</div>
            
             <div class="form-group hidden">
                <label class="control-label">Search Form Text Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="page_caption_color" name="page_caption_color" class="form-control colorpicker" data-format="hex" value="<?php echo (isset($web['page_caption_color'])) ? $web['page_caption_color'] : '#ffffff';?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
                            
                            <div class="form-group hidden">
                                 <label class="control-label">All Pages Default Background :</label>
                               
                                  <input type="file" name="uploadfile5" id="uploadfile5" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                                  <br/> <strong>Image Type:</strong> JPEG / PNG  | <strong>Width: </strong>1400px | <strong>Height </strong>450px<br />
                                  <br/>
                                 
                                 
                                  <a href="<?php echo ($web['default_bg2']!="" && file_exists('./assets/frontend/images/bg/'.$web['default_bg2'])) ? FRONTEND_ASSETS.'images/bg/'.$web['default_bg2'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox">
                                  
                                  <img width="180"  src="<?php echo ($web['default_bg2']!="" && file_exists('./assets/frontend/images/bg/'.$web['default_bg2'])) ? $this->imagethumb->image('./assets/frontend/images/bg/'.$web['default_bg2'],180,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                                  
                            </div>
                            			
                                        
                                       
                                                                                     
                                        <div class="form-group">
                                                
                                                <button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                
							</div>
                            
                            <!--Defaults-->
                          	<!-- Misc -->
                            <div class="tab-pane hidden" id="web-misc">
                            
                            			  <div class="form-group ">
                                            <label class="control-label">Footer Button 1 Text :</label>
                                            
                                              <input type="text" name="foot_btn1" id="foot_btn1" class="form-control" placeholder="" value="<?php echo $web['foot_btn1'];?>" />
                                        </div>
                                          <div class="form-group ">
                                            <label class="control-label">Footer Button 1 URL :</label>
                                            
                                              <input type="url" name="foot_btn1_url" id="foot_btn1_url" class="form-control" placeholder="" value="<?php echo $web['foot_btn1_url'];?>" data-validate="url"/>
                                        </div>
                                        
                                         <div class="form-group ">
                                            <label class="control-label">Footer Button 2 Text :</label>
                                            
                                              <input type="text" name="foot_btn2" id="foot_btn2" class="form-control" placeholder="" value="<?php echo $web['foot_btn2'];?>" />
                                        </div>
                                          <div class="form-group ">
                                            <label class="control-label">Footer Button 2 URL :</label>
                                            
                                              <input type="url" name="foot_btn2_url" id="foot_btn2_url" class="form-control" placeholder="" value="<?php echo $web['foot_btn2_url'];?>" data-validate="url"/>
                                        </div>
                            
                            
										<div class="form-group ">
                                            <label class="control-label">Footer Text :</label>
                                            
                                              <textarea rows="5" name="foot_text" id="foot_text" class="form-control" placeholder=""><?php echo $web['foot_text'];?></textarea>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label class="control-label">Copyright :</label>
                                            
                                              <textarea rows="2" name="foot_copy" id="foot_copy" class="form-control" placeholder=""><?php echo $web['foot_copy'];?></textarea>
                                        </div>
                                        
                                       
                                                                                     
                                        <div class="form-group">
                                                
                                                <button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>'">Cancel</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                
							</div>
                            <!-- Misc -->
                        	
						</div>
						</div>
					</div>
					
				</div>
				
                
                </form>
			</div>


</div>



