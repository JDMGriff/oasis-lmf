<?php
    $showHero = get_field('show_hero_component');
    $hero = get_field('hero_component');
    $backgroundImage = $hero['background_image'];
    $title = $hero['title'];
    $heroText = $hero['hero_text'];
    $linkUrl = $hero['link_url'];
    $linkText = $hero['link_text'];
?>

<?php if (!$showHero === 1): ?>
<div class="py-40 bg-cover bg-top" <?php if ($backgroundImage) { ?> style="background-image: url(' <?php echo $backgroundImage ?> ')" <?php } ?>>
    <div class="container mx-auto px-4">
        <div class="hero-content">
            <!-- Hero Title -->
            <h1 class="hero-title text-white text-4xl md:text-[60px] leading-tight mb-6"><?php echo $title ?></h1>

            <?php
                // Hero Copy
                if ($heroText):
                    echo $heroText;
                endif;
                // if link exists display
                if ($linkUrl):
                    echo '<a class="hero__inner--link" href="'.$link.'">'. $linkText .'<span><i class="fa-solid fa-arrow-right"></i></span></a>';
                endif;
            ?>
        </div>
    </div>
</div>
<?php endif; ?>