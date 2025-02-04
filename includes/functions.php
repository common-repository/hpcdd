<?php

/**
 * The file that defines functions used by the plugin
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/includes
 */

/**
 * Get subcategories for second drop-down menu
 */
function getLvl2()
{
    $parent = cleanPostIntVal($_POST['lvl1']);

    sanitize_text_field($parent);

    if (!empty($parent)) {
        options($parent);
    } else {
        echo '';
        wp_die();
    }
}

/**
 * Get subcategories for third drop-down menu
 */
function getLvl3()
{
    $parent = cleanPostIntVal($_POST['lvl2']);

    sanitize_text_field($parent);

    if (!empty($parent)) {
        options($parent);
    } else {
        echo '';
        wp_die();
    }
}

/**
 * Get subcategories for fourth drop-down menu
 */
function getLvl4()
{
    $parent = cleanPostIntVal($_POST['lvl3']);

    sanitize_text_field($parent);

    if (!empty($parent)) {
        options($parent);
    } else {
        echo '';
        wp_die();
    }
}

/**
 * Clean integer data coming from the select, input etc. fields
 *
 * @param int $parent Data to be cleaned
 */
function cleanPostIntVal($parent)
{
    $parent = intval($parent);
    $parent = trim($parent);
    return filter_var($parent, FILTER_SANITIZE_NUMBER_INT);
    //return $parent;
}

/**
 * Global options used when fetching sub-categories
 *
 * @param string $parent
 */
function options(string $parent)
{
    $show_count = 1;      // 1 for yes, 0 for no
    $pad_counts = 1;      // 1 for yes, 0 for no
    $hierarchical = 1;    // 1 for yes, 0 for no
    $title = '';
    $empty = 0;

    $args = array(
        'taxonomy' => get_option('hpcdd_taxonomy_setting'),
        'orderby' => 'name',
        'show_count' => $show_count,
        'pad_counts' => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li' => $title,
        'hide_empty' => $empty,
        'parent' => $parent
    );

    $terms = get_categories($args);

    $option = '';

    foreach ($terms as $child) {
	    $option .= '<option value="' . $child->term_id . '">';
	    if ( get_option( 'hpcdd_shownumprod_setting' ) == 1 ) {
		    $option .= $child->name . ' (' . $child->count . ')';
	    } else {
		    $option .= $child->name;
	    }
	    $option .= '</option>';
    }

    echo json_encode($option);
    wp_die();
}