<?php
/**
 * AlpineBot Primary
 * 
 * Holds paramaters and settings specific to this plugin
 * Some universal functions, but mostly unique
 * 
 */
class PhotoTileForFlickrPrimary {  

  /* Set constants for plugin */
  public $url;
  public $dir;
  public $cacheDir;
  public $ver = '1.2.4';
  public $vers = '1-2-4';
  public $domain = 'APTFFbyTAP_domain';
  public $settings = 'alpine-photo-tile-for-flickr-settings'; // All lowercase
  public $name = 'Alpine PhotoTile for Flickr';
  public $info = 'http://thealpinepress.com/alpine-phototile-for-flickr/';
  public $wplink = 'http://wordpress.org/extend/plugins/alpine-photo-tile-for-flickr/';
  public $page = 'AlpineTile: Flickr';
  public $src = 'flickr';
  public $hook = 'APTFFbyTAP_hook';
  public $plugins = array('pinterest','tumblr','instagram','picasa-and-google-plus','smugmug');
  public $termsofservice = "By using this plugin, you are agreeing to the Flickr API <a href='http://www.flickr.com/services/api/tos/' target='_blank'>Terms of Service</a>. This is why the plugin is limited to displaying 30 photos.";

  public $root = 'AlpinePhotoTiles';
  public $wjs = 'AlpinePhotoTiles_script';
  public $wcss = 'AlpinePhotoTiles_style';
  public $wmenujs = 'AlpinePhotoTiles_menu_script';
  public $acss = 'AlpinePhotoTiles_admin_style';
  public $wdesc = 'Add images from Flickr to your sidebar';
//####### DO NOT CHANGE #######//
  public $short = 'alpine-phototile-for-flickr';
  public $id = 'APTFF_by_TAP';
//#############################//
  public $expiryInterval = 360; //1*60*60;  1 hour
  public $cleaningInterval = 1209600; //14*24*60*60;  2 weeks

  function __construct() {
    $this->url = untrailingslashit( plugins_url( '' , dirname(__FILE__) ) );
    $this->dir = untrailingslashit( plugin_dir_path( dirname(__FILE__) ) );
    $this->cacheDir = WP_CONTENT_DIR . '/cache/' . $this->settings;
  }
  
/**
 * Option positions for widget page
 *  
 * @ Since 1.2.0
 * 
 */
  function widget_positions(){
      $options = array(
      'top' => '',
      'left' => 'Flickr Settings',
      'right' => 'Style Settings',
      'bottom' => 'Format Settings'
    );
    return $options;
  }
  
/**
 * Option positions for settings pages
 *  
 * @ Since 1.2.0
 * @ Updated 1.2.3
 */
  function option_positions(){
    $positions = array(
      'generator' => array(
        'left' => array( 'title' => 'Flickr Settings' ),
        'right' => array( 'title' => 'Style Settings' ),
        'bottom' => array( 'title' => 'Format Settings' )
      ),
      'add' => array(
        'center' => array( 'title' => 'Add API Key (See Directions Below)' )
      ),
      'plugin-settings' => array(
        'top' => array( 'title' => 'Global Style Options', 'description' => "Below are style settings that will be applied to every instance of the plugin. " ),
        'center' => array( 'title' => 'Hidden Options', 'description' => "Below are additional options that you can choose to enable by checking the box. <br>Once enabled, the option will appear in the Widget Menu and Shortcode Generator." ),
        'bottom' => array( 'title' => 'Cache Options' )
      )
    );
    return $positions;
  }
/**
 * Plugin Admin Settings Page Tabs
 *  
 * @ Since 1.2.0
 *
 */
  function settings_page_tabs() {
    $tabs = array( 
      'general' => array(
        'name' => 'general',
        'title' => 'General',
      ),
      'add' => array(
        'name' => 'add',
        'title' => 'Add API Key',
      ),
      'generator' => array(
        'name' => 'generator',
        'title' => 'Shortcode Generator',
      ),
      'plugin-settings' => array(
        'name' => 'plugin-settings',
        'title' => 'Plugin Settings',
      )
    );
    return $tabs;
  }
  
/**
 * Option Parameters and Defaults
 *  
 * @ Since 1.0.0
 * @ Updated 1.2.3
 */
  function option_defaults(){
    $options = array(
      'widget_title' => array(
        'name' => 'widget_title',
        'title' => 'Title : ',
        'type' => 'text',
        'description' => '',
        'since' => '1.1',
        'widget' => true,
        'tab' => '',
        'position' => 'top',
        'default' => ''
      ),
      'flickr_source' => array(
        'name' => 'flickr_source',
        'short' => 'src',
        'title' => 'Retrieve Photos From : ',
        'type' => 'select',
        'valid_options' => array(
          'user' => array(
            'name' => 'user',
            'title' => 'User'
          ),
          'favorites' => array(
            'name' => 'favorites',
            'title' => 'Favorites'
          ),
          'group' => array(
            'name' => 'group',
            'title' => 'Group'
          ),
          'set' => array(
            'name' => 'set',
            'title' => 'Set'
          ),
          'community' => array(
            'name' => 'community',
            'title' => 'Community'
          )      
        ),
        'description' => '',
        'parent' => 'AlpinePhotoTiles-parent', 
        'trigger' => 'flickr_source',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'default' => 'user'
      ),
      'flickr_user_id' => array(
        'name' => 'flickr_user_id',
        'short' => 'uid',
        'title' => 'Flickr User ID : ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'description' => "Don't know the ID? Use <a href='http://idgettr.com/' target='_blank'>idgettr.com</a> to find it.",
        'child' => 'flickr_source', 
        'hidden' => 'group community',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',        
        'default' => ''
      ),
      'flickr_group_id' => array(
        'name' => 'flickr_group_id',
        'short' => 'gid',
        'title' => 'Flickr Group ID : ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'description' => "Don't know the ID? Use <a href='http://idgettr.com/' target='_blank'>idgettr.com</a> to find it.",
        'child' => 'flickr_source', 
        'hidden' => 'user set community favorites',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'default' => ''
      ),  
      'flickr_set_id' => array(
        'name' => 'flickr_set_id',
        'short' => 'sid',
        'title' => 'Flickr Set ID : ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'description' => '',
        'child' => 'flickr_source', 
        'hidden' => 'group user community favorites',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'default' => ''
      ), 
      'flickr_tags' => array(
        'name' => 'flickr_tags',
        'short' => 'tags',
        'title' => 'Tag(s) : ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'description' => 'Comma seperated, no spaces',
        'child' => 'flickr_source',
        'hidden' => 'group user favorites set',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'default' => ''
      ),        
      
      'flickr_image_link_option' => array(
        'name' => 'flickr_image_link_option',
        'short' => 'imgl',
        'title' => 'Image Links : ',
        'type' => 'select',
        'valid_options' => array(
          'none' => array(
            'name' => 'none',
            'title' => 'Do not link images'
          ),
          'flickr' => array(
            'name' => 'flickr',
            'title' => 'Link to Flickr Page'
          ),
          'link' => array(
            'name' => 'link',
            'title' => 'Link to URL Address'
          ),
          'fancybox' => array(
            'name' => 'fancybox',
            'title' => 'Use Lightbox'
          )               
        ),
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'parent' => 'AlpinePhotoTiles-parent', 
        'trigger' => 'flickr_image_link_option',
        'default' => 'flickr'
      ),   
      'custom_lightbox_rel' => array(
        'name' => 'custom_lightbox_rel',
        'short' => 'crel',
        'title' => 'Custom Lightbox "rel" (Optional): ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'encode' => array("["=>"{ltsq}","]"=>"{rtsq}"),
        'description' => '',
        'child' => 'flickr_image_link_option', 
        'hidden' => 'none original flickr link',
        'widget' => true,
        'hidden-option' => true,
        'check' => 'hidden_lightbox_custom_rel',
        'tab' => 'generator',
        'position' => 'left',
        'since' => '1.2.3',
        'default' => ''
      ),        
      'custom_link_url' => array(
        'name' => 'custom_link_url',
        'title' => 'Custom Link URL : ',
        'short' => 'curl',
        'type' => 'text',
        'sanitize' => 'url',
        'description' => '',
        'child' => 'flickr_image_link_option', 
        'hidden' => 'none original flickr fancybox',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'since' => '1.2.3',
        'default' => ''
      ),
      'photo_feed_shuffle' => array(
        'name' => 'photo_feed_shuffle',
        'short' => 'shuffle',
        'title' => 'Shuffle/Randomize Photos',
        'type' => 'checkbox',
        'description' => '(API Key Required)',
        'widget' => true,
        'hidden-option' => true,
        'check' => 'hidden_photo_feed_shuffle',
        'tab' => 'generator',
        'position' => 'left',
        'since' => '1.2.4',
        'default' => ''
      ),    
      'flickr_display_link' => array(
        'name' => 'flickr_display_link',
        'short' => 'dl',
        'title' => 'Display link to Flickr page.',
        'type' => 'checkbox',
        'description' => '',
        'child' => 'flickr_source',
        'hidden' => 'community',
        'widget' => true,
        'hidden-option' => true,
        'check' => 'hidden_display_link',
        'tab' => 'generator',
        'position' => 'left',
        'since' => '1.2.3',
        'default' => ''
      ),    
      'flickr_display_link_text' => array(
        'name' => 'flickr_display_link_text',
        'short' => 'dltext',
        'title' => 'Text for display link: ',
        'type' => 'text',
        'sanitize' => 'nohtml',
        'description' => '',
        'child' => 'flickr_source', 
        'hidden' => 'community',
        'widget' => true,
        'hidden-option' => true,
        'check' => 'hidden_display_link',
        'tab' => 'generator',
        'position' => 'left',
        'since' => '1.2.3',
        'default' => 'Flickr'
      ),      

      'style_option' => array(
        'name' => 'style_option',
        'short' => 'style',
        'title' => 'Style : ',
        'type' => 'select',
        'valid_options' => array(
          'vertical' => array(
            'name' => 'vertical',
            'title' => 'Vertical'
          ),
          'windows' => array(
            'name' => 'windows',
            'title' => 'Windows'
          ),
          'bookshelf' => array(
            'name' => 'bookshelf',
            'title' => 'Bookshelf'
          ),
          'rift' => array(
            'name' => 'rift',
            'title' => 'Rift'
          ),
          'floor' => array(
            'name' => 'floor',
            'title' => 'Floor'
          ),
          'wall' => array(
            'name' => 'wall',
            'title' => 'Wall'
          ),
          'cascade' => array(
            'name' => 'cascade',
            'title' => 'Cascade'
          ),
          'gallery' => array(
            'name' => 'gallery',
            'title' => 'Gallery'
          )           
        ),
        'description' => '',
        'parent' => 'AlpinePhotoTiles-parent',
        'trigger' => 'style_option',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => 'vertical'
      ),
      'style_shape' => array(
        'name' => 'style_shape',
        'short' => 'shape',
        'title' => 'Shape : ',
        'type' => 'select',
        'valid_options' => array(
          'rectangle' => array(
            'name' => 'rectangle',
            'title' => 'Rectangle'
          ),
          'square' => array(
            'name' => 'square',
            'title' => 'Square'
          )              
        ),
        'description' => '',
        'child' => 'style_option',
        'hidden' => 'vertical cascade floor wall rift bookshelf gallery',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => 'vertical'
      ),          
      'style_photo_per_row' => array(
        'name' => 'style_photo_per_row',
        'short' => 'row',
        'title' => 'Photos per row : ',
        'type' => 'text',
        'sanitize' => 'int',
        'min' => '1',
        'max' => '30',
        'description' => '',
        'child' => 'style_option',
        'hidden' => 'vertical cascade windows',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => '4'
      ),
      'style_column_number' => array(
        'name' => 'style_column_number',
        'short' => 'col',
        'title' => 'Number of columns : ',
        'type' => 'range',
        'min' => '1',
        'max' => '10',
        'description' => '',
        'child' => 'style_option',
        'hidden' => 'vertical floor wall bookshelf windows rift gallery',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => '2'
      ),     
      'style_gallery_ratio_width' => array(
        'name' => 'style_gallery_ratio_width',
        'short' => 'grwidth',
        'title' => 'Aspect Ratio Width : ',
        'type' => 'text',
        'sanitize' => 'numeric',
        'min' => '1',
        'description' => "",
        'child' => 'style_option',
        'hidden' => 'vertical floor wall bookshelf windows rift cascade',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'since' => '1.2.3',
        'default' => '800'
      ),      
      'style_gallery_ratio_height' => array(
        'name' => 'style_gallery_ratio_height',
        'short' => 'grheight',
        'title' => 'Aspect Ratio Height : ',
        'type' => 'text',
        'sanitize' => 'numeric',
        'min' => '1',
        'description' => "Set the Aspect Ratio of the gallery display. <br>(Default: 800 by 600)",
        'widget' => true,
        'child' => 'style_option',
        'hidden' => 'vertical floor wall bookshelf windows rift cascade',
        'tab' => 'generator',
        'position' => 'right',
        'since' => '1.2.3',
        'default' => '600'
      ),
      'flickr_photo_number' => array(
        'name' => 'flickr_photo_number',
        'short' => 'num',
        'title' => 'Number of photos : ',
        'type' => 'text',
        'sanitize' => 'int',
        'min' => '1',
        'max' => '30',
        'description' => 'Max of 30',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => '4'
      ),
      'photo_feed_offset' => array(
        'name' => 'photo_feed_offset',
        'short' => 'offset',
        'title' => 'Photo Offset: ',
        'type' => 'text',
        'sanitize' => 'int',
        'min' => '1',
        'max' => '500',
        'description' => 'Skip over this many photos. <br>(API Key Required)',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'hidden-option' => true,
        'check' => 'hidden_photo_feed_offset',
        'default' => '0'
      ),
      'flickr_photo_size' => array(
        'name' => 'flickr_photo_size',
        'short' => 'size',
        'title' => 'Photo Size : ',
        'type' => 'select',
        'valid_options' => array(
          '75' => array(
            'name' => 75,
            'title' => '75px'
          ),
          '100' => array(
            'name' => 100,
            'title' => '100px'
          ),
          '240' => array(
            'name' => 240,
            'title' => '240px'
          ),
          '320' => array(
            'name' => 320,
            'title' => '320px'
          ),
          '500' => array(
            'name' => 500,
            'title' => '500px'
          ),
          '640' => array(
            'name' => 640,
            'title' => '640px'
          ),
          '800' => array(
            'name' => 800,
            'title' => '800px'
          )     
        ),
        'description' => 'Some sizes require an API Key',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'left',
        'default' => '240'
      ),
      'style_shadow' => array(
        'name' => 'style_shadow',
        'short' => 'shadow',
        'title' => 'Add slight image shadow.',
        'type' => 'checkbox',
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => ''
      ),   
      'style_border' => array(
        'name' => 'style_border',
        'short' => 'border',
        'title' => 'Add white image border.',
        'type' => 'checkbox',
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => ''
      ),   
      'style_highlight' => array(
        'name' => 'style_highlight',
        'short' => 'highlight',
        'title' => 'Highlight when hovering.',
        'type' => 'checkbox',
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => ''
      ),
      'style_curve_corners' => array(
        'name' => 'style_curve_corners',
        'short' => 'curve',
        'title' => 'Add slight curve to corners.',
        'type' => 'checkbox',
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'right',
        'default' => ''
      ),          
      'widget_alignment' => array(
        'name' => 'widget_alignment',
        'short' => 'align',
        'title' => 'Photo alignment : ',
        'type' => 'select',
        'valid_options' => array(
          'left' => array(
            'name' => 'left',
            'title' => 'Left'
          ),
          'center' => array(
            'name' => 'center',
            'title' => 'Center'
          ),
          'right' => array(
            'name' => 'right',
            'title' => 'Right'
          )            
        ),
        'hidden-option' => true,
        'check' => 'hidden_widget_alignment',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'bottom',
        'since' => '1.2.3',
        'default' => 'center'
      ),    
      'widget_max_width' => array(
        'name' => 'widget_max_width',
        'short' => 'max',
        'title' => 'Maximum widget width : ',
        'type' => 'text',
        'sanitize' => 'numeric',
        'min' => '1',
        'max' => '100',
        'description' => "Percentage (%) between 1 and 100.",
        'widget' => true,
        'tab' => 'generator',
        'position' => 'bottom',
        'default' => '100'
      ),        
      'widget_disable_credit_link' => array(
        'name' => 'widget_disable_credit_link',
        'short' => 'nocredit',
        'title' => 'Disable the tiny "TAP" link in the bottom left corner, though I would appreciate the credit.',
        'type' => 'checkbox',
        'description' => '',
        'widget' => true,
        'tab' => 'generator',
        'position' => 'bottom',
        'default' => ''
      ), 
      'general_disable_right_click' => array(
        'name' => 'general_disable_right_click',
        'title' => 'Disable Right-Click: ',
        'type' => 'checkbox',
        'description' => 'Prevent visitors from right-clicking and downloading images.',
        'since' => '1.2.4',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'default' => ''
      ),
      'general_loader' => array(
        'name' => 'general_loader',
        'title' => 'Disable Loading Icon: ',
        'type' => 'checkbox',
        'description' => 'Remove the icon that appears while images are loading.',
        'since' => '1.2.1',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'default' => ''
      ), 
      'general_highlight_color' => array(
        'name' => 'general_highlight_color',
        'title' => 'Highlight Color:',
        'type' => 'color',
        'description' => 'Click to choose link color.',
        'section' => 'settings',
        'tab' => 'general',
        'since' => '1.2.1',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'default' => '#64a2d8'
      ), 
      'general_lightbox' => array(
        'name' => 'general_lightbox',
        'title' => 'Choose jQuery Lightbox Plugin : ',
        'type' => 'select',
        'valid_options' => array(
          'alpine-fancybox' => array(
            'name' => 'alpine-fancybox',
            'title' => 'Fancybox (Safemode)'
          ),
          'fancybox' => array(
            'name' => 'fancybox',
            'title' => 'Fancybox'
          ),
          'colorbox' => array(
            'name' => 'colorbox',
            'title' => 'ColorBox'
          ),
          'prettyphoto' => array(
            'name' => 'prettyphoto',
            'title' => 'prettyPhoto'
          )      
        ),
        'tab' => 'plugin-settings',
        'position' => 'top',
        'since' => '1.2.3',
        'default' => 'alpine-fancybox'
      ),
      'general_lightbox_no_load' => array(
        'name' => 'general_lightbox_no_load',
        'title' => 'Prevent Lightbox Loading: ',
        'type' => 'checkbox',
        'description' => 'Already using the above lighbox alternative? Prevent this plugin from loading it again.',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'since' => '1.2.3',
        'default' => ''
      ), 
      'general_lightbox_params' => array(
        'name' => 'general_lightbox_params',
        'title' => 'Custom Lightbox Parameters:',
        'type' => 'textarea',
        'sanitize' => 'css',
        'description' => 'Add custom parameters to the lighbox call.',
        'section' => 'settings',
        'tab' => 'general',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'default' => ''
      ), 
      'general_load_header' => array(
        'name' => 'general_load_header',
        'title' => 'Always Load Styles and Scripts in Header: ',
        'type' => 'checkbox',
        'description' => 'For themes without wp_footer(). Requires that styles and scripts be loaded on every page.',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'top',
        'default' => ''
      ), 
      'hidden_display_link' => array(
        'name' => 'hidden_display_link',
        'title' => 'Link Below Widget: ',
        'type' => 'checkbox',
        'description' => 'Place a link with custom text below widget display.',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'center',
        'default' => ''
      ), 
      'hidden_widget_alignment' => array(
        'name' => 'hidden_widget_alignment',
        'title' => 'Photo Alignment: ',
        'type' => 'checkbox',
        'description' => 'Align photos to the left, right, or center.',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'center',
        'default' => true
      ), 
      'hidden_lightbox_custom_rel' => array(
        'name' => 'hidden_lightbox_custom_rel',
        'title' => 'Custom "rel" for Lightbox: ',
        'type' => 'checkbox',
        'description' => 'Set custom "rel" to widget options.',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'center',
        'default' => ''
      ), 
      'hidden_photo_feed_offset' => array(
        'name' => 'hidden_photo_feed_offset',
        'title' => 'Photo Offset: ',
        'type' => 'checkbox',
        'description' => 'Skip over certain number of photos (API Key Required).',
        'since' => '1.2.3',
        'tab' => 'plugin-settings',
        'position' => 'center',
        'default' => ''
      ), 
      'hidden_photo_feed_shuffle' => array(
        'name' => 'hidden_photo_feed_shuffle',
        'title' => 'Photo Shuffle: ',
        'type' => 'checkbox',
        'description' => 'Randomize photos (API Key Required).',
        'since' => '1.2.4',
        'tab' => 'plugin-settings',
        'position' => 'center',
        'default' => ''
      ), 
      'cache_disable' => array(
        'name' => 'cache_disable',
        'title' => 'Disable feed caching: ',
        'type' => 'checkbox',
        'description' => '',
        'since' => '1.1',
        'tab' => 'plugin-settings',
        'position' => 'bottom',
        'default' => ''
      ), 
      'cache_time' => array(
        'name' => 'cache_time',
        'title' => 'Cache time (hours) : ',
        'type' => 'text',
        'sanitize' => 'numeric',
        'min' => '1',
        'description' => "Set the number of hours that a feed will be stored.",
        'since' => '1.1',
        'tab' => 'plugin-settings',
        'position' => 'bottom',
        'default' => '4'
      ), 
      
      'api_key' => array(
        'name' => 'api_key',
        'title' => 'API Key : ',
        'type' => 'text',
        'sanitize' => 'nospaces',
        'description' => '',
        'tab' => 'add',
        'position' => 'center',
        'default' => ''
      ),    
      
    );
    return $options;
  }
  
// END
}

?>
