<?php
/**
Plugin Name: Send mail to Author posted
Plugin URI: Localhost
Description: Send mail to Author posted
Version: 1.1
Author: Tran Dai
Author URI: daitran1104@gmail.com
*/
function mailing_list($post_ID)
{
    $list='daitran1104@gmail.com,november_rain1117@yahoo.com';
    mail($list,'MyBlogUpdate','My blog has just been updated: '.get_settings('home'));
}
//gui mail khi co 1 post moi hoac co 1 comment moi
add_action('publish_post','mailing_list');
add_action('comment_post','mailing_list');