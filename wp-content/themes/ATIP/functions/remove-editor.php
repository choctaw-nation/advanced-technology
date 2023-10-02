<?php

/**
 * Remove Editor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */

// Remove editor from the Page custom post type and Pages
add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type()
{
    remove_post_type_support('page', 'editor');
    remove_post_type_support('staff', 'editor');
}

?>