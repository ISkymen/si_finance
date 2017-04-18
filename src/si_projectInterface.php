<?php

/**
 * @file
 * Contains \Drupal\si\si_projectInterface.
 */

namespace Drupal\si;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Provides an interface for defining Si_project entities.
 *
 * @ingroup si
 */
interface si_projectInterface extends ContentEntityInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Si_project name.
   *
   * @return string
   *   Name of the Si_project.
   */
  public function getName();

  /**
   * Sets the Si_project name.
   *
   * @param string $name
   *   The Si_project name.
   *
   * @return \Drupal\si\si_projectInterface
   *   The called Si_project entity.
   */
  public function setName($name);

}
