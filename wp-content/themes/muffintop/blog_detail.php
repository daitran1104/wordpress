<?php
/*
Template Name: Blog detail
*/
get_header();
?>
<div class="content" xmlns="http://www.w3.org/1999/html">
    <?php get_sidebar(); ?>
    <div class="main_content">
        <div class="namepage">
            <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress">Home > </a>
            <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress/blog">Blog ></a>

            <hr style="margin-top: 14px">
        </div>
        <?php
        /* the_post will retrieve the content of the new page you
        *  create to list the posts, e.g. as an intro to describe
        *  which posts are shown.
        */
            the_post();

            // Display content of page
            get_template_part( 'content', get_post_format() );
            wp_reset_postdata();
        ?>
    </div>
</div>
<div class="index_footer">
    <?php get_footer(); ?>
</div>