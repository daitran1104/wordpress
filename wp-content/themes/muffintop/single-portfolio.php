<?php
if (have_posts()){
    while (have_posts()):the_post();
        the_title();
        the_content();
    endwhile;
}
else{
    echo "No post found";
}