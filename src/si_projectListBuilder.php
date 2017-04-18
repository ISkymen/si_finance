<?php

/**
 * @file
 * Contains \Drupal\si\si_projectListBuilder.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Si_project entities.
 *
 * @ingroup si
 */
class si_projectListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Si_project ID');
    $header['name'] = $this->t('Name');
    $header['description'] = $this->t('Description');
    $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}Status
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\si\Entity\si_project */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.si_project.edit_form', array(
          'si_project' => $entity->id(),
        )
      )
    );
    $row['description'] = $entity->description->value;
    $row['status'] = $entity->status->value;
    return $row + parent::buildRow($entity);
  }

}
