<?php
$hasResources = false;

$resourceCategories = get_terms([
    'taxonomy'   => 'resource-category',
    'hide_empty' => true,
]);
// Intro Fields
$introTitle = get_field('intro_title');
$introCopy = get_field('intro_copy');
?>

<section
    class="py-20 bg-[var(--off-white)] "
    style="
        background-image: url('<?php echo get_template_directory_uri() ?>/dist/images/logomark-corner-top-right.png');
        background-position: top right;
        background-size: auto;
        background-repeat: no-repeat;
    "
>
    <div class="container px-4 mx-auto">

        <h2 class="title-mark uppercase">
            <?php echo $introTitle ?>
        </h2>

        <div class="mt-4 mb-20">
            <?php echo $introCopy ?>
        </div>

        <?php if ($resourceCategories && !is_wp_error($resourceCategories)) : ?>

            <?php foreach ($resourceCategories as $resourceCategory) :
                $resources = new WP_Query([
                    'post_type'      => 'resource',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'resource-category',
                            'field'    => 'term_id',
                            'terms'    => $resourceCategory->term_id,
                        ],
                    ],
                ]);

                if ($resources->have_posts()) :
                    $hasResources = true;
                    ?>

                    <div class="mb-12 last:mb-0">
                        <h4 class="text-2xl font-semibold uppercase mb-5">
                            <?php echo esc_html($resourceCategory->name); ?>
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php while ($resources->have_posts()) :
                                $resources->the_post();
                                ?>

                                <article class="flex flex-col">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php
                                            the_post_thumbnail('large', [
                                                'class' => 'w-full aspect-video object-cover rounded-[6px]',
                                            ]);
                                            ?>
                                        <?php endif; ?>

                                        <h5 class="text-lg font-medium mt-3 mb-3">
                                            <?php the_title(); ?>
                                        </h5>
                                    </a>

                                    <a
                                        class="text-sm font-medium text-[var(--brand-red)] mt-auto"
                                        href="<?php the_permalink(); ?>"
                                    >
                                        Read More →
                                    </a>
                                </article>

                            <?php endwhile; ?>
                        </div>
                    </div>

                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            <?php endforeach; ?>

        <?php endif; ?>

        <?php if (!$hasResources) : ?>
            <p>No resources found.</p>
        <?php endif; ?>

    </div>
</section>