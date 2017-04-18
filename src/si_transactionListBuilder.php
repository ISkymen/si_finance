<?php

/**
 * @file
 * Contains \Drupal\si\si_transactionListBuilder.
 */

namespace Drupal\si;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Si_transaction entities.
 *
 * @ingroup si
 */
class si_transactionListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Si_transaction ID');
    $header['date'] = $this->t('Date');
    $header['project'] = $this->t('Project');
    $header['category'] = $this->t('Category');
    $header['detail'] = $this->t('Detail');
    $header['description'] = $this->t('Description');
    $header['file'] = $this->t('File');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\si\Entity\si_transaction */
    $row['id'] = $entity->id();
    $row['date'] = $entity->get('date')->value;
    $row['project'] = $entity->get('project')->entity->label();
    $row['category'] = $entity->get('category')->entity->label();
    $row['detail'] = $this->l(
      $entity->label(),
      new Url(
        'entity.si_transaction.edit_form', array(
          'si_transaction' => $entity->id(),
        )
      )
    );
    $row['description'] = $entity->description->value;
    if (!$entity->file->isEmpty()) {
      $url = Url::fromUri($entity->file->entity->url());
//      $fileUrl = Link::fromTextAndUrl($entity->file->entity->getFileName(), $url);
      $fileUrl = Link::fromTextAndUrl("✅", $url);
    }
    else $fileUrl = "";
    $row['file'] = $fileUrl;
    return $row + parent::buildRow($entity);
  }

}
