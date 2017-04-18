<?php

/**
 * @file
 * Contains \Drupal\si\Form\si_projectForm.
 */

namespace Drupal\si\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Si_project edit forms.
 *
 * @ingroup si
 */
class si_projectForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\si\Entity\si_project */
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
        drupal_set_message($this->t('Created the %label Si_project.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Si_project.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.si_project.canonical', ['si_project' => $entity->id()]);
  }

}
