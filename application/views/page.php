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

<section class="border-bottom-light sm-text-center <?php echo (isset($pageData['page_head']) && trim($pageData['page_head'])=="") ? 'pad120' : '';?>" id="page_contents">
    <div class="container">
        <?php echo $pageData['page_text'];?>
    
    
<?php
if(isset($members) && count($members) > 0)
{?>  
<br clear="all" /><br clear="all" />  
    <div class="row">
    				<?php
					foreach($members as $m)
					{?>
                    <!-- team member -->
                    <div class="col-md-4 col-sm-6 text-center team-member position-relative wow fadeInUp" data-wow-duration="300ms">
                        <img src="<?php echo ($m['member_image']!=""&&file_exists('./assets/frontend/images/team_members/'.$m['member_image'])) ? $this->imagethumb->image('./assets/frontend/images/team_members/'.$m['member_image'],450,500) : $this->imagethumb->image('./assets/frontend/images/no_image.jpg',450,500);?>" alt="<?php echo $m['member_name'];?>"/>
                        <figure class="position-relative bg-white">
                            <span class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600"><?php echo $m['member_name'];?></span>
                            <span class="team-post text-uppercase letter-spacing-2 display-block"><?php echo $m['member_designation'];?></span>
                            <div class="person-social margin-five no-margin-bottom">
                            <?php
                            echo ($m['member_facebook']!="") ? '<a href="'.$m['member_facebook'].'"><i class="fa fa-facebook"></i></a>' : '';
							echo ($m['member_twitter']!="") ? '<a href="'.$m['member_twitter'].'"><i class="fa fa-twitter"></i></a>' : '';
							echo ($m['member_google']!="") ? '<a href="'.$m['member_google'].'"><i class="fa fa-google-plus"></i></a>' : '';
							echo ($m['member_linkedin']!="") ? '<a href="'.$m['member_linkedin'].'"><i class="fa fa-linkedin"></i></a>' : '';
                            ?>
							</div>
                        </figure>
                        <?php
						if(trim($m['member_desc']) != "" || $m['member_caption'] != ""){
                        echo '<div class="team-details">
                            <h5 class="team-headline white-text text-uppercase font-weight-600">'.$m['member_caption'].'</h5>
                            <p class="width-70 center-col white-text margin-five">'.nl2br($m['member_desc']).'</p>
                            <div class="separator-line-thick bg-white"></div>
                        </div>';
						}
						?>
                        
                        
                        
                    </div>
                    <!-- end team member -->
                    <?php } ?>
<?php } ?>    
    </div>
</section>

