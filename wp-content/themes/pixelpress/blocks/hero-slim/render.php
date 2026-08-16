<?php
$heroTitle = get_field('hero_title');
$heroCopy = get_field('hero_copy');
$heroImage = get_field('hero_image');
$cta = get_field('cta');
$pageLinks = get_field('inner_links');
?>

<section class="hero-main py-20 lg:py-40 bg-cover bg-center" style="<?php if ($heroImage) {?> background-image: url(<?php echo esc_url($heroImage['url']); ?>); <?php } ?>">
    <div class="container">
        <div class="hero-inner">
            <div data-aos="fade-up" class="hero-content">
                <!-- Hero Title -->
                <?php if ($heroTitle) { ?>
                    <h1 class="hero-title font-semibold uppercase text-white text-[clamp(32px,6vw,60px)] leading-none w-100 text-center md:text-left xl:max-w-[70%] mb-6">
                        <?php echo $heroTitle; ?>
                    </h1>
                <?php } ?>
    
                <!-- Hero Copy -->
                <?php if ($heroCopy) { ?>
                    <div class="hero-copy w-full lg:max-w-[65%] text-white text-center mb-6 text-[clamp(16px,2vw,20px)] leading-[1.4] font-medium md:text-left">
                        <?php echo wp_kses_post($heroCopy); ?>
                    </div>
                <?php } ?>

                <?php if($pageLinks): ?>
                    <div class="flex flex-col items-center gap-4 md:flex-row">
                        <?php foreach($pageLinks as $link):
                            $linkItem = $link['link_item']; ?>
    
                            <a class="text-sm text-white bg-[var(--brand-red)] rounded-full px-4 py-2 inline-block mt-4 font-semibold border-2 border-[var(--brand-red)] hover:bg-transparent transition-all duration-300 md:text-base" href="<?php echo $linkItem['url']; ?>">
                                <?php echo $linkItem['title']; ?>
                            </a>
                        
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
    
                <!-- CTA -->
                <?php if($cta) { ?>
                    <div class="hero-ctas w-full flex justify-center md:justify-start">
                        <a class="primary-cta text-center font-semibold" href="<?php echo $cta['url']; ?>">
                            <?php echo $cta['title']; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
