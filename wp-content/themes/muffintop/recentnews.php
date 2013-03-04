<?php
/*
Template Name: Recent-news
*/
?>
<?php get_header(); ?>
<?php query_posts( array( 'post_type' => 'post', 'paged' => get_query_var( 'paged' ),'posts_per_page'=>9 ) );?>
<div class="content" xmlns="http://www.w3.org/1999/html">
    <?php get_sidebar(); ?>
    <div class="main_content">
        <div class="navigation">
            <?php echo wp_pagenavi( array( 'echo' => false ) ); ?>
        </div>
        <div class="namepage">
            <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress">Home > </a>
            <a style="color: #000000;font-size: 26px" href="http://enpii-03/wordpress/recent-news">Recent News</a>
            <hr style="margin-top: 14px">
        </div>
        <div class="newsrecent">
            <?php while ( have_posts() ) : the_post(); ?>
            <ul>
                <li><?php the_post_thumbnail(array(160,160), array ('class' => 'alignleft')); ?><a style="color: #000000;font-size: 16px" href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                <li><?php the_excerpt("Readmore"); ?></li>
            </ul>
            <?php endwhile?>
        </div>
    </div>
</div>
<?php get_footer(); ?>