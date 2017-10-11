<?php if(isset($pageData['page_head']) && trim($pageData['page_head'])!=""){?>
<section class="content-top-margin page-title-small border-bottom-light border-top-light rd-bread">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 wow fadeInUp text-center" data-wow-duration="300ms">
                <!-- page title -->
                <h1 class="white-text" <?php echo ($pageData['page_head_color']!="#ffffff") ? 'style="color:'.$pageData['page_head_color'].' !important"' : '';?>><?php echo nl2br(trim($pageData['page_head']));?></h1>
                <!-- end page title -->
            </div>
            
        </div>
    </div>
</section>
<?php } ?>

 
        <section class="wow fadeIn <?php echo (isset($pageData['page_head']) && trim($pageData['page_head'])=="") ? 'pad120' : '';?>"  id="page_contents">
            
            <div class="container">
                <div class="row">
                   <div class="col-md-8 col-sm-8">
                    <?php echo $pageData['page_text'];?>
                   
                        <form id="contactusform" action="<?php echo base_url('home/docontact');?>" method="post" enctype="multipart/form-data">
                            
                            <?php
							if($this->session->flashdata('alert') == 'success'){?>
                            <div class="alert alert-success fade in" role="alert">
                                <i class="fa fa-thumbs-up alert-success"></i>
                                <?php echo (isset($this->ws['contact_text']) && trim($this->ws['contact_text']) != "") ? nl2br($this->ws['contact_text']) : '<strong>Thank you!</strong> Your message has been successfully sent. We will contact you very soon!'; ?>

                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        	</div>
                        	<?php } if($this->session->flashdata('alert') == 'error'){?>
                             <div class="alert alert-danger fade in" role="alert">
                                <i class="fa fa-warning alert-danger"></i>
                                <strong>Sorry!</strong> Due to some technical issue we are unable to receive your message. Please try again.
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                        	<?php }?>
                            <input type="text" placeholder="Your Name" name="con_name" id="con_name" required="required"/>
                            <input type="text" placeholder="Your Email" name="con_email" id="con_email" required="required"/>
                            <input type="text" placeholder="Your Phone" name="con_phone" name="con_phone"  />
                            <textarea placeholder="Your Message" name="con_message" id="con_message"></textarea>
                            <input class="finput" type="file" name="con_file" id="con_file" >
                           <button id="contact-us-button" name="con_submit" type="submit" class="highlight-button-dark btn btn-small button xs-margin-bottom-five">Send message</button>
                        </form>
                    </div>
                    <!-- office address -->
                    <div class="col-md-4 col-sm-4 xs-margin-bottom-ten">
                        <div class="position-relative">
                        <?php
						if(isset($this->ws['map_image']) && $this->ws['map_image']!="" && file_exists('./assets/frontend/images/map/'.$this->ws['map_image'])){?>
       <img alt="Our Office" src="<?php echo $this->imagethumb->image('./assets/frontend/images/map/'.$this->ws['map_image'],800,0);?>" class="img-responsive">
<?php }?>                        
                        </div>
                        <?php echo (isset($this->ws['lat_long']) && $this->ws['lat_long']!="") ? '<p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600 xs-margin-top-five">'.$this->ws['lat_long'].'</p>' : '';?>
                        <?php echo (isset($this->ws['address']) && trim($this->ws['address'])!="") ? '<p>'.nl2br(trim($this->ws['address'])).'</p>' : '';?>
                        <div class="wide-separator-line bg-mid-gray no-margin-lr"></div>
                        <?php 
						echo (isset($this->ws['phone']) && $this->ws['phone']!="") ? '<p class="black-text no-margin-bottom"><strong>T.</strong> <a href="tel:'.$this->ws['phone'].'">'.$this->ws['phone'].'</a></p>' : '';
                        echo (isset($this->ws['email']) && $this->ws['email']!="") ? '<p class="black-text"><strong>E.</strong> <a href="mailto:'.$this->ws['email'].'">'.$this->ws['email'].'</a></p>' : '';
						?>
                    </div>
                    <!-- end office address -->
                    
                </div>
            </div>
        </section>
<?php
if(isset($this->ws['map_iframe']) && $this->ws['map_iframe']!="")
{        
	echo'<section class="wow fadeIn no-padding">
			<div class="container-fuild">
				<div class="row no-margin">
					<div id="canvas1" class="col-md-12 col-sm-12 no-padding contact-map map ">'.$this->ws['map_iframe'].'</div>
				</div>
			</div>
		</section>';
}?>
