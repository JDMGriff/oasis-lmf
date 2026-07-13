<?php
$mainTitle = get_field('main_title');
$uspItems = get_field('usp_items');
?>

<section class="usp-icon-text-block red-grad-bg-with-logomark py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <h3 class="title-mark-white text-white mb-10"><?php echo $mainTitle ?></h3>

        <div class="grid auto-rows-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
    </div>
</section>
