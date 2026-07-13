<?php
    $title = get_field('title');
    $showLatestBlogs = get_field('show_latest_blogs');
?>
<?php if($showLatestBlogs === true): ?>
<section class="latest-blogs py-20 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <h3 class="title-mark mb-4">
            <?php echo $title ?>
        </h3>
        <!-- Blog Loop -->
        <?php
        $latest_posts = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
        ]);

        if ($latest_posts->have_posts()) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php while ($latest_posts->have_posts()) :
                    $latest_posts->the_post();
                    ?>
                    
                    <article class="flex flex-col h-full">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php endif; ?>

                            <div class="text-xs text-white bg-[var(--brand-red)] rounded-full px-2 py-1 inline-block mt-4">
                                <?php echo esc_html(get_the_date('F, Y')); ?>
                            </div>

                            <h5 class="text-xl font-semibold mt-3 mb-2"><?php the_title(); ?></h5>
                        </a>

                        <p class="mb-4">
                            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 25, '...')); ?>
                        </p>

                        <a class="latest-blogs-rm mt-auto font-medium inline-block w-max pb-1 border-b border-[var(--brand-red)]" href="<?php the_permalink(); ?>">
                            Read More
                        </a>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php wp_reset_postdata();
        endif;
        ?>        
    </div>
</section>
<?php endif; ?>