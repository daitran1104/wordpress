<?php

if ( function_exists('register_sidebar') )
    register_sidebar();

function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

add_theme_support('post-thumbnails');
/***** Download and Demo button shortcode *****/


function download_buttons ($atts, $content=null) {
    extract(shortcode_atts(array(
        'download_text' => 'Download', // tham số (download_text) và giá trị mặc định (Download); bạn có thể thay đổi tùy ý
        'demo_text' => 'View demo',
        'download_url' => 'http://dl.<a target="_blank" title="dropbox" href="http://goo.gl/lMWLO"></a>.com/u/36995033/File/Read-me.html',
        'demo_url' => 'http://www.<a title="ituplus" href="http://www.ituplus.com"></a>.com'
    ),$atts));
    return "
            <div class='download_wrapper'>
                <ul>
                    <li class='download'>
                        <a href='{$download_url}'>{$download_text}</a>
                    </li>

                    <li class='demo'>
                        <a href='{$demo_url}'>{$demo_text}</a>
                    </li>

                    <div class='clear'>&nbsp;</div>
                </ul>
            </div>
    ";
}
add_shortcode('download','download_buttons');

add_shortcode('addsearch','get_search_form');

function quangcao()
{
    return '<img src="http://cdn.tinhte.vn/attachments/924164/" alt="My ad." />';
}
add_shortcode('qc','quangcao');


/*Custom post type*/
add_action('init','codex_custom_init');
function codex_custom_init()
{
    $label=array(
      'name'=>_x('Wordpress Portfolios Gallery by Tran Dai','post type general name'),
      'singular_name'=>_x('Portfolios','post type singular name'),
      'add_new'=>_x('Add New','portfolio'),
      'add_new_item'=>__('Add New Portfolio'),
      'edit_item'=>__('Edit Portfolio'),
      'new_item'=>__('New Portfolio'),
      'all_items'=>__('All Portfolio'),
      'view_items'=>__('View Portfolio'),
      'search_items'=>__('Search Portfolios'),
      'not_found'=>__('No Portfolios'),
      'not_found_in_trash'=>__('No portfolios fount in Trash'),
      'parent_item_colon'=>'',
      'menu_name'=>'Portfolios By TD'
    );
    $args=array(
        'labels'=>$label,
        'public'=>true,
        'publicly_queryable'=>true,
        'show_ui'=>true,
        'show_in_menu'=>true,
        'query_var'=>true,
        'rewrite'=>true,
        'capability_type'=>'post',
        'has_archive'=>true,
        'hierarchical'=>false,
        'menu_position'=>null,
        'supports'=>array('title','editor','author','comments','custom-field','trackbacks')
    );
    register_post_type('portfolios',$args);
    register_taxonomy_for_object_type('post_tag','portfolios');
    register_taxonomy_for_object_type('category','portfolios');
}





































