<?php
$mainTitle = get_field('main_title');
$imageTextBoxes = get_field('image_text_boxes');
$greyBg = get_field('show_grey_background');
?>

<section
    class="py-10 lg:py-40 bg-cover bg-center <?php if($greyBg  === true): ?> bg-[var(--off-white)] <?php endif; ?>"
    style="
        background-image: url('<?php echo get_template_directory_uri() ?>/dist/images/logomark-corner-top-right.png');
        background-position: top right;
        background-size: auto;
        background-repeat: no-repeat;
    "
>
    <div class="container mx-auto px-4">
        <h3 class="title-mark mb-10"><?php echo $mainTitle ?></h3>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php if($imageTextBoxes): ?>
            <?php foreach($imageTextBoxes as $index => $box):
                $boxTitle = $box['box_title'];
                $boxCopy = $box['box_copy'];
                $boxListItems = $box['box_list_items'];
                $boxLink = $box['box_link'];
                $boxImage = $box['box_image'];
            ?>
                <div
                    class="image-text-box-item bg-cover bg-center relative p-10 rounded-[4px] overflow-hidden"
                    style="<?php if ($boxImage) {?> background-image: url(<?php echo esc_url($boxImage['url']); ?>); <?php } ?>"
                    data-aos="fade-up"
                    data-aos-delay="<?php echo esc_attr($index * 100); ?>"
                >
                    <!-- Image Overlay -->
                    <div class="bg-[rgba(0,0,0,0.6)] w-full h-full inline-block absolute left-0 top-0"></div>
                    <!-- Hover Overlay -->
                    <div class="image-text-box-item-hoveroverlay bg-[var(--brand-red)] inline-block absolute"></div>
                    <!-- Logomark -->
                    <div class="image-text-box-item-logomark">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="132.947" height="135.034" viewBox="0 0 132.947 135.034">
                        <defs>
                            <clipPath id="clip-path">
                            <rect id="Rectangle_246" data-name="Rectangle 246" width="135.034" height="132.947" transform="translate(0.805 23.84)" fill="none" stroke="#707070" stroke-width="1"/>
                            </clipPath>
                            <linearGradient id="linear-gradient" x1="0.5" y1="0.393" x2="0.992" y2="0.982" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#fff"/>
                            <stop offset="0.73" stop-color="#fff" stop-opacity="0.122"/>
                            <stop offset="1" stop-color="#fff" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <g id="Mask_Group_38" data-name="Mask Group 38" transform="translate(156.788 -0.805) rotate(90)" clip-path="url(#clip-path)">
                            <path id="Ellipse_12" data-name="Ellipse 12" d="M133.8,216.047A82.242,82.242,0,1,1,216.047,133.8,82.335,82.335,0,0,1,133.8,216.047m0,51.563A133.8,133.8,0,1,0,0,133.8,133.8,133.8,0,0,0,133.8,267.609Z" transform="translate(-133 -109.964)" opacity="0.69" fill="url(#linear-gradient)"/>
                        </g>
                        </svg>
                    </div>

                    <!-- Box Content -->
                    <div class="relative z-[5] text-white">
                        <h4 class="uppercase text-3xl font-bold mb-6">
                            <?php echo $boxTitle ?>
                        </h4>
                        <?php if($boxCopy):
                            echo $boxCopy;
                        endif; ?>
                        <?php if($boxListItems):?>
                            <ul class="text-white mt-4 mb-8 leading-loose">
                                <?php foreach($boxListItems as $listItem): ?>
                                    <li>✓ <?php echo $listItem['list_item'] ?></li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif; ?>
    
                        <?php if($boxLink): ?>
                            <a class="primary-cta" href="<?php echo $boxLink['url'] ?>">
                                <?php echo $boxLink['title'] ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
