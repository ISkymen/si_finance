<?php

/**
 * @file
 * Contains si_party.page.inc..
 *
 * Page callback for Si_party entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Si_party templates.
 *
 * Default template: si_party.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_si_party(array &$variables) {
  // Fetch si_party Entity Object.
  $si_party = $variables['elements']['#si_party'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
