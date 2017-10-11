<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL;?>sliders">Image Sliders</a></li>
<li class="active"><strong><?php echo $slider_name;?> Slider Images</strong></li>
</ol>

 <?php if($alert=="success") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Slider image added sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="deletesuccess") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Slider image deleted sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="deleteerror") { ?>
  <div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> Error occurred while deleting the record, please try again.</div>
	</div>
</div>
   <?php } if($alert=="editsuccess") { ?>
   <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Slider image updated sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="error") { ?>
  <div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Error!!</strong> Error occurred while saving the record, please try again.</div>
	</div>
</div>
  <?php } ?>                    


<h2><?php echo $slider_name;?> Slider Images</h2>
<hr />



<div class="row" style="min-height:400px;">
	<div class="col-md-12">
		<button  id="deleteAllRecords" class="btn btn-default btn-icon icon-left" type="button">
            Delete Selected
            <i class="entypo-trash"></i>
        </button> 
        
        <button  class="btn btn-default btn-icon icon-left" type="button" onclick="javascript:window.location='<?php echo base_url();?>manage/slider/control/<?php echo $slider_cat;?>'">
            Add Slider Image
            <i class="entypo-plus-circled"></i>
        </button>
        
        <button  class="btn btn-default btn-icon icon-left" type="button" onclick="javascript:window.location='<?php echo base_url();?>manage/slider/uploadimages/<?php echo $slider_cat;?>'">
            Add Multiple Images
            <i class="entypo-plus-circled"></i>
        </button>
		<hr />
		<form action="<?php echo ADMIN_URL;?>slider/deleteall" method="post" name="multiDel" id="multiDel">
		<table id="table-slider" class="table table-hover table-striped">
			<thead>
				<tr>
					<th><input type="checkbox" id="all-checkbox" name="all-checkbox" autocomplete="off"></th>
                    <th>ID</a></th>
					<th class="hideCol">Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th class="hideCol">Added On</th>
                    <th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
            <?php
			  if(count($slider)>0)
			  {
				foreach($slider as $c)
				{
					?>
              <tr id="slider-<?php echo $c['slider_id'];?>">
                  <td><input name="records[]" autocomplete="off" class="cselect" value="<?php echo $c['slider_id'];?>" type="checkbox" /></td>
                 <td><?php echo $c['slider_id'];?></td>
                  
                  <td class="hideCol">
                  <a href="<?php echo ($c['slider_large']!=""&&file_exists('./assets/frontend/images/slider/'.$c['slider_large'])) ? FRONTEND_ASSETS.'images/slider/'.$c['slider_large'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox" data-fancybox-group="gallery">
                  <img width="150" src="<?php echo ($c['slider_thumb']!=""&&file_exists('./assets/frontend/images/slider/'.$c['slider_thumb'])) ? FRONTEND_ASSETS.'images/slider/'.$c['slider_thumb'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
                  </td>
                  <td><a  href="<?php echo base_url();?>manage/slider/control/<?php echo $slider_cat;?>/edit/<?php echo $c['slider_id'];?>"><?php echo $c['slider_title'];?></a></td>
                 <td><a class="changestatus" href="javascript:void(0);" data-controller="<?php echo $this->controller;?>" id="statusID<?php echo $c[$this->pKey];?>"><?php echo $c[$this->tStatus];?></a></td>
                  <td class="hideCol"><?php echo date('M d, Y h:i a', strtotime($c['slider_date']));?></td>
                  <td>
                   <a id="copyID<?php echo $c[$this->pKey];?>" data-rec-name="<?php echo htmlspecialchars($c[$this->colPrefix.'title']);?>" data-controller="<?php echo $this->controller;?>" href="javascript:void(0);" title="Duplicate Property" class="icon-left font16 dupitem">
					<i class="fa fa-copy"></i></a>
                  
                 	<a class="icon-left font16" href="<?php echo base_url();?>manage/slider/control/<?php echo $slider_cat;?>/edit/<?php echo $c['slider_id'];?>">
					<i class="entypo-pencil"></i></a>
				
					<a class="icon-left font16 delitem" href="javascript:void(0);" data-controller="slider" id="recordID<?php echo $c['slider_id'];?>">
					<i class="entypo-cancel"></i></a>
                    
                  </td>
                </tr>      
                    
			 <?php		
				}
			  }
			  else{ ?>
				<tr><td colspan="7">Sorry! No Records.</td></tr>
              <?php  
			  }
			  ?>
				
			</tbody>
		</table>
        </form>
        <?php 
 $total_pages = ceil($total_rows/$per_page); 
 $current_page = ceil($page_numb/$per_page)+1;
 if($total_pages=="1")
 {
	$showing_from = 1;
	$showing_to = $total_rows;
 }
 else if($total_pages==$current_page)
 {
	$showing_from = ($per_page*($current_page-1))+1;
	$showing_to = $total_rows; 
 }
 else{
	$showing_from = ($per_page*($current_page-1))+1;
	$showing_to = $per_page*$current_page;
 }
 if($total_rows>0)
 {
?>
Showing <?php echo $showing_from;?> to <?php echo $showing_to;?> of <?php echo $total_rows;?> (<?php echo $total_pages;?> Pages) <?php } echo $paginate;?> 
		
	</div>
	
	
</div>

<script type="text/javascript">
var req = null;
$(function(){
	$('#table-slider').tableDnD({
            onDrop: function(table, row) {
				if(req!=null) req.abort();
				req = $.post('<?php echo ADMIN_URL?>slider/sliderorder',$.tableDnD.serialize(),function(d){
					
				});
	        }
    });

});

</script>



