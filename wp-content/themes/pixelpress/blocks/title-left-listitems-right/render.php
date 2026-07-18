<?php
$title = get_field('title');
$introCopy = get_field('intro_copy');
$copyItems = get_field('copy_items');
?>

<section class="red-grad-bg-with-logomark py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <div class="grid auto-rows-auto grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-20">
            <div class="flex flex-col">
                <?php if($title): ?>
                    <h3 class="title-mark-white text-white mb-6">
                        <?php echo $title ?>
                    </h3>
                <?php endif; ?>
        
                <?php if($introCopy): ?>
                    <span class="text-white text-xl">
                        <?php echo $introCopy ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Main Copy -->
            <?php if($copyItems): ?>
                <div class="text-white text-base">
                    <?php foreach($copyItems as $item):
                        $itemTitle = $item['item_title'];
                        $textItems = $item['text_items'];
                    ?>

                    <div class="mb-6">
                        <h5 class="text-xl font-semibold mb-2">
                            <?php echo $itemTitle ?>
                        </h5>

                        <?php if($textItems): ?>
                            <ul class="leading-relaxed">
                                <?php foreach($textItems as $text):
                                    $item = $text['text'];
                                ?>
                                    <li class="flex items-start">
                                        → &nbsp; <?php echo $item ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
