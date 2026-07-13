<?php
$modelLibrary = get_field('model_library');
$latestUpdates = get_field('latest_updates');
?>

<section class="latest-models py-10 lg:py-40 bg-[var(--off-white)]" >
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row">
            <?php if($modelLibrary):
                $title = $modelLibrary['title'];
                $usps = $modelLibrary['library_usps'];
                $copy = $modelLibrary['copy'];
                $button = $modelLibrary['button'];
            ?>
                <div class="w-full lg:max-w-[30%] mb-10 lg:mb-0">
                    <h3 class="title-mark mb-8">
                        <?php echo $title ?>
                    </h3>

                    <?php if($usps): ?>
                        <ul>
                            <?php foreach($usps as $usp):
                                $item = $usp['usp_item'];
                            ?>
                                <li class="text-xl font-semibold">✓ <?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if($copy): ?>
                        <div class="text-lg my-6">
                            <?php echo $copy ?>
                        </div>
                    <?php endif; ?>

                    <?php if($button): ?>
                        <a class="primary-cta" href="<?php echo $button['url'] ?>">
                            <?php echo $button['title'] ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($latestUpdates):
                $title = $latestUpdates['title'];
            ?>
                <div class="w-full lg:max-w-[70%]">
                    <h3 class="title-mark mb-8">
                        <?php echo $title ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
