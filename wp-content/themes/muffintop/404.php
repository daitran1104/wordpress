<?php
/**
 * Created by JetBrains PhpStorm.
 * User: daitran1104
 * Date: 1/28/13
 * Time: 9:59 AM
 * To change this template use File | Settings | File Templates.
 */
get_header(); ?>

	<div id="primary" class="site-content">
        <div id="content" role="main">

            <article id="post-0" class="post error404 no-results not-found">
                <header class="entry-header">
                    <h1 class="entry-title"><?php echo( 'This is somewhat embarrassing, isn&rsquo;t it?' ); ?></h1>
                </header>

                <div class="entry-content">
                    <p><?php echo( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.'); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>