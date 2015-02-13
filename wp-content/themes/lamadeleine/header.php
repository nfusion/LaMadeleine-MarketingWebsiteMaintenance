<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('|', true, 'right'); bloginfo('name'); /* Remove bloginfo('name') if using YOAST SEO */ ?></title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-print.css" type="text/css" media="print" /> 
<?php roots_stylesheets(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-sIFR-screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-sIFR-print.css" type="text/css" media="print" />
<!--[if IE]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-ie.css" type="text/css" media="screen, projection" />
<![endif]-->
<!--[if lt IE 7]>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lamad-ie6.css" type="text/css" media="screen, projection" />
<![endif]-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
<?php roots_head(); ?>
<?php wp_head(); ?>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/clearForm.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/sifr.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/sifr-addons.js"></script>
<script type="text/javascript">
	swfobject.embedSWF("<?php echo get_template_directory_uri(); ?>/swf/footer.swf", "footerFlash", "751", "84", "9.0.0", '<?php echo get_template_directory_uri(); ?>/swf/expressInstall.swf', false, {wmode:"transparent"}, false);
	<?php if( is_front_page() ) : ?>
	swfobject.embedSWF("<?php echo get_template_directory_uri(); ?>/swf/circle_flower.swf", "flashCircle", "218", "163", "9.0.0", '<?php echo get_template_directory_uri(); ?>/swf/expressInstall.swf', false, {wmode:"transparent"}, false);
	<?php endif; ?>
</script>
<script>
//alert(navigator.appVersion);
if (navigator.appName == "Netscape" && navigator.appVersion.search(/safari/i) >= 0)
{
document.write('<style type="text/css">');
document.write('#search {height:15px;}');
document.write('</style>');
}
</script>
<?php $page_info = get_post_custom(); ?>
</head>
<body <?php if( is_front_page() ) echo 'id="home"'; ?> <?php body_class(array(roots_body_class(),$page_info['wpcf-body-class'][0])); ?>>
	<div class="wrapper">
		<div id="container">

			<div id="header">
				<h1 id="logo"><a href="<?php echo home_url(); ?>/">La Madeleine</a></h1>
				<div id="navigation">
					<div class="left">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new Roots_Navbar_Nav_Walker())); ?>
					</div>
					<div class="right">
						<form name="searchForm" method="get" action="/locations">
							<div class="left" id="findACafe"><a href="<?php echo home_url(); ?>/locations" onMouseOver="findCafe.src='<?php echo get_template_directory_uri(); ?>/img/img_txt_find-a-cafe_over.png'" onMouseOut="findCafe.src='<?php echo get_template_directory_uri(); ?>/img/img_txt_find-a-cafe.png'"><img src="<?php echo get_template_directory_uri(); ?>/img/img_txt_find-a-cafe.png" width="102" height="13" border="0" alt="Find a Cafe" name="findCafe" /></a></div>
							<div class="left"><img src="<?php echo get_template_directory_uri(); ?>/img/img_home-input-left.png" width="5" height="17" border="0" /></div>

							<div class="left"><input type="text" name="addressInput" id="search" value="CITY OR ZIP" onfocus="ClearForm();" onblur="ResetForm();" /></div>
							<div class="left"><input type="image" name="go" id="go" src="<?php echo get_template_directory_uri(); ?>/img/img_home-btn-go.png" width="32" height="17" border="0" alt="Go" /></div>
							<div class="clear"></div>
						</form>
					</div>
					<div class="clear"></div>
				</div>
				<div id="social">
					<?php wp_nav_menu(array('theme_location' => 'social_navigation', 'walker' => new Roots_Navbar_Nav_Walker())); ?>
				</div>
			</div>