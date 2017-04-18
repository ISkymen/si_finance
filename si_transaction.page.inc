<?php

/**
 * @file
 * Contains si_transaction.page.inc..
 *
 * Page callback for Si_transaction entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Si_transaction templates.
 *
 * Default template: si_transaction.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_si_transaction(array &$variables) {
  // Fetch si_transaction Entity Object.
  $si_transaction = $variables['elements']['#si_transaction'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
