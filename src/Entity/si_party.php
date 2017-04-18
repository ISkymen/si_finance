<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_party.
 */

namespace Drupal\si\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\si\si_partyInterface;

/**
 * Defines the Si_party entity.
 *
 * @ingroup si
 *
 * @ContentEntityType(
 *   id = "si_party",
 *   label = @Translation("Si_party"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\si\si_partyListBuilder",
 *     "views_data" = "Drupal\si\Entity\si_partyViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\si\Form\si_partyForm",
 *       "add" = "Drupal\si\Form\si_partyForm",
 *       "edit" = "Drupal\si\Form\si_partyForm",
 *       "delete" = "Drupal\si\Form\si_partyDeleteForm",
 *     },
 *     "access" = "Drupal\si\si_partyAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\si\si_partyHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "si_party",
 *   admin_permission = "administer si_party entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/si/si_party/{si_party}",
 *     "add-form" = "/admin/structure/si/si_party/add",
 *     "edit-form" = "/admin/structure/si/si_party/{si_party}/edit",
 *     "delete-form" = "/admin/structure/si/si_party/{si_party}/delete",
 *     "collection" = "/admin/structure/si/si_party",
 *   },
 *   field_ui_base_route = "si_party.settings"
 * )
 */
class si_party extends ContentEntityBase implements si_partyInterface {


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

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Party'))
      ->setReadOnly(TRUE);


    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The Name of the Party'))
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
      ->setDescription(t('The Description of the Party'))
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

    return $fields;
  }

}
