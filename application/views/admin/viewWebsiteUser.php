
<ol class="breadcrumb bc-3">
<li><a href="<?php echo ADMIN_URL;?>"><i class="entypo-home"></i>Home</a></li>
<li><a href="<?php echo ADMIN_URL.$this->controller;?>"><i></i><?php echo $this->moduleName;?></a></li>
<li class="active"><strong> User Details</strong></li>
</ol>
     
 
  
     
     

<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
    <table class="table table-striped">
					<thead>
						<tr>
							<th colspan="2">USER DETAILS</th>
							
						</tr>
					</thead>
					
					<tbody>
						<tr>
							<td width="35%">Name</td>
							<td><?php echo $record['usr_name'];?></td>
							
						</tr>
                       
						<tr>
							<td width="35%">Email:</td>
							<td><?php echo $record['usr_email'];?></td>
							
						</tr>
                        
                        <tr>
							<td width="35%">Phone:</td>
							<td><?php echo $record['usr_phone'];?></td>
							
						</tr>
                       
                        <tr>
							<td width="35%">Username:</td>
							<td><?php echo $record['usr_user_name'];?></td>
							
						</tr>
                         
						<tr>
							<td>Registration Date / Time</td>
							<td><?php echo date('M d, Y h:i a',strtotime($record['usr_regdate']));?></td>
							
						</tr>
						<tr>
							<td>Last Login</td>
							<td><?php echo date('M d, Y h:i a',strtotime($record['usr_lastlogin']));?></td>
							
						</tr>
						<tr>
							<td>IP Addrress</td>
							<td><?php echo $record['usr_lastip'];?>                  
                            </td>
						</tr>
                        
                        <tr>
							<td>User Agent</td>
							<td><?php echo $record['usr_agent'];?></td>
						</tr>
                        <tr>
							<td>User Status</td>
							<td><?php echo $record['usr_status'];?></td>
						</tr>
                        
					</tbody>
				</table>
                
    
                
   
    		
  
</div>
  
  </div>
  

