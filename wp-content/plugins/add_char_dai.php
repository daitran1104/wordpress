<?php
/**
Plugin Name: add Dai into title
Plugin URI: Localhost
Description: Send mail to Author posted
Version: 1.1
Author: Tran Dai
Author URI: daitran1104@gmail.com
 */
add_filter('the_title', 'new_title');
function new_title($title) {
        $title = $title." .Đại";
    return $title;
}