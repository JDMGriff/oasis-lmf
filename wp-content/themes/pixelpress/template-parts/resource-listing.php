<?php
$hasResources = false;
$resourceCategories = get_terms([
    'taxonomy'   => 'resource-category',
    'hide_empty' => true,
]);
$introTitle = get_field('intro_title');
$introCopy = get_field('intro_copy');

$getResourceDestination = static function ($postId) {
    $link = get_field('resource_link', $postId);

    if (is_array($link) && !empty($link['url'])) {
        return [
            'url'    => $link['url'],
            'label'  => $link['title'] ?: 'View resource',
            'target' => $link['target'] ?: '_blank',
        ];
    }

    if (is_string($link) && filter_var($link, FILTER_VALIDATE_URL)) {
        return ['url' => $link, 'label' => 'View resource', 'target' => '_blank'];
    }

    $content = get_post_field('post_content', $postId);
    if ($content && preg_match('/<a\s[^>]*href=["\']([^"\']+)["\'][^>]*>(.*?)<\/a>/is', $content, $match)) {
        return [
            'url'    => html_entity_decode($match[1]),
            'label'  => trim(wp_strip_all_tags($match[2])) ?: 'View resource',
            'target' => '_blank',
        ];
    }

    return null;
};
?>

<section
    class="py-20 bg-[var(--off-white)]"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/dist/images/logomark-corner-top-right.png'); ?>'); background-position: top right; background-repeat: no-repeat;"
>
    <div class="container px-4 mx-auto">
        <h2 class="title-mark uppercase"><?php echo esc_html($introTitle); ?></h2>
        <div class="mt-4 mb-16 max-w-5xl"><?php echo wp_kses_post($introCopy); ?></div>

        <?php if ($resourceCategories && !is_wp_error($resourceCategories)) : ?>
            <?php foreach ($resourceCategories as $resourceCategory) :
                $resources = new WP_Query([
                    'post_type'      => 'resource',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                    'tax_query'      => [[
                        'taxonomy' => 'resource-category',
                        'field'    => 'term_id',
                        'terms'    => $resourceCategory->term_id,
                    ]],
                ]);

                if ($resources->have_posts()) :
                    $hasResources = true;
                    ?>
                    <section class="resource-category mb-14 last:mb-0">
                        <h3 class="resource-category__title"><?php echo esc_html($resourceCategory->name); ?></h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mt-5">
                            <?php while ($resources->have_posts()) :
                                $resources->the_post();
                                $postId = get_the_ID();
                                $destination = $getResourceDestination($postId);
                                $excerpt = get_the_excerpt();
                                ?>
                                <?php if ($destination) : ?>
                                    <a class="resource-card" href="<?php echo esc_url($destination['url']); ?>" target="<?php echo esc_attr($destination['target']); ?>" rel="noopener">
                                <?php else : ?>
                                    <article class="resource-card resource-card--inactive">
                                <?php endif; ?>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'resource-card__image']); ?>
                                    <?php endif; ?>

                                    <span class="resource-card__body">
                                        <span class="resource-card__title"><?php the_title(); ?></span>
                                        <?php if ($excerpt) : ?>
                                            <span class="resource-card__excerpt"><?php echo esc_html(wp_trim_words($excerpt, 18)); ?></span>
                                        <?php endif; ?>
                                        <?php if ($destination) : ?>
                                            <span class="resource-card__action"><?php echo esc_html($destination['label']); ?> <span aria-hidden="true">↗</span></span>
                                        <?php endif; ?>
                                    </span>
                                <?php echo $destination ? '</a>' : '</article>'; ?>
                            <?php endwhile; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!$hasResources) : ?>
            <p>No resources found.</p>
        <?php endif; ?>
    </div>
</section>
