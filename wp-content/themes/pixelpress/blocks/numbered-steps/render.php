<?php
$blockTitle = get_field('block_title');
$blockCopy = get_field('block_copy');
$steps = get_field('steps');
$stepTotal = is_array($steps) ? count($steps) : 0;
$showLogomark = get_field('show_logomark');
?>

<section
    class="hero-main py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]"
    <?php if($showLogomark === true): ?>
    style="
        background-image: url('<?php echo get_template_directory_uri() ?>/dist/images/logomark-corner-top-right.png');
        background-position: top right;
        background-size: auto;
        background-repeat: no-repeat;
    "
    <?php endif; ?>
>
    <div class="container px-4 mx-auto">
        <div class="grid gap-8 lg:gap-32 grid-cols-1 lg:grid-cols-2">
            <?php if($blockTitle): ?>
                <div class="flex flex-col">
                    <h3 class="title-mark">
                        <?php echo $blockTitle ?>
                    </h3>
                    <?php if($blockCopy): ?>
                        <p class="text-xl">
                            <?php echo $blockCopy ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Steps -->
            <?php if($steps):?>
                <div class="flex flex-col">
                    <?php foreach ($steps as $index => $step):
                        $stepTitle = $step['step_title'];
                        $stepCopy = $step['step_copy'];
                    ?>

                        <div class="flex items-start gap-4 mb-10">
                            <div>
                                <span class="flex items-center justify-center text-2xl font-semibold w-[38px] h-[38px] border-2 border-dashed border-[var(--brand-red)] rounded-full">
                                    <?php echo $index + 1 ?>
                                </span>
                            </div>
                            <div>
                                <h4 class="uppercase mb-2">
                                    <?php echo $stepTitle ?>
                                </h4>
                                <p class="text-[var(--off-black-light)]">
                                    <?php echo $stepCopy ?>
                                </p>
                            </div>
                        </div>

                    <?php
                    endforeach; ?>
                </div>
            <?php endif; ?>    
        </div>
    </div>
</section>