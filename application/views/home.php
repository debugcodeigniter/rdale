<section class="rd-cover">
      			<div class="rd-logo-bg">
                	<center><a href="index.html"><img src="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo2'],490,0);?>" class="img-responsive" alt="<?php echo $this->ws['website_title'];?> Logo"></a></center>
                </div>
                
                <?php
				if(isset($userData) && !empty($userData) && $pageData['page_id'] == "5")
				{?>
                	<div class="container rd-mforms" id="pwd-box">
                	<div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col rd-form-white">
                        <br clear="all">
                        <form id="pwdform" name="pwdform" method="post">
                        	
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="cpassword" class="text-uppercase ">Current Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                 <input type="password" name="cpassword" id="cpassword" placeholder="Current Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="password" class="text-uppercase">New Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" name="password" id="password" placeholder="New Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="password" class="text-uppercase">Confirm New Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm New Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            
                            <div class="form-group mtop20">
                            <img class="dblock hidden" id="pwd-loader" src="<?php echo FRONTEND_ASSETS.'images/ajax-loader.gif';?>" alt="Loading.." />
                            <p class="error hidden" id="pwd-error"></p>
                            <p class="error hidden" id="pwd-success"></p>
                            <button class="btn btn-rd" id="pwd-btn" autocomplete="off"  type="submit">Submit</button> 
                            </div>
                           
                            <br clear="all">
                        </form>
                    </div>
                </div>
                <br clear="all">                            <br clear="all">

                </div>
                
                <?php
				}else if(isset($userData) && !empty($userData) && $pageData['page_id'] == "6")
				{?>
					<div class="container  rd-mforms" id="edit-box">
                	<div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col rd-form-white">
                        <br clear="all">
                        <form id="editform" name="editform" method="post">
                        	<div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="name" class="text-uppercase no-margin-top">Name</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="name" id="name" value="<?php echo $userData['usr_name'];?>" placeholder="Name" class="input-round big-input">
                                <!-- end input  -->
                               
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase">Email</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="email" id="email" value="<?php echo $userData['usr_email'];?>" placeholder="Email" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase">Phone</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="phone" id="phone" value="<?php echo $userData['usr_phone'];?>" placeholder="Phone" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase ">Username</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" readonly="readonly" value="<?php echo $userData['usr_user_name'];?>" name="username" id="username" placeholder="Username" class="input-round big-input uname">
                                <!-- end input  -->
                            </div>
                            
                            <div class="form-group mtop20">
                            <img class="dblock hidden" id="edit-loader" src="<?php echo FRONTEND_ASSETS.'images/ajax-loader.gif';?>" alt="Loading.." />
                            <p class="error hidden" id="edit-error"></p>
                            <p class="error hidden" id="edit-success"></p>
                            <button class="btn btn-rd" id="edit-btn" autocomplete="off"  type="submit">Submit</button>                            </div>
                           
                            <br clear="all">
                        </form>
                    </div>
                </div>
                <br clear="all">                            <br clear="all">

                </div>
				<?php }	else{?>
                <div class="container <?php echo (isset($pageData['page_id']) && $pageData['page_id'] == "2") ? '' : 'hidden';?> rd-mforms" id="login-box">
                	<div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col rd-form-white">
                        <form id="logform" method="post" >
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="userName" class="text-uppercase">Username</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" maxlength="50" name="userName" id="userName" placeholder="Username" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="userPassword" class="text-uppercase">Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" maxlength="50" name="userPassword" id="userPassword" placeholder="Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group mtop20">
                            <img class="dblock hidden" id="log-loader" src="<?php echo FRONTEND_ASSETS.'images/ajax-loader.gif';?>" alt="Loading.." />
							<p class="error hidden" id="log-error"></p>
                            <button class="btn btn-rd" autocomplete="off" id="log-btn" type="submit">Login</button>  <button class="btn btn-rd rd-factions" data-href="#reg-box"  type="button">Register</button> 
                            <a href="javascript:void(0)" data-href="#forgot-box" class="display-block text-uppercase rd-factions">Forgot Password?</a>
                           </div>
                           
                            <br clear="all">
                        </form>
                    </div>
                </div>
                <br clear="all"><br clear="all">
                </div>
                
                <div class="container <?php echo (isset($pageData['page_id']) && $pageData['page_id'] == "4") ? '' : 'hidden';?> rd-mforms" id="forgot-box">
                	<div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col rd-form-white">
                        <form method="post" id="forgotform" name="forgotform">  
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="forgot_email" class="text-uppercase">Email</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="email" name="forgot_email" id="forgot_email" placeholder="Enter your email to receive new password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                             <div class="form-group mtop20" style="padding-bottom:10px;">
                            <img class="dblock hidden" id="forgot-loader" src="<?php echo FRONTEND_ASSETS.'images/ajax-loader.gif';?>" alt="Loading.." />
							<p class="error hidden" id="forgot-error"></p>
                            <p class="error hidden" id="forgot-success"></p>
                            <button class="btn btn-rd" autocomplete="off"  type="submit" id="forgot-btn">Submit</button>   <button class="btn btn-rd rd-factions" data-href="#login-box"  type="button">Back to Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br clear="all">                            <br clear="all">

                </div>
                
                
                <div class="container <?php echo (isset($pageData['page_id']) && $pageData['page_id'] == "3") ? '' : 'hidden';?>  rd-mforms" id="reg-box">
                	<div class="row">
                    <div class="col-md-5 col-sm-8 col-xs-11 center-col rd-form-white">
                        <br clear="all">
                        <form id="regform" name="regform" method="post">
                        	<div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="name" class="text-uppercase no-margin-top">Name</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="name" id="name" placeholder="Name" class="input-round big-input">
                                <!-- end input  -->
                               
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase">Email</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="email" id="email" placeholder="Email" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase">Phone</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="phone" id="phone" placeholder="Phone" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="username" class="text-uppercase ">Username</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="text" name="username" id="username" placeholder="Username" class="input-round big-input uname">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="password" class="text-uppercase">Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" name="password" id="password" placeholder="Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            <div class="form-group no-margin-bottom">
                                <!-- label  -->
                                <label for="password" class="text-uppercase">Confirm Password</label>
                                <!-- end label  -->
                                <!-- input  -->
                                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" class="input-round big-input">
                                <!-- end input  -->
                            </div>
                            
                            <div class="form-group mtop20">
                            <img class="dblock hidden" id="reg-loader" src="<?php echo FRONTEND_ASSETS.'images/ajax-loader.gif';?>" alt="Loading.." />
                            <p class="error hidden" id="reg-error"></p>
                            <button class="btn btn-rd" id="reg-btn" autocomplete="off"  type="submit">Register</button>  <button class="btn btn-rd rd-factions" data-href="#login-box"  type="button">Back to Login</button>
                            </div>
                           
                            <br clear="all">
                        </form>
                    </div>
                </div>
                <br clear="all">                            <br clear="all">

                </div>
                
               <?php } ?> 
                
                
                
                <div class="cover-foot">
                		<?php 
						echo (isset($this->ws['phone']) && $this->ws['phone']!="") ? '<a href="tel:'.$this->ws['phone'].'"><i class="fa fa-mobile-phone small-icon white-text"></i> '.$this->ws['phone'].'</a>' : '';
						echo (isset($this->ws['email']) && $this->ws['email']!="") ? '<a href="mailto:'.$this->ws['email'].'"><i class="icon-envelope small-icon white-text"></i> '.$this->ws['email'].'</a>' : '';
						?>
                </div>
       </section>