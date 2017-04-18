<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_transaction.
 */

namespace Drupal\si\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Si_transaction entities.
 */
class si_transactionViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['si_transaction']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Transaction'),
      'help' => $this->t('The Transaction ID.'),
    );

    return $data;
  }

}
