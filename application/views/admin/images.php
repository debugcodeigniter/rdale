<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.'portfolio';?>">Rooms</a></li>

<li class="active"><strong><?php echo $catData['cat_name'].' '.$this->moduleName;?></strong></li>
</ol>

 <?php if($alert=="success") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> <?php echo rtrim($this->moduleName,'s');?> added sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="deletesuccess") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> <?php echo rtrim($this->moduleName,'s');?> deleted sucessfully.</div>
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
		<div class="alert alert-success"><strong>Success!</strong> <?php echo rtrim($this->moduleName,'s');?> updated sucessfully.</div>
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


<h2><?php echo $catData['cat_name'].' '.$this->moduleName;?></h2>
<hr />



<div class="row" style="min-height:400px;">
	<div class="col-md-12">
		<button  id="deleteAllRecords" class="btn btn-default btn-icon icon-left" type="button">
            Delete Selected
            <i class="entypo-trash"></i>
        </button> 
        
        <button  class="btn btn-default btn-icon icon-left" type="button" onclick="javascript:window.location='<?php echo base_url('manage/'.$this->controller.'/control/'.$cat_id);?>'">
            Add Single <?php echo rtrim($this->moduleName,'s');?>
            <i class="entypo-plus-circled"></i>
        </button>
        <button  class="btn btn-default btn-icon icon-left" type="button" onclick="javascript:window.location='<?php echo base_url('manage/'.$this->controller.'/uploadimages/'.$cat_id);?>'">
            Add Multiple <?php echo $this->moduleName;?>
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
         
        <br clear="all" />
      
        <hr />
		<form action="<?php echo ADMIN_URL.$this->controller;?>/deleteall" method="post" name="multiDel" id="multiDel">
		<table id="table-<?php echo $this->controller;?>" class="table table-hover table-striped">
			<thead>
				<tr>
					<th><input type="checkbox" id="all-checkbox" name="all-checkbox" autocomplete="off"></th>
                    <th  class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$this->pKey.'/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">ID</a></th>
					<th class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$this->colPrefix.'image/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Image</a></th>
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$this->colPrefix.'name/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Name</a></th>
                    
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$this->tStatus.'/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Status</a></th>
                    <th class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$this->colPrefix.'added/'.$order.'/'.$status.'/'.$keywords.'/'.$page_numb);?>">Added On</a></th>
                    <th>Actions</th>
				</tr>
			</thead>
			
			<tbody>
            <?php
			  if(count($records)>0)
			  {
				foreach($records as $c)
				{
					?>
              <tr id="<?php echo $this->controller.'-'.$c[$this->pKey];?>">
                  <td><input name="records[]" autocomplete="off" class="cselect" value="<?php echo $c[$this->pKey];?>" type="checkbox" /></td>
                 <td class="hideCol"><?php echo $c[$this->pKey];?></td>
                
				<td class="hideCol">
                  <a href="<?php echo ($c[$this->colPrefix.'image']!=""&&file_exists('./assets/frontend/images/'.$this->controller.'/'.$c[$this->colPrefix.'image'])) ? FRONTEND_ASSETS.'images/'.$this->controller.'/'.$c[$this->colPrefix.'image'] : FRONTEND_ASSETS.'images/no_image.jpg';?>" class="fancybox" data-fancybox-group="gallery">
                  <img width="80" src="<?php echo ($c[$this->colPrefix.'image']!=""&&file_exists('./assets/frontend/images/'.$this->controller.'/'.$c[$this->colPrefix.'image'])) ? $this->imagethumb->image('./assets/frontend/images/'.$this->controller.'/'.$c[$this->colPrefix.'image'],80,0) : FRONTEND_ASSETS.'images/no_image.jpg';?>" /></a>
                  
                  </td>
                 
                  
                  
                  <td><a href="<?php echo base_url('manage/'.$this->controller.'/control/edit/'.$c[$this->pKey]);?>"><?php echo $c[$this->colPrefix.'name'];?></a></td>
                  <td><a class="changestatus" href="javascript:void(0);" data-controller="<?php echo $this->controller;?>" id="statusID<?php echo $c[$this->pKey];?>"><?php echo $c[$this->tStatus];?></a></td>
                  <td class="hideCol"><?php echo date('M d, Y h:i a', strtotime($c[$this->colPrefix.'added']));?></td>
                  <td>
                     
                 
                    
                    <a class="icon-left font16" href="<?php echo base_url('manage/'.$this->controller.'/control/'.$c[$this->colPrefix.'cat_id'].'/'.$c[$this->pKey]);?>">
					<i class="entypo-pencil"></i></a>
				
					<a class="icon-left font16 delitem" href="javascript:void(0);" data-controller="<?php echo $this->controller;?>" id="recordID<?php echo $c[$this->pKey];?>">
					<i class="entypo-cancel"></i></a>
                    
                  </td>
                </tr>      
                    
			 <?php		
				}
			  }
			  else{ ?>
				<tr><td colspan="7">Sorry! No Records Found.</td></tr>
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
$(function(){
	
	$("#search_status").on('change',function(){
		var search_keywords = $("#search_keywords").val().trim();
		search_keywords = (search_keywords=="") ? "-" : encodeURI(search_keywords);
		window.location = "<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$sortby.'/'.(($order=="ASC") ? 'DESC' : 'ASC'));?>/"+$("#search_status").val()+"/"+search_keywords;
	});
	
	$("#search_keywords").keypress(function(event) {
		if (event.keyCode == 13) {
			var search_keywords = $("#search_keywords").val().trim();
		search_keywords = (search_keywords=="") ? "-" : encodeURI(search_keywords);
			window.location = "<?php echo base_url('manage/'.$this->controller.'/index/'.$cat_id.'/'.$sortby.'/'.(($order=="ASC") ? 'DESC' : 'ASC'));?>/"+$("#search_status").val()+"/"+search_keywords;
			return false;
		}
	});
	var req = null;
	$('#table-<?php echo $this->controller;?>').tableDnD({
		onDrop: function(table, row) {
			if(req!=null) req.abort();
			req = $.post('<?php echo ADMIN_URL.$this->controller.'/sortrecords';?>',$.tableDnD.serialize(),function(d){
				
			});
		}
    });

});
	
</script>

