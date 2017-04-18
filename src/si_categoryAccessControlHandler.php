<?php

/**
 * @file
 * Contains \Drupal\si\si_categoryAccessControlHandler.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Si_category entity.
 *
 * @see \Drupal\si\Entity\si_category.
 */
class si_categoryAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\si\si_categoryInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view published si_category entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit si_category entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete si_category entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add si_category entities');
  }

}
