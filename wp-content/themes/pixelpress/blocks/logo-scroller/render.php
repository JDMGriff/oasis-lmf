<?php
$title = get_field('scroller_title');
$logos = get_field('logos');
?>

<section class="logo-scroller bg-white pb-10 pt-12">
    <?php if ($title): ?>
        <h2 class="logo-scroller__title text-xl font-semibold"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($logos): ?>
        <div class="logo-scroller__viewport">
            <div class="logo-scroller__track">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                    <?php foreach ($logos as $logo): ?>
                        <?php $logo = $logo['logo'] ?? $logo; ?>
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>" class="logo-scroller__logo">
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
