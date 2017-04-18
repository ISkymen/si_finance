<?php

/**
 * @file
 * Contains si_category.page.inc..
 *
 * Page callback for Si_category entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Si_category templates.
 *
 * Default template: si_category.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_si_category(array &$variables) {
  // Fetch si_category Entity Object.
  $si_category = $variables['elements']['#si_category'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
