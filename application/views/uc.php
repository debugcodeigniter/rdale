<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ((isset($this->ws['website_title'])) ? $this->ws['website_title'] : '');?></title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
<style>
body{
	padding:0;
	margin:0;
	font-family: 'Open Sans', sans-serif;;
	background:#434868;
}
h1{
	color: #fff;
    line-height: 48px;
	font-size:32px;
	font-weight:400;
	margin-top:40px;
	
}
img{
	margin-top:130px;	
	max-width:100%;
}

</style>
</head>

<body>
<center>

<figure><img src="<?php echo $this->imagethumb->image('./assets/frontend/images/logo/'.$this->ws['logo2'],300,0);?>" class="img-responsive" alt="<?php echo (isset($this->ws['website_title'])) ? $this->ws['website_title'] : '';?> Logo" /></figure>
<h1>Website Under Construction</h1>
</center>
</body>
</html>
