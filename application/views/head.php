<?php header('Content-Type: text/html; charset=utf-8');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo (isset($page_title)) ? $page_title : ((isset($this->ws['website_title'])) ? $this->ws['website_title'] : ''); ?></title>
<meta name="description" content="<?php echo (isset($page_meta_desc)) ? $page_meta_desc : htmlspecialchars($this->ws['web_meta']); ?>">
<meta name="keywords" content="<?php echo (isset($page_meta_key)) ? $page_meta_key : ''; ?>">
<meta name="author" content="<?php echo (isset($this->ws['website_title'])) ? $this->ws['website_title'] : "";?>">
<link rel="canonical" href="<?php echo current_url();?>"/>
<meta name="robots" content="">
<!-- Facebook OpenGraph Tags -->
<meta property="fb:app_id" content="377905795877244"/> 
<meta property="og:title" content="<?php echo (isset($page_title)) ? $page_title : ((isset($this->ws['website_title'])) ? $this->ws['website_title'] : ''); ?>"/>


<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo current_url();?>"/>
<?php if(isset($og_image)&&$og_image!=""){	
	echo '<meta property="og:image" content="'.$og_image.'"/>
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
	';

}else{
echo '<meta property="og:image" content="'.$this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo'],527,0).'"/>
			<meta property="og:image:width" content="527" />
		<meta property="og:image:height" content="292" />
	';
}
?>

<meta property="og:site_name" content="<?php echo (isset($this->ws['website_url'])) ? $this->ws['website_url'] : "";?>"/>
<meta property="og:description" content="<?php echo (isset($page_meta_desc)) ? $page_meta_desc : ''; ?>"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />


<?php
if(isset($this->ws['favicon']) && file_exists('./assets/frontend/images/logo/'.$this->ws['favicon']))
{?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],57,57);?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],60,60);?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],72,72);?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],76,76);?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],114,114);?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],120,120);?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],144,144);?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],152,152);?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],180,180);?>">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],192,192);?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],32,32);?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],96,96);?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],16,16);?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['favicon'],144,144);?>">
<meta name="theme-color" content="#ffffff">
<?php } ?>
<!-- animation --> 
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/animate.css" />
<!-- bootstrap --> 
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/bootstrap.css" />
<!-- et line icon --> 
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/et-line-icons.css" />
<!-- font-awesome icon -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/font-awesome.min.css" />
<!-- revolution slider -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/extralayers.css" />
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/settings.css" />
<!-- magnific popup -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/magnific-popup.css" />
<!-- owl carousel -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/owl.transitions.css" />
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/full-slider.css" />
<!-- text animation -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/text-effect.css" />
<!-- hamburger menu  -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/menu-hamburger.css" />
<!-- common -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/style.css" />
<!-- responsive -->
<link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/responsive.css" />
 <link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/loader.css" />
<!--[if IE]>
    <link rel="stylesheet" href="<?php echo FRONTEND_ASSETS;?>css/style-ie.css" />
<![endif]-->
<!--[if IE]>
    <script src="<?php echo FRONTEND_ASSETS;?>js/html5shiv.js"></script>
<![endif]-->

</head>
