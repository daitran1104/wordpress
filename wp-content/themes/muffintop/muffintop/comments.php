<?php
/**
 * Created by JetBrains PhpStorm.
 * User: daitran1104
 * Date: 1/28/13
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 */
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) :
endif;
?>
<?php if(!empty($post->post_password)) :
    if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) :
    endif;
endif;
?>