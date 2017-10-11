<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.'portfolio';?>">Rooms</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller.'/index/'.$cat_id;?>"><i></i><?php echo $catData['cat_name'].' '.$this->moduleName;?></a></li>
<li class="active"><strong>Upload <?php echo $this->moduleName;?></strong></li>
</ol>
     
     
      
     
     

<h2>Upload <?php echo $this->moduleName;?></h2>
<br />


<div class="panel panel-primary">
<form id="upload" method="post" action="<?php echo ADMIN_URL.$this->controller.'/do_upload';?>" enctype="multipart/form-data">
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
		 <form  id="<?php echo $this->controller;?>_form" class="form-horizontal form-groups-bordered validate" name="<?php echo $this->controller;?>_form" method="post" action="<?php echo ADMIN_URL.$this->controller.'/saveimages/'.$cat_id;?>" enctype="multipart/form-data" >
			<input type="hidden" autocomplete="off" name="totalImages" id="totalImages" value="0" />
            
			
			
			<br clear="all" />
			
			
			
			
			
			
			
			<div class="form-group">
				<div class="col-sm-5">
				<button type="button" class="btn btn-danger" onclick="window.location='<?php echo ADMIN_URL.$this->controller.'/index/'.$cat_id;?>'">Cancel</button>
                <button type="submit"   class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
	
  </div>
  
  </div>

	


