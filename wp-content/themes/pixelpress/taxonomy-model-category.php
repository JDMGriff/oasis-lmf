<?php
get_header();

$provider = get_queried_object();

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

<main>
    <header class="bg-[var(--off-white)] py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="w-full">
                <a class="text-rm inline-block text-[var(--brand-red)] font-semibold mb-8" href="/model-library/">
                    Back to model library
                </a>

                <h1 class="text-[clamp(36px,5vw,56px)] leading-[1.05] font-bold">
                    <?php echo esc_html($provider->name); ?>
                </h1>

                <?php if ($provider->description) : ?>
                    <div class="text-lg lg:text-xl leading-relaxed text-[var(--off-black-light)] mt-6">
                        <?php echo wp_kses_post(wpautop($provider->description)); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <?php while (have_posts()) :
                        the_post();

                        $perils = get_field('perils');
                        $cardImage = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $getModelFallbackImage($perils);
                        $status = get_field('status');
                        $statusColour = match ($status) {
                            'On Demand'      => '#3b82f6',
                            'In Development' => '#f59e0b',
                            default          => '#22c55e',
                        };
                        $releaseDate = get_field('release_date');
                        $territories = get_field('territories');
                        $visibleTerritories = $territories ? array_slice($territories, 0, 6) : [];
                        $remainingTerritories = $territories ? count($territories) - count($visibleTerritories) : 0;
                        $modelLink = get_field('model_link');
                        $cardLink = $modelLink ?: get_permalink();
                        ?>

                        <article class="relative min-h-[575px] rounded-[6px] overflow-hidden bg-black text-white flex flex-col">
                            <img
                                class="absolute inset-0 w-full h-full object-cover z-0"
                                src="<?php echo esc_url($cardImage); ?>"
                                alt=""
                            >

                            <div class="absolute inset-0 z-[5] bg-gradient-to-b from-black/20 via-black/30 to-black"></div>

                            <div class="relative z-10 flex flex-col flex-1 p-6 lg:p-12">
                                <div class="flex flex-wrap items-start justify-between gap-3 mb-auto">
                                    <?php if ($perils) : ?>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ($perils as $peril) : ?>
                                                <span class="inline-block text-xs bg-[var(--brand-red)] rounded-full px-2 py-1 font-semibold">
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
                                    <h2 class="text-[clamp(28px,4vw,40px)] leading-none font-semibold mb-5">
                                        <?php the_title(); ?>
                                    </h2>

                                    <?php if ($releaseDate) : ?>
                                        <p class="text-base mb-6">
                                            Released/Updated:
                                            <span class="inline-block border-2 border-[var(--brand-red)] rounded-full px-2 py-1 text-xs ml-2 font-semibold">
                                                <?php echo esc_html($releaseDate); ?>
                                            </span>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ($territories) : ?>
                                        <div class="mb-8">
                                            <h3 class="text-base font-semibold uppercase mb-3">Territories:</h3>
                                            <div class="flex flex-wrap gap-2 lg:gap-3">
                                                <?php foreach ($visibleTerritories as $territory) : ?>
                                                    <span class="inline-block bg-[var(--brand-red)] rounded-full px-2 py-1 text-xs font-semibold">
                                                        <?php echo esc_html($territory['territory']); ?>
                                                    </span>
                                                <?php endforeach; ?>

                                                <?php if ($remainingTerritories > 0) : ?>
                                                    <span
                                                        class="inline-block border border-white/50 rounded-full px-2 py-1 text-xs font-semibold"
                                                        aria-label="<?php echo esc_attr($remainingTerritories); ?> additional territories"
                                                    >
                                                        +<?php echo esc_html($remainingTerritories); ?> more
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <a class="inline-flex items-center gap-3 font-semibold" href="<?php echo esc_url($cardLink); ?>">
                                        Learn More <span class="text-lg" aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="mt-12">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p class="text-lg">No models are currently available from this provider.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
