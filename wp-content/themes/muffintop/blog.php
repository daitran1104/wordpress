<?php
/*
Template Name: blog
*/
?>
<?php get_header(); ?>
<?php query_posts( array( 'post_type' => 'post', 'paged' => get_query_var( 'paged' ) ) );?>
<div class="content" xmlns="http://www.w3.org/1999/html">
    <?php get_sidebar(); ?>
    <div class="main_content">
        <div class="navigation">
                <?php echo wp_pagenavi( array( 'echo' => false ) ); ?>
        </div>
        <div class="namepage">
            <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress">Home > </a>
            <a style="color: #000000;font-size: 26px" href="http://enpii-03/wordpress/blog">Blog</a>

            <hr style="margin-top: 14px">
        </div>
        <div class="newsblog">
            <ul>
                <?php while ( have_posts() ) : the_post(); ?>
                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                <li class="blognewsdate"><div>Post In <p style="color: #000000;text-transform: uppercase;font-size: 16px;display: inline"><?php $postid=get_the_ID();$catename=get_the_category($postid);echo $catename[0]->cat_name; ?></p></div></li>
                <li class="blognewsdate1"><?php the_time(get_option('date_format'));?></li>
                <hr style="margin-bottom: -8px;width: 100%;margin-top: -10px;">
                <li><?php the_post_thumbnail(array(160,160), array ('class' => 'alignleft')); ?></li>
                <li><?php the_excerpt("Readmore"); ?><p class="morelink"><a href="<?php the_permalink();?>"><?php _e('Read More');?></a></p></li>
                <?php endwhile?>
            </ul>
        </div>
    </div>
</div>
<div class="index_footer">
<?php get_footer(); ?>
</div>