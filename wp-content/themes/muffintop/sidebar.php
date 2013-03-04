<script type="text/javascript">
    var b_txt = '';

    // write the badge



    b_txt += '<span style="position:absolute;left:-999em;top:-999em;visibility:hidden" class="flickr_badge_beacon"><img src="http://geo.yahoo.com/p?s=792600102&t=22353eeb1e2a1646ed87d480a7a9e62d&r=http%3A%2F%2Fzourbuth.com%2Farchives%2F500%2Fflickr-badge-widget%2F&fl_ev=0&lang=en&intl=us" width="0" height="0" alt="" /></span>';

    document.write(b_txt);
</script>

    <div id="sidebar">

    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ): ?>

    <?php endif; ?>

               <?php

               if(is_active_sidebar('right-widget-area')): ?>

                   <div id="right_widget_area" class="widget-area">
                       <ul class="right_widget">
                           <?php dynamic_sidebar('right-widget-area'); ?>
                       </ul>
                   </div>
                   <?php endif; ?>

    </div>
