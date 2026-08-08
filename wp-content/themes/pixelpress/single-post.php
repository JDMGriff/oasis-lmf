<?php get_header(); ?>

<?php while(have_posts()):
    the_post();

    $categories = get_the_category();
    $previousPost = get_previous_post();
    $nextPost = get_next_post();
?>
    <main>
        <header class="bg-[var(--off-white)] py-16 lg:py-24">
            <div class="container mx-auto px-4">
                <div class="w-full max-w-[960px] mx-auto">
                    <a class="text-rm inline-block text-[var(--brand-red)] font-semibold mb-8" href="/news-events/">
                        Back to news
                    </a>

                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        <span class="text-sm text-white bg-[var(--brand-red)] rounded-full px-3 py-1 font-semibold">
                            <?php echo get_the_date('F, Y'); ?>
                        </span>

                        <?php if($categories): ?>
                            <span class="text-sm font-semibold uppercase">
                                <?php echo $categories[0]->name; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <h1 class="text-[clamp(40px,6vw,72px)] leading-[1.05] font-bold">
                        <?php the_title(); ?>
                    </h1>

                    <?php if(has_excerpt()): ?>
                        <p class="text-xl lg:text-2xl leading-relaxed text-[var(--off-black-light)] mt-6 max-w-[820px]">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <?php if(has_post_thumbnail()): ?>
            <div class="container mx-auto px-4 -mt-8 lg:-mt-12 relative">
                <div class="w-full max-w-[1160px] mx-auto overflow-hidden rounded-[6px]">
                    <?php the_post_thumbnail('full', [
                        'class' => 'w-full max-h-[650px] object-cover',
                    ]); ?>
                </div>
            </div>
        <?php endif; ?>

        <article class="py-16 lg:py-24">
            <div class="single-post-content w-full max-w-[832px] mx-auto px-4">
                <?php the_content(); ?>
            </div>
        </article>

        <?php if($previousPost || $nextPost): ?>
            <nav class="border-t border-black/10 py-12 lg:py-16" aria-label="More news">
                <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if($previousPost): ?>
                        <a class="group bg-[var(--off-white)] rounded-[6px] p-6 lg:p-8" href="<?php echo get_permalink($previousPost); ?>">
                            <span class="block text-sm text-[var(--brand-red)] font-semibold mb-3">Previous article</span>
                            <span class="block text-xl font-semibold group-hover:text-[var(--brand-red)] transition-colors duration-200">
                                <?php echo get_the_title($previousPost); ?>
                            </span>
                        </a>
                    <?php endif; ?>

                    <?php if($nextPost): ?>
                        <a class="group bg-[var(--off-white)] rounded-[6px] p-6 lg:p-8 md:text-right <?php echo !$previousPost ? 'md:col-start-2' : ''; ?>" href="<?php echo get_permalink($nextPost); ?>">
                            <span class="block text-sm text-[var(--brand-red)] font-semibold mb-3">Next article</span>
                            <span class="block text-xl font-semibold group-hover:text-[var(--brand-red)] transition-colors duration-200">
                                <?php echo get_the_title($nextPost); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif; ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
