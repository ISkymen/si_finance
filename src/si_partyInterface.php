<?php

/**
 * @file
 * Contains \Drupal\si\si_partyInterface.
 */

namespace Drupal\si;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Provides an interface for defining Si_party entities.
 *
 * @ingroup si
 */
interface si_partyInterface extends ContentEntityInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Si_party name.
   *
   * @return string
   *   Name of the Si_party.
   */
  public function getName();

  /**
   * Sets the Si_party name.
   *
   * @param string $name
   *   The Si_party name.
   *
   * @return \Drupal\si\si_partyInterface
   *   The called Si_party entity.
   */
  public function setName($name);

}
