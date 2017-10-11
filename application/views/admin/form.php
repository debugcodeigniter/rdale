<ol class="breadcrumb bc-3">
						<li>
				<a href="index.html"><i class="entypo-home"></i>Home</a>
			</li>
					<li>
			
							<a href="tables-main.html">Tables</a>
					</li>
				<li class="active">
			
							<strong>Basic Tables</strong>
					</li>
					</ol>
                    
<div class="row alertrow">
	<div class="col-md-12">
    <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-success"><strong>Well done!</strong> You successfully read this important alert message.</div>
	</div>
</div>

<div class="row alertrow">
	<div class="col-md-12">
     <button class="close alertBox" data-dismiss="alert">x</button>
		<div class="alert alert-danger"><strong>Heads up!</strong> This alert needs your attention, but it's not super important.</div>
	</div>
	
</div>

<h2>Add Form</h2>
<br />


<div class="panel panel-primary">

	
	
	<div class="panel-body">
	
		<form role="form" id="form1" method="post" class="validate">
			
			<div class="form-group">
				<label class="control-label">Required Field + Custom Message</label>
				
				<input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Email Field</label>
				
				<input type="text" class="form-control" name="email" data-validate="email" placeholder="Email Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Input Min Field</label>
				
				<input type="text" class="form-control" name="min_field" data-validate="number,minlength[4]" placeholder="Numeric + Minimun Length Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Input Max Field</label>
				
				<input type="text" class="form-control" name="max_field" data-validate="maxlength[2]" placeholder="Maximum Length Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Numeric Field</label>
				
				<input type="text" class="form-control" name="number" data-validate="number" placeholder="Numeric Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">URL Field</label>
				
				<input type="text" class="form-control" name="url" data-validate="required,url" placeholder="URL" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Credit Card Field</label>
				
				<input type="text" class="form-control" name="creditcard" data-validate="required,creditcard" placeholder="Credit Card" />
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success">Validate</button>
				<button type="reset" class="btn">Reset</button>
			</div>
		
		</form>
	
    
    
    <hr>
    <form role="form" id="form22" method="post" class="validate">
			
			<div class="form-group">
				<label class="control-label">Required Field + Custom Message</label>
				
				<input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Email Field</label>
				
				<input type="text" class="form-control" name="email" data-validate="email" placeholder="Email Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Input Min Field</label>
				
				<input type="text" class="form-control" name="min_field" data-validate="number,minlength[4]" placeholder="Numeric + Minimun Length Field" />
			</div>
			
			<div class="form-group">
				<label class="control-label">Input Max Field</label>
				
				<input type="text" class="form-control" name="max_field" data-validate="maxlength[2]" placeholder="Maximum Length Field" />
			</div>
			
			
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success">Validate Two</button>
				<button type="reset" class="btn">Reset</button>
			</div>
		
		</form>
    
    
    
    
	</div>



