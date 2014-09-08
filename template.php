<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  barnard_theme_preprocess_html($variables, $hook);
  barnard_theme_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // barnard_theme_preprocess_node_page() or barnard_theme_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function barnard_theme_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

function barnard_theme_preprocess_page(&$vars) {
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    _bc_islandora_featured();
  }
}

function barnard_theme_preprocess_islandora_newspaper_page(&$vars) {
  $object = $vars['object'];
  $issue = islandora_object_load(islandora_newspaper_get_issue($object));
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $page_number = _bc_islandora_get_sequence($object);
    //$vars['content'] = theme('bc_islandora_newspaper_page', array('object' => $object));
    $vars['content'] = theme('bc_islandora_newspaper_issue', array('object' => $issue, 'start_page' => $page_number));
  }
}

function barnard_theme_preprocess_islandora_newspaper_issue(&$vars) {
  $vars['viewer'] = theme('bc_islandora_newspaper_issue', array('object' => $vars['object']));
}

function barnard_theme_preprocess_islandora_book_book(&$vars) {
  $object = $vars['object'];
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    if (_bc_islandora_is_document($object)) {
      drupal_add_js(libraries_get_path('openseadragon') . '/openseadragon.js');
      $vars['viewer'] = theme('bc_islandora_newspaper_issue', array('object' => $object));
    }
  }
}

function barnard_theme_preprocess_islandora_book_page(&$vars) {

}

function barnard_theme_preprocess_islandora_newspaper_page_controls(&$vars) {
  // TODO rewrite the contents of $vars['controls'] - to be sent through
  // theme_item_list().
}

function barnard_theme_breadcrumb(&$vars) {
  $breadcrumb = $vars['breadcrumb'];
  if (module_exists('bc_islandora')) {
    return theme('bc_islandora_breadcrumb', array('breadcrumb' => $breadcrumb));
  }
  else {
    return '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
  }
}
