<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li class="active"><strong>Image Sliders</strong></li>
</ol>

 <?php if($alert=="success") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Slider added sucessfully.</div>
	</div>
</div>
<?php } if($alert=="copysuccess") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Record has been duplicated sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="deletesuccess") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Slider deleted sucessfully.</div>
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
		<div class="alert alert-success"><strong>Success!</strong> Slider updated sucessfully.</div>
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


<h2>Image Sliders</h2>
<hr />



<div class="row" style="min-height:400px;">
	<div class="col-md-12">
		<button  id="deleteAllRecords" class="btn btn-default btn-icon icon-left" type="button">
            Delete Selected
            <i class="entypo-trash"></i>
        </button> 
        
        <button  class="btn btn-default btn-icon icon-left" type="button" onclick="javascript:window.location='<?php echo base_url();?>manage/sliders/control'">
            Add Slider
            <i class="entypo-plus-circled"></i>
        </button>
        
        <span class="selectPerPage pull-right"><br/>Records Per Page: <select class="noselect input-small" name="per_page" id="per_page">
            <option value="0" <?php echo ((int)$this->per_page===0) ? ' selected="selected" ' : '';?>>All</option>
            <?php
			for($i=10;$i<=100;$i+=10)
			{
				echo '<option value="'.$i.'"';
				echo ((int)$this->per_page===$i) ? ' selected="selected" ' : '';
				echo '>'.$i.'</option>';
			}
			?>
            </select></span>
		<br clear="all" />
        <hr />
      
           <form class="form-inline pull-right">
                  <input class="input-medium" type="text" value="<?php echo ($keywords!="-") ? $keywords : "" ;?>"  name="search_keywords" id="search_keywords" placeholder="Search keywords" class=" span11 aplha">
                  
                  <select autocomplete="off"  class=" noselect input-medium" name="search_status" id="search_status">
                  <option value="-">Select Status</option>
                  <option value="Enable" <?php if(isset($status)&&$status=="Enable"){ echo ' selected="selected" ';} ?>>Enable</option>
                  <option value="Disable" <?php if(isset($status)&&$status=="Disable"){ echo ' selected="selected" ';} ?>>Disable</option>
                  </select>
             </form> 
         
        
        <strong>Note:</strong> Click on slider title or <i style="color:#000" class="entypo-camera font16"></i> to view/add images.
        <hr />
		<form action="<?php echo ADMIN_URL;?>sliders/deleteall" method="post" name="multiDel" id="multiDel">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th><input type="checkbox" id="all-checkbox" name="all-checkbox" autocomplete="off"></th>
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->pKey.'/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">ID</a></th>
					
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/sliders_title/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Title</a></th>
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/sliders_status/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Status</a></th>
                    <th class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/sliders_date/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Added On</a></th>
                    <th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
            <?php
			  if(count($sliders)>0)
			  {
				foreach($sliders as $c)
				{
					?>
              <tr>
                  <td><input name="records[]" autocomplete="off" class="cselect" value="<?php echo $c['sliders_id'];?>" type="checkbox" /></td>
                 <td><?php echo $c['sliders_id'];?></td>
                  
                  <td><a href="<?php echo base_url('manage/slider/index/page/'.$c['sliders_id']);?>"><?php echo $c['sliders_title'];?></a></td>
                  <td><a class="changestatus" href="javascript:void(0);" data-controller="<?php echo $this->controller;?>" id="statusID<?php echo $c[$this->pKey];?>"><?php echo $c[$this->tStatus];?></a></td>
                  <td class="hideCol"><?php echo date('M d, Y h:i a', strtotime($c['sliders_date']));?></td>
                  <td>
                 
                  <a class="icon-left font16 inoti" href="<?php echo base_url('manage/slider/index/page/'.$c[$this->pKey]);?>">
					<i class="entypo-camera"></i><span class="badge badge-secondary"><?php echo $c['images'];?></span></a>&nbsp;
                     <a id="copyID<?php echo $c[$this->pKey];?>" data-rec-name="<?php echo htmlspecialchars($c[$this->colPrefix.'title']);?>" data-controller="<?php echo $this->controller;?>" href="javascript:void(0);" title="Duplicate Record" class="icon-left font16 dupitem">
					<i class="fa fa-copy"></i></a>
                 	<a class="icon-left font16" title="Edit Record" href="<?php echo base_url();?>manage/sliders/control/edit/<?php echo $c['sliders_id'];?>">
					<i class="entypo-pencil"></i></a>
				
					<a class="icon-left font16 delitem" title="Delete Record" href="javascript:void(0);" data-controller="sliders" id="recordID<?php echo $c['sliders_id'];?>">
					<i class="entypo-cancel"></i></a>
                    
                  </td>
                </tr>      
                    
			 <?php		
				}
			  }
			  else{ ?>
				<tr><td colspan="6">Sorry! No Records Found.</td></tr>
              <?php  
			  }
			  ?>
				
			</tbody>
		</table>
        </form>
       <?php 
 $total_pages = ((int) $per_page === 0 )  ? '1' : ceil($total_rows/$per_page); 
 $current_page = ((int) $per_page === 0 )  ? '1' : ceil($page_numb/$per_page)+1; 
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
Showing <?php echo $showing_from;?> to <?php echo $showing_to;?> of <?php echo $total_rows;?> Record<?php echo ((int)$total_rows>1)? 's' : '';?> (Total <?php echo $total_pages;?> Page<?php echo ((int)$total_pages>1)? 's' : '';?>) <?php } echo (isset($paginate)&&$paginate!="") ? $paginate : '';?>  
		
	</div>
	
	
</div>

<script type="text/javascript">
$("#search_status").on('change',function(){
	var search_keywords = $("#search_keywords").val().trim();
	search_keywords = (search_keywords=="") ? "-" : encodeURI(search_keywords);
	window.location = "<?php echo base_url('manage/'.$this->controller.'/index/'.$sortby.'/'.(($order=="ASC") ? 'DESC' : 'ASC'));?>/"+$("#search_status").val()+"/"+search_keywords;
});

$("#search_keywords").keypress(function(event) {
	if (event.keyCode == 13) {
		var search_keywords = $("#search_keywords").val().trim();
	search_keywords = (search_keywords=="") ? "-" : encodeURI(search_keywords);
		window.location = "<?php echo base_url('manage/'.$this->controller.'/index/'.$sortby.'/'.(($order=="ASC") ? 'DESC' : 'ASC'));?>/"+$("#search_status").val()+"/"+search_keywords;
		return false;
	}
});	
</script>

