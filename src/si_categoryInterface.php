<?php

/**
 * @file
 * Contains \Drupal\si\si_categoryInterface.
 */

namespace Drupal\si;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Provides an interface for defining Si_category entities.
 *
 * @ingroup si
 */
interface si_categoryInterface extends ContentEntityInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Si_category name.
   *
   * @return string
   *   Name of the Si_category.
   */
  public function getName();

  /**
   * Sets the Si_category name.
   *
   * @param string $name
   *   The Si_category name.
   *
   * @return \Drupal\si\si_categoryInterface
   *   The called Si_category entity.
   */
  public function setName($name);

  /**
   * Gets the Si_category creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Si_category.
   */
  
}
