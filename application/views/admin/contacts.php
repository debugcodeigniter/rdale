<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li class="active"><strong><?php echo $this->moduleName;?></strong></li>
</ol>

 <?php if($alert=="success") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Record added sucessfully.</div>
	</div>
</div>
   <?php } if($alert=="deletesuccess") { ?>
 <div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Success!</strong> Record deleted sucessfully.</div>
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
		<div class="alert alert-success"><strong>Success!</strong> Record updated sucessfully.</div>
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


<h2><?php echo $this->moduleName;?></h2>
<hr />



<div class="row" style="min-height:400px;">
	<div class="col-md-12">
		
        
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
      <button  id="deleteAllRecords" class="btn btn-default btn-icon icon-left" type="button">
            Delete Selected
            <i class="entypo-trash"></i>
        </button> 
           <form class="form-inline pull-right">
                  <input class="input-medium" type="text" value="<?php echo ($keywords!="-") ? $keywords : "" ;?>"  name="search_keywords" id="search_keywords" placeholder="Search keywords" class=" span11 aplha">
                   
                  
             </form> 
         
        <br clear="all" />
      
        <hr />
		<form action="<?php echo ADMIN_URL.$this->controller;?>/deleteall" method="post" name="multiDel" id="multiDel">
		<table id="table-<?php echo $this->controller;?>" class="table table-hover table-striped">
			<thead>
				<tr>
                <th><input type="checkbox" id="all-checkbox" name="all-checkbox" autocomplete="off"></th>
                    <th  class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->pKey.'/'.$order.'/'.$keywords.'/'.$page_numb);?>">ID</a></th>
					
                    <th><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->colPrefix.'fname/'.$order.'/'.$keywords.'/'.$page_numb);?>">Name</a></th>
                   
                      <th ><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->colPrefix.'email/'.$order.'/'.$keywords.'/'.$page_numb);?>">Email</a></th>
                      <th class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->colPrefix.'phone/'.$order.'/'.$keywords.'/'.$page_numb);?>">Phone</a></th>
                      
                     <th class="hideCol"><a href="<?php echo base_url('manage/'.$this->controller.'/index/'.$this->colPrefix.'added/'.$order.'/'.$keywords.'/'.$page_numb);?>">Date / Time</a></th>
                      
                     <th>Details</th>
                     
                   
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
                
                  <td><?php echo $c[$this->colPrefix.'fname'].' '.$c[$this->colPrefix.'lname'];?></td>
                  <td ><?php echo $c[$this->colPrefix.'email'];?></td>
                   <td class="hideCol"><?php echo $c[$this->colPrefix.'phone'];?></td>
                   
                  
                  <td class="hideCol"><?php echo date('M d, Y h:i a', strtotime($c[$this->colPrefix.'added']));?></td>
                   <td>
                   <button class="btn btn-xs btn-green btn-icon icon-left" type="button" onclick="window.location='<?php echo base_url('manage/'.$this->controller.'/control/view/'.$c[$this->pKey]);?>'">
								View
								<i class="entypo-doc-text"></i>
							</button> &nbsp;&nbsp;
                    <button data-controller="<?php echo $this->controller;?>" id="recordID<?php echo $c[$this->pKey];?>" class="btn btn-xs btn-danger btn-icon icon-left delitem" type="button" >
								Delete
								<i class="entypo-trash"></i>
							</button>  
                
                  
				
					
                    
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
	
	
	
	$("#search_keywords").keypress(function(event) {
		if (event.keyCode == 13) {
			var search_keywords = $("#search_keywords").val().trim();
		search_keywords = (search_keywords=="") ? "-" : encodeURI(search_keywords);
			window.location = "<?php echo base_url('manage/'.$this->controller.'/index/'.$sortby.'/'.(($order=="ASC") ? 'DESC' : 'ASC'));?>/"+search_keywords;
			return false;
		}
	});
	

});
	
</script>

