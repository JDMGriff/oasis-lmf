<?php
if (!defined('ABSPATH')) {
    exit;
}
// Register Block Directory
function inkwellRegisterAcfBlocks() {
    $blockDirectories = glob(get_theme_file_path('/blocks/*'), GLOB_ONLYDIR);

    if (!$blockDirectories) {
        return;
    }

    foreach ($blockDirectories as $blockDirectory) {
        if (file_exists($blockDirectory . '/block.json')) {
            register_block_type($blockDirectory);
        }
    }
}
add_action('init', 'inkwellRegisterAcfBlocks');

function inkwellRegisterBlockCategories($categories, $editorContext) {
    return array_merge(
        [
            [
                'slug' => 'inkwell-components',
                'title' => __('Inkwell Components', 'inkwell'),
            ],
        ],
        $categories
    );
}
add_filter('block_categories_all', 'inkwellRegisterBlockCategories', 10, 2);