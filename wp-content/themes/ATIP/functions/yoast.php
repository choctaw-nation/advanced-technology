<?php

/**
 * Yoast functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */

function move_yoast_to_bottom()
{
    return 'low';
}
add_filter('wpseo_metabox_prio', 'move_yoast_to_bottom');

/* Limit the number of sitemap entries for Yoast SEO */
function max_entries_per_sitemap()
{
    return 200;
}

add_filter('wpseo_sitemap_entries_per_page', 'max_entries_per_sitemap');

?>