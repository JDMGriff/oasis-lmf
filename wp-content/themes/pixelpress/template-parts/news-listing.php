<?php
// Intro Fields
$introTitle = get_field('intro_title');
$introCopy = get_field('intro_copy');
?>

<section id="news" class="py-20">
    <div class="container px-4 mx-auto">

        <h2 class="title-mark uppercase">
            Community News
        </h2>

        <!-- Blog loop -->
        <?php
        $latestBlogs = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 8,
            'post_status'    => 'publish',
            'paged'          => 1,
        ]);
        ?>

        <?php if($latestBlogs->have_posts()): ?>
            <div id="news-listing-grid" class="latest-blogs grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
                <?php while($latestBlogs->have_posts()):
                    $latestBlogs->the_post();
                ?>
                    <article class="flex flex-col h-full">
                        <a href="<?php the_permalink(); ?>">
                            <?php if(has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php endif; ?>

                            <div class="text-xs text-white bg-[var(--brand-red)] rounded-full px-2 py-1 inline-block mt-4 font-semibold">
                                <?php echo get_the_date('F, Y'); ?>
                            </div>

                            <h5 class="text-xl font-semibold mt-3 mb-2"><?php the_title(); ?></h5>
                        </a>

                        <p class="mb-4">
                            <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>

                        <a class="latest-blogs-rm mt-auto font-medium inline-block w-max pb-1 border-b border-[var(--brand-red)]" href="<?php the_permalink(); ?>">
                            Read More
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php if($latestBlogs->max_num_pages > 1): ?>
                <div class="text-center mt-12">
                    <button id="load-more-news" class="bg-[var(--brand-red)] text-white font-semibold rounded-[4px] px-12 py-3 transition-opacity duration-200 hover:opacity-85" type="button" data-page="1">
                        Load More
                    </button>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

    </div>
</section>
