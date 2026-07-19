<?php
$title = get_field('main_title');
$blockCopy = get_field('block_copy');
$uspItems = get_field('usp_items');
?>

<section class="usp-icon-text-block red-grad-bg-with-logomark py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <div class="w-full flex flex-col items-start md:flex-row md:items-center justify-between">
            <h3 class="title-mark-white mb-4 text-white">
                <?php echo $title ?>
            </h3>

            <a class="text-rm text-white font-semibold mb-6 md:mb-0" href="/contact/">
                Get Support
            </a>
        </div>

        <?php if($blockCopy): ?>
            <div class="text-white/70 text-lg mb-6">
                <?php echo $blockCopy ?>
            </div>
        <?php endif; ?>

        <?php if($uspItems): ?>
            <div class="grid auto-rows-auto grid-cols-1 lg:grid-cols-2 gap-8">
                <?php foreach($uspItems as $item):
                    $itemTitle = $item['title'];
                    $itemCopy = $item['copy'];
                    $itemIcon = $item['icon'];
                ?>
                    <div class="flex flex-row items-start">
                        <!-- Icon -->
                        <img class="mr-4" src="<?php echo $itemIcon['url'] ?>">
                        <!-- Title & Copy -->
                        <div class="flex flex-col items-start ">
                            <h4 class="uppercase text-white font-semibold">
                                <?php echo $itemTitle ?>
                            </h4>
                            <span class="text-white/70 text-lg">
                                <?php echo $itemCopy ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
