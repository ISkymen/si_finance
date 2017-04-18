<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_project.
 */

namespace Drupal\si\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Si_project entities.
 */
class si_projectViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['si_project']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Project'),
      'help' => $this->t('The Project ID.'),
    );

    return $data;
  }

}
