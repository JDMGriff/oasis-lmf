<?php
$heroTitle = get_field('hero_title');
$heroCopy = get_field('hero_copy');
$heroImage = get_field('hero_image');
$heroVideo = get_field('hero_video');
$usps = get_field('usps');
$cta = get_field('cta');
?>

<section class="hero-main relative overflow-hidden py-10 lg:py-40 bg-cover bg-center lg:h-[800px]" style="<?php if ($heroImage && !$heroVideo) {?> background-image: url(<?php echo esc_url($heroImage['url']); ?>); <?php } ?>">
    <?php if ($heroVideo) : ?>
        <video
            class="absolute inset-0 w-full h-full object-cover"
            autoplay
            muted
            loop
            playsinline
            <?php if ($heroImage) : ?>poster="<?php echo esc_url($heroImage['url']); ?>"<?php endif; ?>
        >
            <source src="<?php echo esc_url($heroVideo['url']); ?>" type="<?php echo esc_attr($heroVideo['mime_type']); ?>">
        </video>
    <?php endif; ?>

    <div class="container relative z-10">
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
                    <div class="hero-copy w-full lg:max-w-[65%] text-white mb-6 text-[clamp(16px,2vw,20px)] leading-[1.4] font-medium">
                        <?php echo wp_kses_post($heroCopy); ?>
                    </div>
                <?php } ?>
    
                <!-- USPs -->
                <?php if($usps): ?>
                    <div class="hero-usp-wrap mb-6">
                        <div class="hero-usp-row flex flex-row text-sm lg:text-base">
                            <?php foreach($usps as $usp):
                                $text = $usp['usp_text'];
                            ?>
    
                            <div class="hero-usp-item flex min-w-0">
                                <p class="text-white font-bold"><?php echo $text ?></p>
                            </div>
    
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
    
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
