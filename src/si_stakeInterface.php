<?php

/**
 * @file
 * Contains \Drupal\si\si_stakeInterface.
 */

namespace Drupal\si;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Provides an interface for defining Si_stake entities.
 *
 * @ingroup si
 */
interface si_stakeInterface extends ContentEntityInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Si_stake name.
   *
   * @return string
   *   Name of the Si_stake.
   */
  public function getName();

  /**
   * Sets the Si_stake name.
   *
   * @param string $name
   *   The Si_stake name.
   *
   * @return \Drupal\si\si_stakeInterface
   *   The called Si_stake entity.
   */
  public function setName($name);

  /**
   * Gets the Si_stake creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Si_stake.
   */

}
