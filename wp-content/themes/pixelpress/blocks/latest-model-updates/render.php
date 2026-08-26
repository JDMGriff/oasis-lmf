<?php
$modelLibrary = get_field('model_library');
$latestUpdates = get_field('latest_updates');

$getModelFallbackImage = static function ($perils) {
    $perilNames = array_column($perils ?: [], 'peril');
    $peril = strtolower(implode(' ', $perilNames));
    $image = 'severe-storm.jpg';

    if (str_contains($peril, 'tsunami')) {
        $image = 'tsunami-coastal.jpg';
    } elseif (str_contains($peril, 'earthquake') || str_contains($peril, 'eathquake') || str_contains($peril, 'subsidence') || str_contains($peril, 'landslide')) {
        $image = 'earthquake.jpg';
    } elseif (str_contains($peril, 'flood') || str_contains($peril, 'river') || str_contains($peril, 'surface water')) {
        $image = 'flood.jpg';
    } elseif (str_contains($peril, 'wildfire') || str_contains($peril, 'bushfire')) {
        $image = 'wildfire.jpg';
    } elseif (str_contains($peril, 'tropical') || str_contains($peril, 'cyclone') || str_contains($peril, 'hurricane')) {
        $image = 'tropical-cyclone.jpg';
    } elseif (str_contains($peril, 'cyber') || str_contains($peril, 'terrorism')) {
        $image = 'cyber-terrorism.jpg';
    } elseif (str_contains($peril, 'crop') || str_contains($peril, 'offshore')) {
        $image = 'crop-energy.jpg';
    }

    return get_template_directory_uri() . '/dist/images/model-defaults/' . $image;
};
?>

<section class="latest-models py-10 lg:py-40 bg-[var(--off-white)]" >
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row">
            <?php if($modelLibrary):
                $title = $modelLibrary['title'];
                $usps = $modelLibrary['library_usps'];
                $copy = $modelLibrary['copy'];
                $button = $modelLibrary['button'];
            ?>
                <div class="w-full lg:max-w-[30%] mb-10 lg:mb-0">
                    <h3 class="title-mark mb-8">
                        <?php echo $title ?>
                    </h3>

                    <?php if($usps): ?>
                        <ul>
                            <?php foreach($usps as $usp):
                                $item = $usp['usp_item'];
                            ?>
                                <li class="text-xl font-semibold">✓ <?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if($copy): ?>
                        <div class="text-lg my-6">
                            <?php echo $copy ?>
                        </div>
                    <?php endif; ?>

                    <?php if($button): ?>
                        <a class="primary-cta" href="<?php echo $button['url'] ?>">
                            <?php echo $button['title'] ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($latestUpdates):
                $title = $latestUpdates['title'];
                $modelUpdates = $latestUpdates['model_updates'] ?? [];
                $models = is_array($modelUpdates) ? array_slice($modelUpdates, 0, 2) : [];
            ?>
                <div class="w-full lg:max-w-[70%]">
                    <h3 class="title-mark mb-8">
                        <?php echo esc_html($title); ?>
                    </h3>

                    <?php if ($models) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ($models as $model) :
                                $modelId = is_object($model) ? $model->ID : (int) $model;
                                $perils = get_field('perils', $modelId);
                                $cardImage = get_the_post_thumbnail_url($modelId, 'large') ?: $getModelFallbackImage($perils);
                                $status = get_field('status', $modelId);
                                $statusColour = match ($status) {
                                    'On Demand'      => '#3b82f6',
                                    'In Development' => '#f59e0b',
                                    default          => '#22c55e',
                                };
                                $releaseDate = get_field('release_date', $modelId);
                                $territories = get_field('territories', $modelId);
                                $visibleTerritories = $territories ? array_slice($territories, 0, 6) : [];
                                $remainingTerritories = $territories ? count($territories) - count($visibleTerritories) : 0;
                                $modelLink = get_field('model_link', $modelId);
                                $cardLink = $modelLink ?: get_permalink($modelId);
                                ?>

                                <article class="relative min-h-[575px] rounded-[6px] overflow-hidden bg-black text-white flex flex-col">
                                    <img
                                        class="absolute inset-0 w-full h-full object-cover z-0"
                                        src="<?php echo esc_url($cardImage); ?>"
                                        alt=""
                                    >

                                    <div class="absolute inset-0 z-[5] bg-gradient-to-b from-black/20 via-black/30 to-black"></div>

                                    <div class="relative z-10 flex flex-col flex-1 p-6 lg:p-8">
                                        <div class="flex flex-wrap items-start justify-between gap-3 mb-auto">
                                            <?php if ($perils) : ?>
                                                <div class="flex flex-wrap gap-2">
                                                    <?php foreach ($perils as $peril) : ?>
                                                        <span class="inline-block bg-[var(--brand-red)] rounded-full px-3 py-1 text-xs font-semibold">
                                                            <?php echo esc_html($peril['peril']); ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($status) : ?>
                                                <span class="inline-flex items-center gap-2 bg-black/70 rounded-full px-2 py-1 text-xs font-semibold">
                                                    <?php echo esc_html($status); ?>
                                                    <span class="w-3 h-3 rounded-full" style="background-color: <?php echo esc_attr($statusColour); ?>;" aria-hidden="true"></span>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mt-24">
                                            <h4 class="text-[clamp(26px,3vw,36px)] leading-none font-semibold mb-5">
                                                <?php echo esc_html(get_the_title($modelId)); ?>
                                            </h4>

                                            <?php if ($releaseDate) : ?>
                                                <p class="text-base lg:text-lg mb-6">
                                                    Released/Updated:
                                                    <span class="inline-block border-2 border-[var(--brand-red)] rounded-full px-4 py-1 ml-2 font-semibold">
                                                        <?php echo esc_html($releaseDate); ?>
                                                    </span>
                                                </p>
                                            <?php endif; ?>

                                            <?php if ($territories) : ?>
                                                <div class="mb-8">
                                                    <h5 class="text-sm font-semibold uppercase mb-3">Territories:</h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <?php foreach ($visibleTerritories as $territory) : ?>
                                                            <span class="inline-block bg-[var(--brand-red)] rounded-full px-3 py-1 text-xs font-semibold">
                                                                <?php echo esc_html($territory['territory']); ?>
                                                            </span>
                                                        <?php endforeach; ?>

                                                        <?php if ($remainingTerritories > 0) : ?>
                                                            <span class="inline-block border border-white/50 rounded-full px-3 py-1 text-xs font-semibold">
                                                                +<?php echo esc_html($remainingTerritories); ?> more
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <a class="inline-flex items-center gap-3 text-lg font-semibold" href="<?php echo esc_url($cardLink); ?>">
                                                Learn More <span class="text-2xl" aria-hidden="true">→</span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
