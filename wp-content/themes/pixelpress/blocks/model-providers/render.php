<?php
    $providers = array_key_exists('provider_list', $block['data'] ?? [])
        ? (bool) get_field('provider_list')
        : true;
?>

<section class="py-20 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
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
                <?php
                $providerCards = [];
                $allPerils = [];
                $normalisePerils = static function ($perilName) {
                    $value = strtolower(trim((string) $perilName));
                    $groups = [];
                    $add = static function ($label) use (&$groups) {
                        $groups[strtolower($label)] = $label;
                    };

                    if (str_contains($value, 'earthquake') || str_contains($value, 'eathquake') || str_contains($value, 'subsidence')) {
                        $add('Earthquake');
                    }
                    if (str_contains($value, 'flood') || str_contains($value, 'river') || str_contains($value, 'surface water') || str_contains($value, 'pluvial')) {
                        $add('Flood');
                    }
                    if (str_contains($value, 'wildfire') || str_contains($value, 'bushfire')) {
                        $add('Wildfire');
                    }
                    if (str_contains($value, 'tropical') || str_contains($value, 'cyclone') || str_contains($value, 'hurricane')) {
                        $add('Tropical Cyclone');
                    }
                    if (str_contains($value, 'windstorm') || str_contains($value, 'low pressure') || str_contains($value, 'offshore wind') || $value === 'wind and flood') {
                        $add('Windstorm');
                    }
                    if (str_contains($value, 'tsunami')) {
                        $add('Tsunami');
                    }
                    if (str_contains($value, 'landslide')) {
                        $add('Landslide');
                    }
                    if (str_contains($value, 'hail') || str_contains($value, 'convective') || $value === 'scs') {
                        $add('Severe Storm');
                    }
                    if (str_contains($value, 'cyber')) {
                        $add('Cyber');
                    }
                    if (str_contains($value, 'terror')) {
                        $add('Terrorism');
                    }
                    if (str_contains($value, 'crop')) {
                        $add('Crop');
                    }
                    if (str_contains($value, 'freeze')) {
                        $add('Freeze');
                    }

                    return $groups;
                };
                $modelTaxonomy = get_taxonomy('model-category');
                $modelPostType = $modelTaxonomy && !empty($modelTaxonomy->object_type)
                    ? reset($modelTaxonomy->object_type)
                    : 'model';

                foreach ($modelProviders as $modelProvider) {
                    $modelIds = get_posts([
                        'post_type'      => $modelPostType,
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                        'tax_query'      => [[
                            'taxonomy' => 'model-category',
                            'field'    => 'term_id',
                            'terms'    => $modelProvider->term_id,
                        ]],
                    ]);
                    $providerPerils = [];
                    $providerSearchPerils = [];
                    $modelTitles = [];

                    foreach ($modelIds as $modelId) {
                        $modelTitles[] = get_the_title($modelId);
                        $perilRows = get_field('perils', $modelId);

                        if (!is_array($perilRows)) {
                            continue;
                        }

                        foreach ($perilRows as $perilRow) {
                            $perilName = trim((string) ($perilRow['peril'] ?? ''));
                            if ($perilName !== '') {
                                $providerSearchPerils[] = $perilName;
                                foreach ($normalisePerils($perilName) as $perilKey => $perilLabel) {
                                    $providerPerils[$perilKey] = $perilLabel;
                                    $allPerils[$perilKey] = $perilLabel;
                                }
                            }
                        }
                    }

                    $providerCards[] = [
                        'term'         => $modelProvider,
                        'perils'       => array_values($providerPerils),
                        'search_perils' => $providerSearchPerils,
                        'model_titles' => $modelTitles,
                    ];
                }

                natcasesort($allPerils);
                ?>

                <div class="model-filter mt-10" data-model-filter>
                    <label class="sr-only" for="model-provider-search">Search model providers and perils</label>
                    <input class="model-filter__search" id="model-provider-search" type="search" placeholder="Search models, providers or perils…" data-model-search>

                    <?php if ($allPerils) : ?>
                        <div class="model-filter__label">Filter by peril</div>
                        <div class="model-filter__pills" aria-label="Filter by peril">
                            <button class="model-filter__pill is-active" type="button" data-peril="" aria-pressed="true">All</button>
                            <?php foreach ($allPerils as $peril) : ?>
                                <button class="model-filter__pill" type="button" data-peril="<?php echo esc_attr(strtolower($peril)); ?>" aria-pressed="false">
                                    <?php echo esc_html($peril); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="logo-card-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mt-8" data-model-results>
                    <?php foreach ($providerCards as $providerCard) :
                        $modelProvider = $providerCard['term'];
                        $logo = get_field('provider_logo', $modelProvider);
                        $providerUrl = get_term_link($modelProvider);

                        if (is_wp_error($providerUrl)) {
                            continue;
                        }
                        ?>

                        <a
                            class="logo-card"
                            href="<?php echo esc_url($providerUrl); ?>"
                            aria-label="<?php echo esc_attr($modelProvider->name); ?>"
                            data-model-card
                            data-search="<?php echo esc_attr(strtolower(implode(' ', array_merge([$modelProvider->name], $providerCard['model_titles'], $providerCard['search_perils'])))); ?>"
                            data-perils="<?php echo esc_attr(strtolower(implode('|', $providerCard['perils']))); ?>"
                        >
                            <span class="logo-card__image">
                                <?php if ($logo) : ?>
                                    <img class="w-full h-full max-h-[82px] object-contain" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: $modelProvider->name); ?>">
                                <?php endif; ?>
                            </span>
                            <span class="logo-card__name"><?php echo esc_html($modelProvider->name); ?></span>
                        </a>

                    <?php endforeach; ?>
                </div>
                <p class="model-filter__empty mt-8" data-model-empty hidden>No providers match those filters.</p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</section>
