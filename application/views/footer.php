<?php
if(!isset($no_footer)){?>

        <footer>        
            <div class="container">
                 <div class="row margin-four">
                      
                     
                        
                        <?php
						if(isset($this->ws['phone']) && $this->ws['phone']!=""){
                        echo '<div class="col-md-4 col-sm-4 text-center"><i class="icon-phone small-icon black-text"></i><h6 class="black-text margin-two no-margin-bottom"><a href="tel:'.$this->ws['phone'].'">'.$this->ws['phone'].'</a></h6></div>';
                         }
						  
						if(isset($this->ws['address']) && $this->ws['address']!=""){
                        echo '<div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i><h6 class="black-text margin-two no-margin-bottom">'.nl2br($this->ws['address']).'</h6></div>';
                         }
						 if(isset($this->ws['email']) && $this->ws['email']!=""){
                        echo ' <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i><h6 class="margin-two no-margin-bottom"><a href="mailto:'.$this->ws['email'].'" class="black-text">'.$this->ws['email'].'</a></h6></div>';
                         }
						  ?>
                       
                         
                        <!-- end address -->
                        <!-- email -->
                       
                        <!-- end email -->
                    </div>
                <div class="wide-separator-line bg-mid-gray no-margin-lr margin-three no-margin-bottom"></div>
                <div class="row margin-four">
                    <div class="col-md-6 col-sm-12 sm-text-center sm-margin-bottom-four">
                        <!-- link -->
                        <ul class="list-inline footer-link text-uppercase">
                        	<?php echo (isset($foot1)) ? $foot1 : '';?> 
                        </ul>
                        <!-- end link -->
                    </div>
                    <div class="col-md-6 col-sm-12 footer-social text-right sm-text-center">
                        <!-- social media link -->
                       
                        <?php 
						echo (isset($this->ws['facebook']) && $this->ws['facebook'] != "") ? '<a href="'.$this->ws['facebook'].'" target="_blank"><i class="fa fa-facebook"></i></a>' : '';
						echo (isset($this->ws['twitter']) && $this->ws['twitter'] != "") ? '<a href="'.$this->ws['twitter'].'" target="_blank"><i class="fa fa-twitter"></i></a>' : '';
						echo (isset($this->ws['google']) && $this->ws['google'] != "") ? '<a href="'.$this->ws['google'].'" target="_blank"><i class="fa fa-google-plus"></i></a>' : '';
						echo (isset($this->ws['instagram']) && $this->ws['instagram'] != "") ? '<a href="'.$this->ws['instagram'].'" target="_blank"><i class="fa fa-instagram"></i></a>' : '';
						
						echo (isset($this->ws['pinterest']) && $this->ws['pinterest'] != "") ? '<a href="'.$this->ws['pinterest'].'" target="_blank"><i class="fa fa-pinterest"></i></a>' : '';
						echo (isset($this->ws['linkedin']) && $this->ws['linkedin'] != "") ? '<a href="'.$this->ws['linkedin'].'" target="_blank"><i class="fa fa-linkedin"></i></a>' : '';
						echo (isset($this->ws['youtube']) && $this->ws['youtube'] != "") ? '<a href="'.$this->ws['youtube'].'" target="_blank"><i class="fa fa-youtube"></i></a>' : '';
						echo (isset($this->ws['flickr']) && $this->ws['flickr'] != "") ? '<a href="'.$this->ws['flickr'].'" target="_blank"><i class="fa fa-flickr"></i></a>' : '';
						echo (isset($this->ws['skype']) && $this->ws['skype'] != "") ? '<a href="skype:'.$this->ws['skype'].'?chat" target="_blank"><i class="fa fa-skype"></i></a>' : '';
						?>
                        
                        <!-- end social media link -->
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-purple footer-bottom">
                <div class="container">
                    <div class="row margin-three">
                        <!-- copyright -->
                        <div class="col-md-6 col-sm-6 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one white-text">
                            Copyright 2017 © <?php echo (isset($this->ws['website_title'])) ? $this->ws['website_title'] : '';?> All Rights Reserved.                        </div>
                        <!-- end copyright -->
                        <!-- logo -->
                        <div class="col-md-6 col-sm-6 col-xs-12 footer-logo text-right xs-text-center white-text">
                            Design &amp; developed by <a class="white-text" href="http://www.ctechsols.com" target="_blank">C-Tech Solutions</a>
                        </div>
                        <!-- end logo -->
                    </div>

                </div>
            </div>
            <!-- scroll to top --> 
            <a href="javascript:;" class="scrollToTop"><i class="fa fa-angle-up"></i></a> 
            <!-- scroll to top End... --> 
        </footer>
<?php } ?>
		<script type="text/javascript">
		var base_url = "<?php echo base_url();?>";
		var login_url = "<?php echo (isset($login_url)) ? $login_url : base_url();?>";
		var reg_url = "<?php echo (isset($reg_url)) ? $reg_url : base_url();?>";
		var forgot_url = "<?php echo (isset($forgot_url)) ? $forgot_url : base_url();?>";
		</script>        
        <!-- javascript libraries / javascript files set #1 --> 
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/bootstrap.js"></script> 
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/bootstrap-hover-dropdown.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.easing.1.3.js"></script> 
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/skrollr.min.js"></script>  
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/smooth-scroll.js"></script>
         <!-- jquery appear -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.appear.js"></script>
        <!-- animation -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/wow.min.js"></script>
        <!-- page scroll -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/page-scroll.js"></script>
        <!-- easy piechart-->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.easypiechart.js"></script>
        <!-- parallax -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.parallax-1.1.3.js"></script>
        <!--portfolio with shorting tab --> 
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.isotope.min.js"></script> 
        <!-- owl slider  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/owl.carousel.min.js"></script>
        <!-- magnific popup  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/popup-gallery.js"></script>
        <!-- text effect  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/text-effect.js"></script>
        <!-- revolution slider  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.revolution.js"></script>
        <!-- counter  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/counter.js"></script>
         <!-- countTo -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.countTo.js"></script>
        <!-- fit videos  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.fitvids.js"></script>
        <!-- imagesloaded  -->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/imagesloaded.pkgd.min.js"></script>
        <!-- hamburger menu-->
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/classie.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/hamburger-menu.js"></script>
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/jquery.validate.min.js"></script>        
        <!-- setting --> 
        <script type="text/javascript" src="<?php echo FRONTEND_ASSETS;?>js/main.js"></script>

    </body>
</html>
