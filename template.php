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
  if (module_exists('bc_islandora') && $vars['is_front']) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $vars['page']['footer']['front_caption'] = array(
      '#markup' => _bc_islandora_featured(),
      '#prefix' => '<div id="block-views-featured-block">',
      '#suffix' => '</div>',
    );
  }
  if (module_exists('bc_islandora') && !$vars['is_front'] && arg(1) != 'search') {
    $vars['bc_breadcrumb'] = theme('bc_islandora_breadcrumb', array('breadcrumb' => array()));
  }
  if (module_exists('service_links') && _service_links_match_path()) {
    $vars['socialmedia'] = implode('', service_links_render(NULL));
  }
}

function barnard_theme_preprocess_islandora_newspaper_page(&$vars) {
  $object = $vars['object'];
  $issue = islandora_object_load(islandora_newspaper_get_issue($object));
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $page_number = _bc_islandora_get_sequence($object);
    $vars['content'] = theme('bc_islandora_newspaper_page', array('object' => $object));
  }
}

function barnard_theme_preprocess_islandora_newspaper_issue(&$vars) {
  if (module_exists('bc_islandora')) {
    $vars['viewer'] = theme('bc_islandora_newspaper_issue', array('object' => $vars['object']));
  }
  if (module_exists('service_links')) {
    $vars['service_links'] = service_links_render(NULL);
  }
}

function barnard_theme_preprocess_islandora_book_book(&$vars) {
  $object = $vars['object'];
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $vars['dl_links'] = _bc_islandora_dl_links($object, array('PDF'));
    if (_bc_islandora_is_document($object)) {
      drupal_add_js(libraries_get_path('openseadragon') . '/openseadragon.js');
      $vars['viewer'] = theme('bc_islandora_newspaper_issue', array('object' => $object));
    }
  }
}

function barnard_theme_preprocess_islandora_book_page(&$vars) {
  $object = $vars['object'];
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $vars['dl_links'] = _bc_islandora_dl_links($object, array('JPG'));
  }
}

function barnard_theme_preprocess_islandora_large_image(&$vars) {
  if (module_exists('bc_islandora')) {
    module_load_include('inc', 'bc_islandora', 'includes/bc_islandora.theme');
    $vars['dl_links'] = _bc_islandora_dl_links($vars['islandora_object'], array('JPG'));
  }
}



/**
 * Implements hook_CMODEL_PID_islandora_solr_object_result_alter().
 */
function barnard_theme_islandora_newspaperpagecmodel_islandora_solr_object_result_alter(&$search_results, $query_processor) {
  if(!$query_processor->solrQuery || $query_processor->solrQuery == ' ') {
    unset($search_results['object_url_params']['solr']);
  }
}
