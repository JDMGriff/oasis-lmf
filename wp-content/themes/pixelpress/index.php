<?php
get_header();
?>

<main>
    <section class="py-20 bg-[var(--off-white)]">
        <div class="container px-4 mx-auto">
            <p class="text-rm text-[var(--brand-red)] font-semibold mb-4">News &amp; Events</p>
            <h1 class="title-mark uppercase"><?php single_cat_title(); ?></h1>

            <?php if (category_description()) : ?>
                <div class="mt-6 max-w-3xl text-lg">
                    <?php echo wp_kses_post(category_description()); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-20">
        <div class="container px-4 mx-auto">
            <?php if (have_posts()) : ?>
                <div class="latest-blogs grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php while (have_posts()) :
                        the_post();
                        ?>
                        <article class="flex flex-col h-full">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                <?php endif; ?>

                                <div class="text-xs text-white bg-[var(--brand-red)] rounded-full px-2 py-1 inline-block mt-4 font-semibold">
                                    <?php echo esc_html(get_the_date('F, Y')); ?>
                                </div>

                                <h2 class="text-xl font-semibold mt-3 mb-2"><?php the_title(); ?></h2>
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

                <nav class="mt-12" aria-label="Category pagination">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => 'Previous',
                        'next_text' => 'Next',
                    ]);
                    ?>
                </nav>
            <?php else : ?>
                <p>No news items were found in this category.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
