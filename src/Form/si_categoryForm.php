<?php

/**
 * @file
 * Contains \Drupal\si\Form\si_categoryForm.
 */

namespace Drupal\si\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Si_category edit forms.
 *
 * @ingroup si
 */
class si_categoryForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\si\Entity\si_category */
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
        drupal_set_message($this->t('Created the %label Si_category.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Si_category.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.si_category.canonical', ['si_category' => $entity->id()]);
  }

}
