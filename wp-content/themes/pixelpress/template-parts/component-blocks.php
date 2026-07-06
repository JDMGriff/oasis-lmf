<?php
if (have_rows('componenet_blocks')): ?>
    <?php while (have_rows('componenet_blocks')): the_row();
        $layout = get_row_layout();

        switch ($layout) {

            case 'hero:_text_left_image_right':
                $data = [
                    'sub_heading' => get_sub_field('sub_heading'),                    
                    'heading' => get_sub_field('heading'),
                    'copy' => get_sub_field('copy'),
                    'button' => get_sub_field('button'),
                    'show_available_spots' => get_sub_field('show_available_spots'),
                    'image_or_animation' => get_sub_field('image_or_animation'),
                    'image' => get_sub_field('image'),
                    'animation' => get_sub_field('animation'),
                    'logo_grid_or_carousel' => get_sub_field('logo_grid_or_carousel'),
                    'industry_clients' => get_sub_field('industry_clients'),
                ];
                get_template_part('template-parts/content-block/hero-text-left-image-right', null, $data);
                break;

        }
    endwhile; ?>
<?php endif; ?>
