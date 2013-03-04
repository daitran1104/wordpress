<?php get_header(); ?>
<div class="content">
    <?php get_sidebar(); ?>
    <div class="content_index">
       <div class="news">
                <?php
                $args=array('numberposts'=>'2');
                $recent_posts = wp_get_recent_posts($args);
                if($recent_posts){
                    echo '<ul class="lastest_post">';
                    foreach( $recent_posts as $recent ){
                        echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></br>';
                        echo '<p class="postdate">'.$recent["post_date"].'</p>';
                        echo '<hr style="color: #cfcfcf">';
                        echo the_content().'</li>';
                    }
                    echo'</ul>';
                }
                ?>
       </div>

        <div class="recent_work">
            <p>Recent Work</p>
            <div>
                <span class="prev">Prev</span>
                <span class="next">Next</span>
            </div>
            <hr>
            <ul class="slidermini">
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Chrysanthemum.jpg"></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Desert.jpg"></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Hydrangeas.jpg"></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Jellyfish.jpg"></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/Hydrangeas.jpg"></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="index_footer">
    <?php get_footer(); ?>
</div>