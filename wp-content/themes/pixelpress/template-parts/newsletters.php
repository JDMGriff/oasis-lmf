<?php
$newsletters = new WP_Query([
    'post_type'      => 'newsletter',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

$title = get_field('newsletter_title');
$copy = get_field('newsletter_copy');
$subscribeCta = get_field('newsletter_cta');
?>

<?php if($newsletters->have_posts()): ?>
    <section id="newsletters" class="py-20 bg-[var(--off-white)]">
        <div class="container mx-auto px-4">
            <div class="w-full lg:max-w-[60%]">
                <h3 class="title-mark mb-4">
                    <?php echo $title ?>
                </h3>

                <div class="newsletters-intro mb-4">
                    <?php echo $copy ?>
                </div>

                <a class="primary-cta mb-10" href="<?php echo $subscribeCta['url'] ?>">
                    <?php echo $subscribeCta['title'] ?>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while($newsletters->have_posts()):
                    $newsletters->the_post();
                    $newsletterUpload = get_field('newsletter_upload');
                ?>
                    <?php if($newsletterUpload): ?>
                        <a class="group flex items-center gap-5 bg-white rounded-[4px] p-6 transition-all duration-200 hover:-translate-y-1 hover:shadow-md" href="<?php echo $newsletterUpload['url']; ?>" download="<?php echo $newsletterUpload['filename']; ?>">
                            <img class="w-6 h-6" src="<?php echo get_template_directory_uri(); ?>/dist/images/newsletter-icon.svg" alt="">

                            <h5 class="text-lg font-semibold">
                                <?php the_title(); ?>
                            </h5>

                            <span class="ml-auto text-[var(--brand-red)] transition-transform duration-200 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>
