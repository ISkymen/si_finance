<?php

/**
 * @file
 * Contains \Drupal\si\si_categoryListBuilder.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Si_category entities.
 *
 * @ingroup si
 */
class si_categoryListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Si_category ID');
    $header['name'] = $this->t('Name');
    $header['type'] = $this->t('Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\si\Entity\si_category */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.si_category.edit_form', array(
          'si_category' => $entity->id(),
        )
      )
    );
    $row['type'] = $entity->type->value;

    return $row + parent::buildRow($entity);
  }

}
