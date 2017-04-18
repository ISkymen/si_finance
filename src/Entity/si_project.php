<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_project.
 */

namespace Drupal\si\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\si\si_projectInterface;

/**
 * Defines the Si_project entity.
 *
 * @ingroup si
 *
 * @ContentEntityType(
 *   id = "si_project",
 *   label = @Translation("Si_project"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\si\si_projectListBuilder",
 *     "views_data" = "Drupal\si\Entity\si_projectViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\si\Form\si_projectForm",
 *       "add" = "Drupal\si\Form\si_projectForm",
 *       "edit" = "Drupal\si\Form\si_projectForm",
 *       "delete" = "Drupal\si\Form\si_projectDeleteForm",
 *     },
 *     "access" = "Drupal\si\si_projectAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\si\si_projectHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "si_project",
 *   admin_permission = "administer si_project entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/si/si_project/{si_project}",
 *     "add-form" = "/admin/structure/si/si_project/add",
 *     "edit-form" = "/admin/structure/si/si_project/{si_project}/edit",
 *     "delete-form" = "/admin/structure/si/si_project/{si_project}/delete",
 *     "collection" = "/admin/structure/si/si_project",
 *   },
 *   field_ui_base_route = "si_project.settings"
 * )
 */
class si_project extends ContentEntityBase implements si_projectInterface {

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Project'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The Name of the Project'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Description'))
      ->setDescription(t('The Description of the Project'))
      ->setSettings(array(
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Active / Archived'))
      ->setDescription(t('Indicate Active or Archived Project'))
      ->setSettings(array(
        'on_label' => 'Active',
        'off_label' => 'Archived',
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'boolean',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
