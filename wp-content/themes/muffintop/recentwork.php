<?php
/*
Template Name: Recent-work
*/
get_header();
?>
<?php query_posts( array( 'post_type' => 'post', 'paged' => get_query_var( 'paged' ),'posts_per_page'=>10 ) );?>
<div class="content" xmlns="http://www.w3.org/1999/html">
    <?php get_sidebar(); ?>
    <div class="main_content">
        <div class="navigation">
            <?php echo wp_pagenavi( array( 'echo' => false ) ); ?>
        </div>
        <div class="namepage">
            <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress">Home > </a>
            <a style="color: #000000;font-size: 26px" href="http://enpii-03/wordpress/recent-work">Recent Works</a>

            <hr style="margin-top: 14px">
        </div>
        <div class="recentwork">
            <ul>
                <?php while ( have_posts() ) : the_post(); ?>
                <li class="imagerecentwork"><?php the_post_thumbnail(array(160,160), array ('class' => 'alignleft')); ?></li>
                <?php endwhile?>
            </ul>
        </div>
    </div>
</div>
<?php get_footer(); ?>