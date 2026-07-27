<?php
/*
Template Name: Resources
*/

get_header();

while (have_posts()) :
    the_post();
    the_content();
endwhile; 

get_template_part('template-parts/resource-listing');

get_template_part('template-parts/global-cta');

get_footer(); ?>