<?php

/**
 * @file
 * Contains \Drupal\si\si_stakeListBuilder.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Si_stake entities.
 *
 * @ingroup si
 */
class si_stakeListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Si_stake ID');
    $header['name'] = $this->t('Name');
    $header['project'] = $this->t('Project');
    $header['party'] = $this->t('Party');
    $header['share'] = $this->t('Share');
    $header['description'] = $this->t('Description');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\si\Entity\si_stake */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.si_stake.edit_form', array(
          'si_stake' => $entity->id(),
        )
      )
    );
    $row['project'] = $entity->get('project')->entity->label();
    $row['party'] = $entity->get('party')->entity->label();
    $row['share'] = $entity->share->value;
    $row['description'] = $entity->description->value;
    return $row + parent::buildRow($entity);
  }

}
