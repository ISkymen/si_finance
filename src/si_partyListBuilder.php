<?php

/**
 * @file
 * Contains \Drupal\si\si_partyListBuilder.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Si_party entities.
 *
 * @ingroup si
 */
class si_partyListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Si_party ID');
    $header['name'] = $this->t('Name');
    $header['description'] = $this->t('Description');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\si\Entity\si_party */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.si_party.edit_form', array(
          'si_party' => $entity->id(),
        )
      )
    );
    $row['description'] = $entity->description->value;
    return $row + parent::buildRow($entity);
  }

}
