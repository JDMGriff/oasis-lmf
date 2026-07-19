<?php
$title = get_field('title');
$introCopy = get_field('intro_copy');
$mainCopy = get_field('main_copy');
$lowerCopy = get_field('lower_copy');
$stepsTitle = get_field('steps_title');
$steps = get_field('steps');
$stepTotal = is_array($steps) ? count($steps) : 0;
?>

<section class="red-grad-bg-with-logomark py-10 lg:py-40">
    <div class="container px-4 mx-auto">


        <?php if($title): ?>
        <div class="grid auto-rows-auto grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-20 mb-10">
            <div class="flex flex-col">
                <h3 class="title-mark-white text-white mb-6">
                    <?php echo $title ?>
                </h3>
                
                <?php if($introCopy): ?>
                    <span class="text-white/70 text-xl">
                        <?php echo $introCopy ?>
                    </span>
                    <?php endif; ?>
                </div>
                <!-- Main Copy -->
                <?php if($mainCopy): ?>
                    <div class="text-white/70 text-base">
                        <?php echo $mainCopy ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>


        <!-- Block heading -->
        <?php if ($stepsTitle): ?>
            <h4 class="text-white mb-6 uppercase">
                <?php echo $stepsTitle; ?>
            </h4>
        <?php endif; ?>

        <?php if ($steps): ?>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-10">
            <!-- Steps -->
                <?php foreach ($steps as $index => $step):
                    $stepCopy  = $step['step_copy'];
                ?>
                    <div class="flex items-start gap-4">
                        <span class="flex shrink-0 items-center justify-center w-[38px] h-[38px] border-2 border-dashed border-[var(--off-white)] text-2xl font-semibold text-white rounded-full">
                            <?php echo $index + 1; ?>
                        </span>

                        <div>
                            <?php if ($stepCopy): ?>
                                <p class="text-white/70">
                                    <?php echo $stepCopy; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if($lowerCopy): ?>
            <div class="text-white/70 text-lg mb-6">
                <?php echo $lowerCopy ?>
            </div>                
        <?php endif; ?>        
    </div>
</section>
