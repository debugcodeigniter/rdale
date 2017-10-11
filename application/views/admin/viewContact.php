
<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller;?>"><i></i><?php echo $this->moduleName;?></a></li>
<li class="active"><strong> <?php echo rtrim($this->moduleName);?> Details</strong></li>
</ol>
     
 
  
     
     

<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
    <table class="table table-striped">
					<thead>
						<tr>
							<th colspan="2">CONTACT US DETAILS</th>
							
						</tr>
					</thead>
					
					<tbody>
						<tr>
							<td width="35%">Name</td>
							<td><?php echo $record['con_fname'];?></td>
							
						</tr>
                       
						<tr>
							<td width="35%">Email:</td>
							<td><?php echo $record['con_email'];?></td>
							
						</tr>
                        <!--
                        <tr>
							<td width="35%">Country:</td>
							<td><?php echo $record['con_country'];?></td>
							
						</tr>
                        -->
                        <tr>
							<td width="35%">Phone:</td>
							<td><?php echo $record['con_phone'];?></td>
							
						</tr>
                       
                        <tr>
							<td width="35%">Message:</td>
							<td><?php echo nl2br($record['con_message']);?></td>
							
						</tr>
                         <tr>
							<td width="35%">Attachment:</td>
							<td><?php echo ($record['con_file']!="" && file_exists('./assets/contact_files/'.$record['con_file'])) ? '<a href="'.base_url('assets/contact_files/'.$record['con_file']).'" target="_blank">'.$record['con_file'].'</a>' : 'N/A';?></td>
							
						</tr>
						<tr>
							<td>Date / Time</td>
							<td><?php echo date('M d, Y h:i a',strtotime($record['con_added']));?></td>
							
						</tr>
						
						<tr>
							<td>IP Addrress</td>
							<td><?php echo $record['con_ip'];?>                  
                            </td>
						</tr>
                        
                        <tr>
							<td>User Agent</td>
							<td><?php echo $record['con_user_agent'];?></td>
						</tr>
                        
					</tbody>
				</table>
                
    
                
   
    		
  
</div>
  
  </div>
  

