<?php

/**
 * @file
 * Contains si_stake.page.inc..
 *
 * Page callback for Si_stake entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Si_stake templates.
 *
 * Default template: si_stake.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_si_stake(array &$variables) {
  // Fetch si_stake Entity Object.
  $si_stake = $variables['elements']['#si_stake'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
