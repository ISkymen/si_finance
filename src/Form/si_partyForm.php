<?php

/**
 * @file
 * Contains \Drupal\si\Form\si_partyForm.
 */

namespace Drupal\si\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Si_party edit forms.
 *
 * @ingroup si
 */
class si_partyForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\si\Entity\si_party */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Si_party.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Si_party.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.si_party.canonical', ['si_party' => $entity->id()]);
  }

}
