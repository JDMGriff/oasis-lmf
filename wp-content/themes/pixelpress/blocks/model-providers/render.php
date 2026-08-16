<?php
    $providers = array_key_exists('provider_list', $block['data'] ?? [])
        ? (bool) get_field('provider_list')
        : true;
?>

<section class="py-20 bg-[var(--off-white)]">
    <div class="container mx-aujto px-4">
        <h3 class="title-mark mb-4">
            Oasis Model Providers
        </h3>
        <?php if ($providers === true) :?>
            <?php
                $modelProviders = get_terms([
                    'taxonomy'   => 'model-category',
                    'hide_empty' => false,
                ]);
            ?>

            <?php if (!is_wp_error($modelProviders) && $modelProviders) : ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-10">
                    <?php foreach ($modelProviders as $modelProvider) :
                        $logo = get_field('provider_logo', $modelProvider);
                        $providerUrl = get_term_link($modelProvider);

                        if (is_wp_error($providerUrl)) {
                            continue;
                        }
                        ?>

                        <a
                            class="aspect-square bg-white flex items-center justify-center p-4 sm:p-8"
                            href="<?php echo esc_url($providerUrl); ?>"
                            aria-label="<?php echo esc_attr($modelProvider->name); ?>"
                        >
                            <?php if ($logo) : ?>
                                <img
                                    class="w-full h-full max-h-[100px] object-contain"
                                    src="<?php echo esc_url($logo['url']); ?>"
                                    alt="<?php echo esc_attr($logo['alt'] ?: $modelProvider->name); ?>"
                                >
                            <?php endif; ?>
                        </a>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</section>
