<?php
$blockTitle = get_field('block_title');
$blockEyebrow = get_field('block_eyebrow_sub_title');
$steps = get_field('steps');
$blockIntro = get_field('block_intro');
$lowerCopy = get_field('lower_copy');
?>

<section class="tiled-steps red-grad-bg-with-logomark py-20 lg:py-28">
    <div class="container px-4 mx-auto">
        <header class="tiled-steps__header">
            <?php if ($blockEyebrow) : ?>
                <p class="title-mark-white mb-4">
                    <?php echo esc_html($blockEyebrow); ?>
                </p>
            <?php endif; ?>

            <?php if ($blockTitle) : ?>
                <h3 class="text-white <?php echo $blockEyebrow ? '' : 'title-mark-white'; ?>">
                    <?php echo esc_html($blockTitle); ?>
                </h3>
            <?php endif; ?>

            <?php if ($blockIntro) : ?>
                <div class="tiled-steps__intro">
                    <?php echo wp_kses_post($blockIntro); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if (is_array($steps) && $steps) : ?>
            <ol class="tiled-steps__grid">
                <?php foreach ($steps as $index => $step) :
                    $stepTitle = $step['step_title'] ?? '';
                    $stepCopy = $step['step_copy'] ?? '';
                    ?>
                    <li class="tiled-step">
                        <div class="tiled-step__topline">
                            <span class="tiled-step__number" aria-hidden="true">
                                <?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?>
                            </span>
                            <span class="tiled-step__rule" aria-hidden="true"></span>
                        </div>

                        <?php if ($stepTitle) : ?>
                            <h4 class="tiled-step__title">
                                <?php echo esc_html($stepTitle); ?>
                            </h4>
                        <?php endif; ?>

                        <?php if ($stepCopy) : ?>
                            <div class="tiled-step__copy">
                                <?php echo wp_kses_post($stepCopy); ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

        <?php if ($lowerCopy) : ?>
            <div class="tiled-steps__footer">
                <span class="tiled-steps__footer-mark" aria-hidden="true">✓</span>
                <div><?php echo wp_kses_post($lowerCopy); ?></div>
            </div>
        <?php endif; ?>
    </div>
</section>
