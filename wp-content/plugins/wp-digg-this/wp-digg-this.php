<?php

/*
Plugin Name: WP Digg This
Version: 0.7.1
Description: Provides an easy way to selectively add Digg button to your posts. Use 'digg', 'mixx', 'deli', 'twitter', 'stumble' = '1' custom field in the post to promote it.
Author: Vladimir Prelovac
Author URI: http://www.prelovac.com/vladimir/
Plugin URI: http://www.prelovac.com/vladimir/wordpress-plugins/wp-digg-this
*/

/*  
Copyright 2008  Vladimir Prelovac  (email : vprelovac@gmail.com)

Released under GPL License.
*/

// todo add the button to all posts option

/* Version check */
global $wp_version;	

$exit_msg='WP Digg This requires WordPress 2.3 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
$plugin_url=defined('WP_PLUGIN_URL') ? (WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__))) : trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)); 
$DB_option = 'WPDiggThis_options';

if (version_compare($wp_version,"2.3","<"))
{
	exit ($exit_msg);
}

/* Return a Digg link */
function WPDiggThis_Link($url)
{
	global $post;
	
	// get the URL to the post
	$link=urlencode($url);
	
	// get the post title
	$title=urlencode($post->post_title);
	
	// get first 350 characters of post content and strip it off HTML tags
	$text=urlencode(substr(strip_tags($post->post_content), 0, 350));
	
	// create a Digg link and return it	
	return '<a href="http://digg.com/submit?url='.$link.'&amp;title='.$title.'&amp;bodytext='.$text.'">Digg This</a>';				
}

function WPDiggThis_Stumble($url)
{
	global $post;
	
	$title=urlencode($post->post_title);
	
	return '<a href="http://www.stumbleupon.com/submit?url='.urlencode($url).'&title='.$title.'"><img src="http://cdn.stumble-upon.com/images/32x32_su_shadow.gif"></a>';	
	
}


function WPDiggThis_Deli($url)
{
	global $plugin_url;
	global $post;
	// get the URL to the post
	$link=urlencode($url);
	
	// get the post title
	$title=urlencode($post->post_title);
	  
	$code='	
<div class="bookmark-this">

	<img src="'.$plugin_url.'/xtra/delicious-icon.gif" width="18px" height="18px;" alt="" />	
	<span class="md5hash">'.md5($url).'</span> 
	<span class="rank"></span>

	<a href="http://delicious.com/post?v=4&amp;noui&amp;jump=close&amp;url='.$link.'&amp;title='.$title.'" target="_blank">Bookmark to Delicious</a>  
</div>';
	return $code;
}

function WPDiggThis_Facebook($url)
{
	global $plugin_url, $post;
	$link=($url);
	$title=($post->post_title);
	
	/*$output='<div class="facebook-this">

<a onclick="{ }" onmousedown="this.href=\'javascript:void(window.open(\\\'http://www.facebook.com/sharer.php?u=\\\''.$link.'\\\'&amp;t=\\\''.$title.',\\\'sharer\\\',\\\'toolbar=no,width=600,height=400\\\'));\'" href="javascript:void(window.open(\'http://www.facebook.com/sharer.php?u=\\\''.$link.'\\\'&amp;t=\\\''.$title.',\\\'sharer\\\',\\\'toolbar=no,width=600,height=400\'));"><img border="0" src="'.$plugin_url.'/i/fb.jpg"/></a>

</div>';*/

$output='
<a href="http://www.facebook.com/share.php?u='.urlencode($url).'&t='.urlencode($title).'" target="_blank"><img border="0" src="'.$plugin_url.'/i/fb.jpg"/></a>
';

return $output;
	
}

function WPDiggThis_Twitter($url)
{
	 $output='';
	 
	 // old tweetsuite code
	 /* if (function_exists('tweetsuite_tweetthis_button'))
	 {
		 ob_start();
	   tweetsuite_tweetthis_button();
	   $output = ob_get_contents();
	   ob_end_clean(); 
   }*/      
   
   $output='
   <script type="text/javascript">
tweetmeme_url = \''.js_escape($url).'\';
</script>
<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>';
   
   return $output;
}

function WPDiggThis_Mixx($url)
{
	
	$link=js_escape($url);

	return '<script type="text/javascript">
        mixx_url = "'.$link.'";
        mixx_bgcolor = "#fff";
        mixx_theme = "blue";
        mixx_type = "vertical";
</script>
<script type="text/javascript" src="http://www.mixx.com/button/button.js"></script>';

}
/* Return a Digg button */
function WPDiggThis_Button($url)
{
	global $post;
	
	// get the URL to the post
	$link=js_escape($url);
	
	// get the post title
	$title=js_escape($post->post_title);
	
	// get the content	
	$text=js_escape(substr(strip_tags($post->post_content), 0, 350));		
	
	// create a Digg button and return it	
	$button="
	<script type='text/javascript'>
	digg_url = '$link';
	digg_title = '$title';
	digg_bodytext = '$text';
	</script>
	<script src='http://digg.com/tools/diggthis.js' type='text/javascript'></script>";
			
	return $button;	
}


function admin_menu() {	
		add_options_page('WP Digg This Options', 'Digg', 8, basename(__FILE__), 'handle_options');		
} 

function get_options() {
	global $DB_option, $plugin_url;
	   $options = array(					
			'home' => '',
			'category' => '',
			'archive' => '',
			'search' => '',
			'template' => htmlspecialchars('<div style="float: left; margin-right: 10px; margin-bottom: 4px;">{button}</div>'),
			'after'=>''
		);

    $saved = get_option($DB_option);

    if (!empty($saved)) {
        foreach ($saved as $key => $option)
            $options[$key] = $option;
    }           
    
    if ($saved != $options)
    	update_option($DB_option, $options); 
    	
    return $options;
	}


function handle_options()
	{
		global $DB_option, $plugin_url;
		$options = get_options();

		if ( isset($_POST['submitted']) ) {
			
			check_admin_referer('wp-digg-this');
			
			$options = array();
					
			$options['home']=$_POST['home'];						
			$options['category']=$_POST['category'];	
			$options['archive']=$_POST['archive'];	
			$options['search']=$_POST['search'];	
			$options['after']=$_POST['after'];	
			$options['template']=stripslashes(htmlspecialchars($_POST['template']));	
			
		
			update_option($DB_option, $options);
			echo '<div class="updated fade"><p>Plugin settings saved.</p></div>';
		}

		$home=$options['home']=='on'?'checked':'';
		$category=$options['category']=='on'?'checked':'';
		$archive=$options['archive']=='on'?'checked':'';
		$search=$options['search']=='on'?'checked':'';
		$after=$options['after']=='on'?'checked':'';
		
		$template=(wp_specialchars($options['template']));

		$action_url = $_SERVER['REQUEST_URI'];	
		$imgpath=$plugin_url.'/i';	

		include('wp-digg-this-options.php');
		
	}

add_action('admin_menu',  'admin_menu');	                


/* Add Digg This to the post */
function WPDiggThis_ContentFilter($content)
{		
	global $post;
	$button='';
	$options=get_options();
	

	if (( is_single() || 
				is_page() || 
				(is_home() && $options['home']) ||
				(is_category() && $options['category']) ||
				(is_archive() && $options['archive']) ||
				(is_search() && $options['search'])))
	{ 		
	
		$url=get_permalink($post->ID);
		$if_any = 0;
		
		if (get_post_meta($post->ID, 'twitter', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Twitter($url).'</div>';	
			$if_any = 1;
		}
		
		if (get_post_meta($post->ID, 'fb', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Facebook($url).'</div>';
			$if_any = 1;
		}
			
		if (get_post_meta($post->ID, 'digg', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Button($url).'</div>';
			$if_any = 1;
		}
		
		if (get_post_meta($post->ID, 'stumble', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Stumble($url).'</div>';	
			$if_any = 1;
		}
		
		if (get_post_meta($post->ID, 'deli', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Deli($url).'</div>';
			$if_any = 1;
		}
			
		if (get_post_meta($post->ID, 'mixx', true)){
			$button.='<div class="wdt_button">'.WPDiggThis_Mixx($url).'</div>';
			$if_any = 1;
		}
			
		// encapsulate the button in a div
	
			$button= str_replace('{button}',  $button, html_entity_decode($options['template'])); 
		
		if ($if_any){
			if ($options['after'])
				return $content.$button;			
			else
				return $button.$content;			
		} else {
			return $content;
		}
	}
	else return $content;
}

add_filter('the_content', 'WPDiggThis_ContentFilter'	);


function WPDiggThis_ScriptsAction()
{
	if (!is_admin())
	{
		global $plugin_url;
	  wp_enqueue_script('jquery');
	  wp_enqueue_script('wp_digg_this_script', $plugin_url.'/wp-digg-this.js', array('jquery')); 
	}
	
}
add_action('wp_print_scripts', 'WPDiggThis_ScriptsAction');


function WPDiggThis_HeadAction()
{
	global $plugin_url;
	
	echo '<link rel="stylesheet" href="'.$plugin_url.'/wp-digg-this.css" type="text/css" />'; 
}

add_action('wp_head', 'WPDiggThis_HeadAction' );
?>
