<?php
$mainTitle = get_field('main_title');
$uspItems = get_field('usp_items');
?>

<section class="usp-icon-text-block red-grad-bg-with-logomark py-20 lg:py-28">
    <div class="container mx-auto px-4">
        <?php if ($mainTitle) : ?>
            <h3 class="title-mark-white text-white mb-10 lg:mb-12">
                <?php echo esc_html($mainTitle); ?>
            </h3>
        <?php endif; ?>

        <?php if (is_array($uspItems) && $uspItems) : ?>
            <ul class="usp-icon-text__grid">
                <?php foreach ($uspItems as $item) :
                    $itemTitle = $item['title'] ?? '';
                    $itemCopy = $item['copy'] ?? '';
                    $itemIcon = $item['icon'] ?? null;
                    ?>
                    <li class="usp-icon-text__item">
                        <?php if ($itemIcon) : ?>
                            <span class="usp-icon-text__icon" aria-hidden="true">
                                <img src="<?php echo esc_url($itemIcon['url']); ?>" alt="">
                            </span>
                        <?php endif; ?>

                        <div class="usp-icon-text__body">
                            <?php if ($itemTitle) : ?>
                                <h4 class="usp-icon-text__title">
                                    <?php echo esc_html($itemTitle); ?>
                                </h4>
                            <?php endif; ?>

                            <?php if ($itemCopy) : ?>
                                <div class="usp-icon-text__copy">
                                    <?php echo wp_kses_post($itemCopy); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
