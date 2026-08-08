<?php get_header(); ?>

<?php while(have_posts()):
    the_post();

    $eventDate = get_field('event_date');
    $eventLocation = get_field('event_location');
    $eventCategories = get_the_terms(get_the_ID(), 'event-category');
    $previousEvent = get_previous_post();
    $nextEvent = get_next_post();
?>
    <main>
        <header class="bg-[var(--off-white)] py-16 lg:py-24">
            <div class="container mx-auto px-4">
                <div class="w-full max-w-[960px] mx-auto">
                    <a class="text-rm inline-block text-[var(--brand-red)] font-semibold mb-8" href="/news-events/">
                        Back to events
                    </a>

                    <?php if($eventCategories && !is_wp_error($eventCategories)): ?>
                        <p class="text-sm text-[var(--brand-red)] font-semibold uppercase mb-4">
                            <?php echo $eventCategories[0]->name; ?>
                        </p>
                    <?php endif; ?>

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

        <section class="py-16 lg:py-24">
            <div class="container mx-auto px-4">
                <div class="w-full max-w-[1160px] mx-auto grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_320px] gap-10 lg:gap-16">
                    <article class="single-post-content min-w-0">
                        <?php the_content(); ?>
                    </article>

                    <?php if($eventDate || $eventLocation): ?>
                        <aside>
                            <div class="bg-[var(--off-white)] rounded-[6px] p-6 lg:p-8 lg:sticky lg:top-8">
                                <h2 class="text-2xl font-semibold mb-6">Event details</h2>

                                <?php if($eventDate): ?>
                                    <div class="border-t border-black/10 pt-5 mb-5">
                                        <span class="block text-sm text-[var(--brand-red)] font-semibold uppercase mb-1">Date</span>
                                        <span class="font-semibold"><?php echo $eventDate; ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($eventLocation): ?>
                                    <div class="border-t border-black/10 pt-5">
                                        <span class="block text-sm text-[var(--brand-red)] font-semibold uppercase mb-1">Location</span>
                                        <span class="font-semibold"><?php echo $eventLocation; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php if($previousEvent || $nextEvent): ?>
            <nav class="border-t border-black/10 py-12 lg:py-16" aria-label="More events">
                <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if($previousEvent): ?>
                        <a class="group bg-[var(--off-white)] rounded-[6px] p-6 lg:p-8" href="<?php echo get_permalink($previousEvent); ?>">
                            <span class="block text-sm text-[var(--brand-red)] font-semibold mb-3">Previous event</span>
                            <span class="block text-xl font-semibold group-hover:text-[var(--brand-red)] transition-colors duration-200">
                                <?php echo get_the_title($previousEvent); ?>
                            </span>
                        </a>
                    <?php endif; ?>

                    <?php if($nextEvent): ?>
                        <a class="group bg-[var(--off-white)] rounded-[6px] p-6 lg:p-8 md:text-right <?php echo !$previousEvent ? 'md:col-start-2' : ''; ?>" href="<?php echo get_permalink($nextEvent); ?>">
                            <span class="block text-sm text-[var(--brand-red)] font-semibold mb-3">Next event</span>
                            <span class="block text-xl font-semibold group-hover:text-[var(--brand-red)] transition-colors duration-200">
                                <?php echo get_the_title($nextEvent); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif; ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
