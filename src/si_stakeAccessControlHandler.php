<?php

/**
 * @file
 * Contains \Drupal\si\si_stakeAccessControlHandler.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Si_stake entity.
 *
 * @see \Drupal\si\Entity\si_stake.
 */
class si_stakeAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\si\si_stakeInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view published si_stake entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit si_stake entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete si_stake entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add si_stake entities');
  }

}
