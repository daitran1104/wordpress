<?php

get_header();
?>
<div class="content" xmlns="http://www.w3.org/1999/html">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=412787725470762";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <?php get_sidebar(); ?>
    <div class="main_content">

            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="namepage">
                    <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress">Home > </a>
                    <a style="color: #666666;font-size: 26px" href="http://enpii-03/wordpress/blog">Blog ></a>
                    <a style="color: #000000;font-size: 26px" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <hr style="margin-top: 14px">
            </div>
             <div class="contentsingle">
                    <?php the_content(); ?>

                    <div class="categories">Posted in: <?php the_category(', ') ?></div>
                    <div class="fb-comments" data-href="http://example.com" data-width="700" data-num-posts="2"></div>
                <?php endwhile; ?>

            <?php else : ?>
            <h2 class="center">Not Found</h2>
            <p class="center">Sorry, but you are looking for something that isn't here.</p>
            <?php get_search_form(); ?>
            <?php endif; ?>
            <div class="otherwork">
                <?php
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                    $args=array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post->ID),
                        'showposts'=>5, // Số bài viết muốn hiển thị.
                        'caller_get_posts'=>1
                    );
                    $my_query = new wp_query($args);
                    if( $my_query->have_posts() ) {
                        echo '<h3 style="color: #000000;font-size: 22px">Other Work</h3><ul>';
                        echo '<hr>';
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                            ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span>  (<?php the_time(get_option('date_format'));?>)</span></li>
                            <?php
                        }
                        echo '</ul>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="socialshare">
            <div class="datepost_detail">
                <?php the_date('j','<span>','</span>',true);?>
                <?php the_time('F,Y'); ?>
            </div>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_floating_style addthis_counter_style" style="left:50px;top:50px;">
                <a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
                <a class="addthis_button_tweet" tw:count="vertical"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
                <a class="addthis_counter"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5130891f08cb510d"></script>
            <!-- AddThis Button END -->
        </div>


    </div>
</div>
<div class="index_footer">
    <?php get_footer(); ?>
</div>