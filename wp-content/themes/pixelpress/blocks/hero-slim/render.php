<?php
$heroTitle = get_field('hero_title');
$heroCopy = get_field('hero_copy');
$heroImage = get_field('hero_image');
$cta = get_field('cta');
?>

<section class="hero-main py-10 lg:py-40 bg-cover bg-center" style="<?php if ($heroImage) {?> background-image: url(<?php echo esc_url($heroImage['url']); ?>); <?php } ?>">
    <div class="container">
        <div class="hero-inner">
            <div data-aos="fade-up" class="hero-content">
                <!-- Hero Title -->
                <?php if ($heroTitle) { ?>
                    <h1 class="hero-title font-semibold uppercase text-white text-[clamp(32px,6vw,60px)] leading-none w-100 xl:max-w-[70%] mb-6">
                        <?php echo $heroTitle; ?>
                    </h1>
                <?php } ?>
    
                <!-- Hero Copy -->
                <?php if ($heroCopy) { ?>
                    <div class="hero-copy text-white mb-6 text-[clamp(16px,2vw,24px)] leading-[1.4] font-medium">
                        <?php echo wp_kses_post($heroCopy); ?>
                    </div>
                <?php } ?>
    
                <!-- CTA -->
                <?php if($cta) { ?>
                    <div class="hero-ctas">
                        <a class="primary-cta text-center font-semibold" href="<?php echo $cta['url']; ?>">
                            <?php echo $cta['title']; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
