<?php get_header(); ?>
<div class="content">
    <?php get_sidebar(); ?>
    <div class="content_index">
       <div class="news">
                <?php
                $args=array('numberposts'=>'2','exclude'=>'ID');
                $recent_posts = wp_get_recent_posts($args);
                if($recent_posts){
                    echo '<ul class="lastest_post">';
                    foreach( $recent_posts as $recent ){
                        echo '<li><a href="' . get_permalink($recent["ID"]).esc_attr($recent["post_title"]).'" >'.$recent["post_title"].'</a></br>';
                        echo '<p class="postdate">';
                        the_time(get_option('date_format'));
                        echo '</p>';
                        echo '<hr style="color: #cfcfcf">';
                        echo the_content().'</li>';
                    }
                    echo'</ul>';
                }
                ?>
           <div class="clear"></div>
       </div>
    <div class="recent_work">
            <p class="titlerw"><a style="text-decoration: none;color: #666666" href="http://enpii-03/wordpress/recent-work/">Recent Work</a></p>
            <div class="prenext">
                <img class="prev" src="<?php bloginfo('template_url'); ?>/images/bulletleft.png">
                <img class="next" src="<?php bloginfo('template_url'); ?>/images/bulletright.png">
            </div>
                <hr style="margin-right:0px; width:835px">
            <ul class="slidermini">
                <li><a href="#" style="display: inline-block; margin-bottom: 10px"><img src="<?php bloginfo('template_url'); ?>/images/Chrysanthemum.jpg"></a><p class="caption">Teachnology</p></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Desert.jpg"></a><p class="caption">Mauris malesuada</p></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Hydrangeas.jpg"></a><p class="caption">Web design</p></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Jellyfish.jpg"></a><p class="caption">Photography</p></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Hydrangeas.jpg"></a><p class="caption">Web design</p></li>
            </ul>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <div class="recent_news">
        <p class="titlerw"><a style="text-decoration: none;color: #666666" href="http://enpii-03/wordpress/recent-news/">Recent News</a></p>
        <hr style="margin-right: 12px;width: 820px;margin-bottom: 6px;margin-top: -8px">
        <?php $navi_query = new WP_Query('posts_per_page=6&orderby=rand'); ?>
        <ul class="ulrecent_news">
        <?php while ($navi_query->have_posts()) : $navi_query->the_post(); ?>

        <li class="thumbnail-post"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(40,40), array ('class' => 'alignleft')); ?></a>
            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; wp_reset_postdata(); ?>
        </ul>
       <a class="viewall" href="#">View All</a>
    </div>

    <div class="clear"></div>
    <div class="onenews">
        <?php $navi_query = new WP_Query('posts_per_page=1'); ?>
        <?php while ($navi_query->have_posts()) : $navi_query->the_post(); ?>
        <div class="title_onenews"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <div class="datecate">
            <div class="postdate"><?php the_date(); ?></div>
            <div class="postincate">Posted In <a style="color: #000000;font-size: 16px;text-transform: uppercase;"><?php
                $category = get_the_category();
                echo $category[0]->cat_name;
                ?></a></div>
        </div>
            <hr style="width: 820px;margin-bottom: 16px">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(160,160), array ('class' => 'alignleft')); ?></a>
            <?php echo the_content(); ?>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<div class="index_footer">
    <?php get_footer(); ?>
</div>