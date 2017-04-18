<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_party.
 */

namespace Drupal\si\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Si_party entities.
 */
class si_partyViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['si_party']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Party'),
      'help' => $this->t('The Party ID.'),
    );

    return $data;
  }

}
