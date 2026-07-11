<?php
$mainTitle = get_field('main_title');
$imageTextBoxes = get_field('image_text_boxes');
?>

<section class="hero-main py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <h3 class="title-mark"><?php echo $mainTitle ?></h3>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php foreach($imageTextBoxes as $box):
                $boxTitle = $box['box_title'];
                $boxCopy = $box['box_copy'];
                $boxListItems = $box['box_list_items'];
                $boxLink = $box['box_link'];
                $boxImage = $box['box_image'];
            ?>
                <div
                    class="bg-cover bg-center"
                    style="<?php if ($boxImage) {?> background-image: url(<?php echo esc_url($boxImage['url']); ?>); <?php } ?>"
                >
                    <h4 class="uppercase text-3xl font-bold">
                        <?php echo $boxTitle ?>
                    </h4>

                    <?php echo $boxCopy ?>
                    
                    <?php if($boxListItems):?>
                        <ul class="pl-4">
                            <?php foreach($boxListItems as $listItem):
                                $item = $listItem['list_item']
                            ?>
                                <li><?php echo $item ?></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif; ?>

                    <a class="primary-cta" href="<?php echo $boxLink['url'] ?>">
                        <?php echo $boxLink['title'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
