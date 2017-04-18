<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_stake.
 */

namespace Drupal\si\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Si_stake entities.
 */
class si_stakeViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['si_stake']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Si_stake'),
      'help' => $this->t('The Si_stake ID.'),
    );

    return $data;
  }

}
