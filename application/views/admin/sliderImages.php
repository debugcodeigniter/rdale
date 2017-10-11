<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL;?>sliders">Image Sliders</a></li>
<li><a href="<?php echo ADMIN_URL;?>slider/index/page/<?php echo $slider_cat;?>"><?php echo $slider_name;?> Slider Images</a></li>
<li class="active"><strong>Upload Images</strong></li>
</ol>
     
     
      
     
     

<h2>Upload Images</h2>
<br />


<div class="panel panel-primary">
<form id="upload" method="post" action="<?php echo ADMIN_URL;?>slider/do_upload" enctype="multipart/form-data">
			<div id="drop">
				Drop Here (Only JPG/JPEG/PNG)

				<a>Browse</a>
				<input type="file" name="upl" multiple accept="image/*"/>
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

		</form>
	
	
	<div class="panel-body">
		 <form  id="mslider_form" class="form-horizontal form-groups-bordered validate" name="mslider_form" method="post" action="<?php echo base_url();?>manage/slider/saveimages/<?php echo $slider_cat;?>" enctype="multipart/form-data" >
			<input type="hidden" autocomplete="off" name="totalImages" id="totalImages" value="0" />
            
			
			
			<br clear="all" />
			
			
			
			
			
			
			
			<div class="form-group">
				<div class="col-sm-5">
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL;?>slider/index/page/<?php echo $slider_cat;?>'">Cancel</button>
                <button type="submit"   class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
	
  </div>
  
  </div>

	


