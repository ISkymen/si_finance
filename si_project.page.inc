<?php

/**
 * @file
 * Contains si_project.page.inc..
 *
 * Page callback for Si_project entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Si_project templates.
 *
 * Default template: si_project.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_si_project(array &$variables) {
  // Fetch si_project Entity Object.
  $si_project = $variables['elements']['#si_project'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
