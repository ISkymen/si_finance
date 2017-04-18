<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_category.
 */

namespace Drupal\si\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Si_category entities.
 */
class si_categoryViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['si_category']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Category'),
      'help' => $this->t('The Category ID.'),
    );

    return $data;
  }

}
