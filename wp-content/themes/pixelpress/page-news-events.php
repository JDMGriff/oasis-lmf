<?php
/*
Template Name: News & Events
*/

get_header();

while (have_posts()) :
    the_post();
    the_content();
endwhile; 

get_template_part('template-parts/news-listing');

get_template_part('template-parts/latest-events');

get_template_part('template-parts/newsletters');

get_template_part('template-parts/global-cta');

get_footer(); ?>
