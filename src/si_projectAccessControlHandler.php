<?php

/**
 * @file
 * Contains \Drupal\si\si_projectAccessControlHandler.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Si_project entity.
 *
 * @see \Drupal\si\Entity\si_project.
 */
class si_projectAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\si\si_projectInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view published si_project entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit si_project entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete si_project entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add si_project entities');
  }

}
