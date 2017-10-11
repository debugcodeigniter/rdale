<?php 
$crumb2 = "";

 if(isset($tbl_data['page_id'])&&$tbl_data['page_id']!=""){
	$page_name = $tbl_data['page_name'];
	$page_title = $tbl_data['page_title'];
	$page_uri = $tbl_data['page_uri'];
	$page_text = stripslashes($tbl_data['page_text']);
	$page_status = $tbl_data['page_status']; 
	$page_meta_key = stripslashes($tbl_data['page_meta_key']);
	$page_meta_desc = stripslashes($tbl_data['page_meta_desc']);
	$page_extra_tags = stripslashes($tbl_data['page_extra_tags']);
 	$pub_date = ($tbl_data['page_pdate']!="0000-00-00 00:00:00") ? date('d F Y',strtotime($tbl_data['page_pdate'])) : '';
	$pub_time = ($tbl_data['page_pdate']!="0000-00-00 00:00:00") ? date('H:i:s A',strtotime($tbl_data['page_pdate'])) : '';
	$unpub_date = ($tbl_data['page_update']!="0000-00-00 00:00:00") ? date('d F Y',strtotime($tbl_data['page_update'])) : '';
	$unpub_time = ($tbl_data['page_update']!="0000-00-00 00:00:00") ? date('H:i:s A',strtotime($tbl_data['page_update'])) : '';
 	$page_featured = $tbl_data['page_featured'];
	$page_caption = $tbl_data['page_caption'];
	$page_slider = $tbl_data['page_slider'];
	$menu_name = $tbl_data['menu_name'];
	$page_search = $tbl_data['page_search'];
	$on_home = $tbl_data['on_home'];
	$color = $tbl_data['color'];
	$on_side = $tbl_data['on_side'];
	$page_facebook = $tbl_data['page_facebook'];
	$page_news= $tbl_data['page_news'];
	$page_side_page= $tbl_data['page_side_page'];
	$page_testi= $tbl_data['page_testi'];
	$page_links= $tbl_data['page_links'];
	$page_head_color = $tbl_data['page_head_color'];
	$page_caption_color = $tbl_data['page_caption_color'];
	$page_head = $tbl_data['page_head'];
	
	
	$crumb = "Edit";
	$action = "editRecord/".$parent_id."/".$tbl_data['page_id']; 
 }
 else{
	$page_uri = "";
	$page_title = "";
	$page_name="";
	$page_text="";
	$page_status = "Published";
	$page_meta_key = "";
	$page_meta_desc = "";
	$page_extra_tags = "";
	$page_pdate = "";
	$pub_date = '';
	$pub_time = '';
	$unpub_date = '';
	$unpub_time = '';
	$page_featured = "No";
	$page_caption= "";
	$page_slider = "";
	$menu_name = "";
	$page_head = "";
	$page_search = "Yes";
	$on_home = "No";
	$crumb = "Add";
	$color = 'green';
	$on_side = "No";
	$page_facebook = "Yes";
	$page_news= "Yes";
	$page_side_page= "No";
	$page_testi= "No";
	$page_links= "Yes";
	$page_head_color = "#fffff";
	$page_caption_color = "#fffff";
	$action = "addRecord/".$parent_id; 
 }
 
 
 ?>
 

<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL;?>pages"><i></i>Web Pages</a></li><?php if($parent_id!="0"){ ?><li><a href="<?php echo ADMIN_URL.'pages/index/'.$parent_id;?>"><?php echo $parent_name;?></a></li><?php  }?><li class="active"><strong><?php echo $crumb;?> Web page</strong></li>
</ol>
     
     
     

     
     

<h2><?php echo $crumb;?> Web Page</h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
		 <form  id="page_form" name="page_form" method="post" action="<?php echo base_url();?>manage/pages/<?php echo $action;?>" enctype="multipart/form-data" class="validate">
			<div class="form-group">
				<label class="control-label">Page Name :</label>
                
                  <input type="text" name="page_name" id="page_name" value="<?php echo $page_name;?>" class="form-control " placeholder="About Us" data-validate="required,maxlength[250]"/>
			</div>
            
            <div class="form-group">
					<label class="control-label">Slug :</label><br clear="all" />
								<input type="text" name="page_uri" id="page_uri" value="<?php echo $page_uri;?>" class="form-control slug" placeholder="about-us" data-validate="required,maxlength[250]"/>
					</div>
                    <div class="form-group">
				<label class="control-label">Menu Name :</label>
                
                  <input type="text" name="menu_name" id="menu_name" value="<?php echo $menu_name;?>" class="form-control " placeholder="About Us" maxlength="50" data-validate="required,maxlength[50]"/>
			</div>
                    <div class="form-group hidden" >
				 <label class="control-label">Image Slider :</label>
                
                  <select class="form-control select2"  name="page_slider" id="page_slider">
                    <option value="">Select Image Slider</option>
                    <?php
					if(!empty($sliders))
					{
						foreach($sliders as $s)
						{
							echo '<option value="'.$s['sliders_id'].'" ';
							if($s['sliders_id']==$page_slider)
							{
								echo 'selected="selected" ';	
							}
							echo '>'.$s['sliders_title'].'</option>';
						}
					}?>
                  </select>
			</div>
                    
            
            
            
            <div class="form-group <?php echo (isset($tbl_data['page_id']) && ($tbl_data['page_id']<=10)) ? 'hidden' : '';?>">
				<label class="control-label">Heading :</label>
                
                   <textarea name="page_head" id="page_head"  class="form-control" style="resize:none"/><?php echo $page_head;?></textarea>
			</div>
            
            <div class="form-group <?php echo (isset($tbl_data['page_id']) && ($tbl_data['page_id']<=10)) ? 'hidden' : '';?>">
                <label class="control-label">Heading Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="page_head_color" name="page_head_color" class="form-control colorpicker" data-format="hex" value="<?php echo $page_head_color;?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>
            
            <div class="form-group hidden" >
				<label class="control-label">Caption :</label>
                
                  <textarea name="page_caption" id="page_caption"  class="form-control" style="resize:none"/><?php echo $page_caption;?></textarea>
			</div>
            
             <div class="form-group hidden">
                <label class="control-label">Caption Color :</label>
                
                
                    <div class="input-group">
                        <input autocomplete="off" type="text" id="page_caption_color" name="page_caption_color" class="form-control colorpicker" data-format="hex" value="<?php echo $page_caption_color;?>" />
                        
                        <div class="input-group-addon">
                            <i class="color-preview"></i>
                        </div>
                    </div>
                
            </div>                    <div class="form-group hidden" >
				 <label class="control-label">Background Image :</label>
               
                  <input type="file" name="uploadfile" id="uploadfile" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                  
			</div>
			
			<div class="form-group hidden" >
				 <label <?php echo (isset($tbl_data['page_thumb_image'])) ? 'id="image'.$tbl_data['page_id'].'"' : '';?> style="display:block;"><?php if(isset($tbl_data['page_thumb_image'])&&$tbl_data['page_thumb_image']!=""&&file_exists('./assets/frontend/images/pages/'.$tbl_data['page_thumb_image']))
				{
					
					echo '<a class="fancybox" href="'.FRONTEND_ASSETS.'images/pages/'.$tbl_data['page_image'].'"><img width="200" src="'.FRONTEND_ASSETS.'images/pages/'.$tbl_data['page_thumb_image'].'"></a>';	
					echo '<br/><br/><button class="btn btn-primary btn-xs removeImage" data-controller="pages" id="img'.$tbl_data['page_id'].'" type="button">Remove Image</button><br/>';
				}?></label><strong>Max Size:</strong> 50 Mb | <strong>Image Type:</strong> JPEG / PNG  | <strong>Width: </strong>1000px | <strong>Height: </strong>470px
                <!-- <strong>Width:</strong> 1270p80x  <strong>Height:</strong> 166px -->
			</div>
            <hr />
              <div class="form-group hidden" >
				 <label class="control-label">Thumbnail Image :</label>
               
                  <input type="file" name="uploadfile2" id="uploadfile2" accept="image/x-png,image/png,image/pjpeg,image/jpeg"/>
                  
			</div>
			
			<div class="form-group hidden" >
				 <label <?php echo (isset($tbl_data['page_image2'])) ? 'id="iimage'.$tbl_data['page_id'].'"' : '';?> style="display:block;"><?php if(isset($tbl_data['page_image2'])&&$tbl_data['page_image2']!=""&&file_exists('./assets/frontend/images/pages/'.$tbl_data['page_image2']))
				{
					
					echo '<a class="fancybox" href="'.FRONTEND_ASSETS.'images/pages/'.$tbl_data['page_image2'].'"><img width="200" src="'.$this->imagethumb->image('./assets/frontend/images/pages/'.$tbl_data['page_image2'],200,0).'"></a>';	
					echo '<br/><br/><button class="btn btn-primary btn-xs removeImage2" data-controller="pages" id="img'.$tbl_data['page_id'].'" type="button">Remove Image</button><br/>';
				}?></label><strong>Max Size:</strong> 10 Mb | <strong>Image Type:</strong> JPEG / PNG  <!--| <strong>Width: </strong>400px | <strong>Height </strong>225px-->
                <!-- <strong>Width:</strong> 1270p80x  <strong>Height:</strong> 166px -->
			</div>
            
            
            <div class="form-group <?php echo (isset($tbl_data['page_id']) && ($tbl_data['page_id']<=10)) ? 'hidden' : '';?>" >
				<?php echo $this->ckeditor->editor("page_text",$page_text);?>
			</div>
            
            
            
            <div class="form-group hidden" >
				 <label class="control-label">Show on Home Page :</label>
                
                  <select autocomplete="off" class="form-control"  name="on_home" id="on_home">
                    <option value="Yes" <?php if($on_home=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($on_home=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
             <div class="form-group hidden" >
				 <label class="control-label">Show on Sidebar :</label>
                
                  <select autocomplete="off" class="form-control"  name="on_side" id="on_side">
                    <option value="Yes" <?php if($on_side=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($on_side=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
            <div class="form-group hidden" >
				 <label class="control-label">Facebook Widget :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_facebook" id="page_facebook">
                    <option value="Yes" <?php if($page_facebook=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_facebook=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
             <div class="form-group hidden" >
				 <label class="control-label">News Widget :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_news" id="page_news">
                    <option value="Yes" <?php if($page_news=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_news=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
             <div class="form-group hidden" >
				 <label class="control-label">Support Section :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_side_page" id="page_side_page">
                    <option value="Yes" <?php if($page_side_page=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_side_page=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
            <div class="form-group hidden" >
				 <label class="control-label">Testimonial Widget :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_testi" id="page_testi">
                    <option value="Yes" <?php if($page_testi=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_testi=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
             <div class="form-group hidden" >
				 <label class="control-label">Links Widget :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_links" id="page_links">
                    <option value="Yes" <?php if($page_links=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_links=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
            
            
            <div class="form-group <?php if($on_side=="No"){ echo ' hidden';} ?> hidden" id="colorBox">
				 <label class="control-label">Color :</label>
                
                  <select autocomplete="off" class="form-control"  name="color" id="color">
                    <option value="yellow" <?php if($color=="yellow"){ echo ' selected="selected"';} ?>>Yellow</option>
                    <option value="red" <?php if($color=="red"){ echo ' selected="selected"';} ?>>Orange</option>
                    <option value="blue" <?php if($color=="blue"){ echo ' selected="selected"';} ?>>Blue</option>
                    <option value="green" <?php if($color=="green"){ echo ' selected="selected"';} ?>>Green</option>
                  </select>
			</div>
            <div class="form-group hidden">
				 <label class="control-label">Show Search Form :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_search" id="page_search">
                    <option value="Yes" <?php if($page_search=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    <option value="No" <?php if($page_search=="No"){ echo ' selected="selected"';} ?>>No</option>
                  </select>
			</div>
            <div class="form-group <?php echo (isset($tbl_data['page_id']) && ($tbl_data['page_id']<=10)) ? 'hidden' : '';?>">
				 <label class="control-label">Show on Investor Login :</label>
                
                  <select class="form-control"  name="page_featured" id="page_featured">
                  <option value="No" <?php if($page_featured=="No"){ echo ' selected="selected"';} ?>>No</option>
                    <option value="Yes" <?php if($page_featured=="Yes"){ echo ' selected="selected"';} ?>>Yes</option>
                    
                  </select>
			</div>
            <div class="form-group <?php echo (isset($tbl_data['page_id']) && ($tbl_data['page_id']<=10)) ? 'hidden' : '';?>">
				 <label class="control-label">Status :</label>
                
                  <select autocomplete="off" class="form-control"  name="page_status" id="page_status">
                    <option value="Published" <?php if($page_status=="Published"){ echo ' selected="selected"';} ?>>Published</option>
                    <option value="Un-Published" <?php if($page_status=="Un-Published"){ echo ' selected="selected"';} ?>>Un-Published</option>
                  </select>
			</div>
            <div class="form-group hidden">
					
						
						<div class="col-sm-4" style="padding-left:0px;">
								<label class="control-label">Pusblish On :</label>
							<div class="date-and-time">
								<input  name="pub_date" id="pub_date" type="text" autocomplete="off" class="form-control datepicker" value="<?php echo $pub_date;?>" data-format="dd MM yyyy">
								<input id="pub_time" name="pub_time"  type="text" autocomplete="off" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo $pub_time;?>" data-show-meridian="true" data-minute-step="1" data-second-step="1" />
							</div>
						</div>
					</div>
            
             <!--<br clear="all" /><br clear="all" />-->
             <div class="form-group hidden">
					
						
						<div class="col-sm-4" style="padding-left:0px;">
								<label class="control-label">Un-Pusblish On :</label>
							<div class="date-and-time">
								<input  name="unpub_date" id="unpub_date" type="text" autocomplete="off" class="form-control datepicker" value="<?php echo $unpub_date;?>" data-format="dd MM yyyy">
								<input id="unpub_time" name="unpub_time"  type="text" autocomplete="off" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo $unpub_time;?>" data-show-meridian="true" data-minute-step="1" data-second-step="1" />
							</div>
						</div>
					</div>
            <div class="form-group">
				<label class="control-label">Page Title :</label>
                
                  <input type="text" name="page_title" id="page_title" value="<?php echo $page_title;?>" class="form-control " placeholder="" data-validate="required,maxlength[250]"/>
			</div>
             <!--<br clear="all" /><br clear="all" />-->
            <div class="form-group">
				<label class="control-label">Meta Keywords :</label>
                
                  <textarea style="resize:none" name="page_meta_key" id="page_meta_key"  class="form-control" placeholder="" /><?php echo $page_meta_key;?></textarea>
			</div>
            <div class="form-group">
				<label class="control-label">Meta Description :</label>
                
                  <textarea style="resize:none" name="page_meta_desc" id="page_meta_desc"  class="form-control" placeholder="" /><?php echo $page_meta_desc;?></textarea>
			</div>
            <div class="form-group hidden">
				<label class="control-label">Extra SEO Tags :</label>
                
                  <textarea style="resize:none" name="page_extra_tags" id="page_extra_tags"  class="form-control" placeholder="" /><?php echo $page_extra_tags;?></textarea>
			</div>
            
           
			
			
			<div class="form-group">
				
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>pages'">Cancel</button>
                <button type="submit"  class="btn btn-success">Submit</button>
			</div>
		
		</form>
	
  
	
</div>
  
  </div>


<script type="text/javascript">
$(function(){
	$("#on_side").on('change',function(){
		if(this.value=="Yes")
		{
			$("#colorBox").removeClass("hidden");	
		}
		else{
			$("#colorBox").addClass("hidden");
			
		}
	});	
});

</script>