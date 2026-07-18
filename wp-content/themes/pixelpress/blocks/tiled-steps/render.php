<?php
    $blockTitle    = get_field('block_title');
    $blockEyebrow = get_field('block_eyebrow_sub_title');
    $steps         = get_field('steps');
    $stepTotal     = is_array($steps) ? count($steps) : 0;
?>

<section class="red-grad-bg-with-logomark py-10 lg:py-40">
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 lg:grid-cols-2">

            <!-- Block heading -->
            <?php if ($blockTitle): ?>
                <div class="flex flex-col">
                    <?php if ($blockEyebrow): ?>
                        <p class="title-mark-white">
                            <?php echo $blockEyebrow; ?>
                        </p>
                    <?php endif; ?>

                    <h3 class="text-white">
                        <?php echo $blockTitle; ?>
                    </h3>
                </div>
            <?php endif; ?>

            <!-- Leave the top-right cell empty when there are four steps -->
            <?php if ($stepTotal === 4): ?>
                <div class="hidden lg:block" aria-hidden="true"></div>
            <?php endif; ?>

            <!-- Steps -->
            <?php if ($steps): ?>
                <?php foreach ($steps as $index => $step):
                    $stepTitle = $step['step_title'];
                    $stepCopy  = $step['step_copy'];
                ?>
                    <div class="flex items-start gap-4">
                        <span class="flex shrink-0 items-center justify-center w-[38px] h-[38px] border-2 border-dashed border-[var(--off-white)] text-2xl font-semibold text-white rounded-full">
                            <?php echo $index + 1; ?>
                        </span>

                        <div>
                            <?php if ($stepTitle): ?>
                                <h4 class="mb-2 text-white uppercase">
                                    <?php echo $stepTitle; ?>
                                </h4>
                            <?php endif; ?>

                            <?php if ($stepCopy): ?>
                                <p class="text-white">
                                    <?php echo $stepCopy; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>
