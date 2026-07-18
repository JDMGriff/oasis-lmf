<?php
$conference = get_posts([
    'post_type'      => 'event',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'tax_query'      => [
        [
            'taxonomy' => 'event-category',
            'field'    => 'slug',
            'terms'    => 'conference',
        ],
    ],
]);
// Webinar ACF
$blockTitle = get_field('main_title');
$showLatestEvent = get_field('show_latest_event');
$webinarCta = get_field('webinar_cta');
$showLogomark = get_field('show_logomark');
?>

<section class="latest-events py-20 bg-[var(--off-white)] relative">
    <!-- Logomark -->
    <?php if($showLogomark === true): ?>
        <img class="absolute left-0 top-[-50%]" src="<?php echo get_template_directory_uri(); ?>/dist/images/semi-circle-logomark.svg" alt="Oasis semi circle logomark">
    <?php endif; ?>

    <div data-aos="fade-up" class="container mx-aujto px-4">
        <div class="w-full flex flex-col items-start md:flex-row md:items-center justify-between">
            <h3 class="title-mark mb-4">
                <?php echo $blockTitle ?>
            </h3>

            <a class="text-rm text-[var(--brand-red)] font-semibold mb-6 md:mb-0" href="/events/">
                View all Events 
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <?php if ($showLatestEvent === true) : ?>
                <?php if ($conference) : ?>
                    <?php
                        global $post;

                        $post = $conference[0];
                        setup_postdata($post);
                        // ACF fields for latest post
                        $eventId       = $conference[0]->ID;
                        $eventDate     = get_field('event_date', $eventId);
                        $eventLocation = get_field('event_location', $eventId);
                    ?>
                    <article class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 bg-white rounded-[4px]">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full', [
                                    'class' => 'w-full h-full object-cover rounded-[4px_0_0_4px]',
                                ]); ?>
                            </a>
                        <?php endif; ?>

                        <div class="p-10 flex flex-col justify-center">
                            <div class="text-sm text-white bg-[var(--brand-red)] rounded-full px-4 py-1 inline-block w-max mb-4 font-semibold">
                                <?php echo $eventDate ?>
                            </div>
                            <h4 class="text-xl font-semibold mb-3 uppercase">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <div class="mb-4 flex items-center">
                                <svg class="mr-2" id="Icon" xmlns="http://www.w3.org/2000/svg" width="14.108" height="17.333" viewBox="0 0 14.108 17.333">
                                <path id="Path_38" data-name="Path 38" d="M10.692,1.25a5.473,5.473,0,0,0-5.442,5.5,8.442,8.442,0,0,0,1.112,3.578,35.014,35.014,0,0,0,3.87,5.626.6.6,0,0,0,.917,0,35.014,35.014,0,0,0,3.87-5.626,8.442,8.442,0,0,0,1.112-3.578,5.473,5.473,0,0,0-5.442-5.5Zm0,1.209a4.263,4.263,0,0,1,4.232,4.29,9.331,9.331,0,0,1-1.616,4.157,35.461,35.461,0,0,1-2.617,3.7,35.461,35.461,0,0,1-2.617-3.7A9.331,9.331,0,0,1,6.459,6.749a4.263,4.263,0,0,1,4.232-4.29Z" transform="translate(-3.638 -1.25)" fill="#d9272d" fill-rule="evenodd"/>
                                <path id="Path_39" data-name="Path 39" d="M11.467,5.25a2.217,2.217,0,1,0,2.217,2.217A2.218,2.218,0,0,0,11.467,5.25Zm0,1.209a1.008,1.008,0,1,1-1.008,1.008A1.008,1.008,0,0,1,11.467,6.459Z" transform="translate(-4.413 -2.025)" fill="#d9272d" fill-rule="evenodd"/>
                                <path id="Path_40" data-name="Path 40" d="M14.16,17.092a5,5,0,0,1,1.569.726c.242.184.419.364.419.583a.57.57,0,0,1-.177.363,2.527,2.527,0,0,1-.739.527,11.518,11.518,0,0,1-4.929.924,11.518,11.518,0,0,1-4.929-.924,2.527,2.527,0,0,1-.739-.527.57.57,0,0,1-.177-.363c0-.219.177-.4.419-.583a5,5,0,0,1,1.569-.726A.6.6,0,0,0,6.1,15.934,5.544,5.544,0,0,0,3.859,17.1a1.81,1.81,0,0,0-.609,1.3A2.025,2.025,0,0,0,4.221,20,11.3,11.3,0,0,0,10.3,21.424,11.3,11.3,0,0,0,16.387,20a2.025,2.025,0,0,0,.971-1.6,1.81,1.81,0,0,0-.609-1.3,5.544,5.544,0,0,0-2.239-1.168.6.6,0,0,0-.348,1.158Z" transform="translate(-3.25 -4.091)" fill="#d9272d" fill-rule="evenodd"/>
                                </svg>

                                <?php echo $eventLocation ?>
                            </div>

                            <p class="mb-4">
                                <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                            </p>

                            <a class="text-rm text-[var(--brand-red)] font-semibold" href="<?php the_permalink(); ?>">
                                Register now
                            </a>
                        </div>
                    </article>

                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endif; ?>

            <article>
                <?php if($webinarCta['image']): ?>
                    <img class="w-full rounded-[4px]" src="<?php echo $webinarCta['image']['url'] ?>" alt="Oasis Webinar">
                <?php endif; ?>

                <h4 class="text-xl font-semibold mt-4 mb-2">
                    <a href="<?php echo $webinarCta['link'] ?>">
                        <?php echo $webinarCta['title'] ?>
                    </a>
                </h4>

                <p class="mb-4">
                    <?php echo $webinarCta['copy'] ?>
                </p>

                <a class="text-rm text-[var(--brand-red)] font-semibold" href="<?php echo $webinarCta['link'] ?>">
                    View webinar
                </a>
            </article>
        </div>        
    </div>
</section>
