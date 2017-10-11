<?php
require_once('head.php');
?>
<body>
<div id="loader-wrapper">
        <center> <div id="loader"></div></center>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    <header class="entry-header">
    <?php
	if(isset($this->ws['logo']) && file_exists('./assets/frontend/images/logo/'.$this->ws['logo'])){?>
        <center><img alt="<?php echo $this->ws['website_title'];?> Logo" src="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo2'],490,0);?>" class="img-responsive" id="loader_logo"></center>
    <?php } ?>
    </header>
    
    </div>
    <!-- navigation panel -->
    <nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav  nav-border-bottom  <?php echo (!isset($hNav)) ? 'nav-gray' : '';?>" role="navigation">
    
    
            
            
            <div class="container">
                <div class="row">
                    <!-- logo -->
                    <div class="col-md-2 col-sm-4 col-xs-6 pull-left <?php echo (isset($hNav)) ? 'hidden' : '';?>">
                    <a class="logo-light" href="<?php echo base_url();?>"><img alt="<?php echo $this->ws['website_title'];?> Logo" src="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo'],600,0);?>"  /></a><a class="logo-dark" href="<?php echo base_url();?>"><img alt="<?php echo $this->ws['website_title'];?> Logo" src="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo'],600,0);?>" /></a></div>
                    <!-- end logo -->
                    <!-- search and cart  -->
                    
                    <!-- end search and cart  -->
                    <!-- toggle navigation -->
                    <div class="navbar-header col-sm-8 col-xs-2 pull-right ">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <!-- toggle navigation end -->
                    <!-- main menu -->
                    <div class="col-md-<?php echo (isset($hNav)) ? '12' : '10';?> no-padding-right accordion-menu text-right ">
                        <div class="navbar-collapse collapse">
                            <ul id="accordion" class="nav navbar-nav navbar-right panel-group inner-nav">
                                <!-- menu item -->
                               <?php echo (isset($nav)) ? $nav : '';?>
                              
                            </ul>
                        </div>
                    </div>
                    <!-- end main menu -->
                </div>
            </div>
        </nav>

