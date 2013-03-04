<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<meta name="robots" content="index, follow" />
	<meta name="distribution" content="global" />
	<meta name="description" content="discovering new recipes and food daily" />
	<meta name="keywords" content="april hodge silver, food, recipes" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- jQuery library (served from Google) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- bxSlider Javascript file -->
    <script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.carouFredSel-6.2.0.js"></script>
    <!-- bxSlider CSS file -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.bxslider.css"/>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.bxslider').bxSlider();

            //	Scrolled by user interaction
            $('.recent_work .slidermini').carouFredSel({
                auto: false,
                prev: '.recent_work .prev',
                next: '.recent_work .next',
                width: '100%',
                items: 4
            });
        });
    </script>
</head>

<body <?php body_class() ?>>

<a name="top"></a>
	<div id="header">
        <div id="banner_menu">
            <div id="logo">Logo</div>
            <div id="mainnav">
                <?php wp_nav_menu(); ?>
             </div><!-- /mainnav -->
        </div>


		<!--<h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>-->
		<!--<div id="description"><?php bloginfo('description'); ?></div>-->
	</div><!-- /header -->
    <div class="main_slider">
        <div id="slider">
            <ul class="bxslider">
                <li>
                    <img src="<?php bloginfo('template_url'); ?>/images/slide_1.png"  />
                    <p id="slider_p1">Develop Your Creative Practice </p>
                    <p id="slider_p2">Learn about our</p>
                    <p id="slider_p3">Studio Art Intensive</p>
                    <p id=slider_p4><a href="#" id="learnmore">Learn More<div id="arrow_white"></div></a></p>
                </li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/hero-phone-hand.png"/></a></li>
            </ul>
        </div>
    </div>


