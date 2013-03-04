<?php get_header();?>
    <h2>Kết quả tìm kiếm:<br /><small><?php echo $wp_query->found_posts; ?> Kết quả</small></h2>
<?php if (have_posts()) { while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
        <?php the_excerpt(); ?>
    </div>
<?php endwhile; } else { ?>
    <p><?php _e('Không tìm thấy kết quả'); ?></p>
<?php } ?>
<?php get_footer(); ?>