<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_stake.
 */

namespace Drupal\si\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\si\si_stakeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Si_stake entity.
 *
 * @ingroup si
 *
 * @ContentEntityType(
 *   id = "si_stake",
 *   label = @Translation("Si_stake"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\si\si_stakeListBuilder",
 *     "views_data" = "Drupal\si\Entity\si_stakeViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\si\Form\si_stakeForm",
 *       "add" = "Drupal\si\Form\si_stakeForm",
 *       "edit" = "Drupal\si\Form\si_stakeForm",
 *       "delete" = "Drupal\si\Form\si_stakeDeleteForm",
 *     },
 *     "access" = "Drupal\si\si_stakeAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\si\si_stakeHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "si_stake",
 *   admin_permission = "administer si_stake entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/si/si_stake/{si_stake}",
 *     "add-form" = "/admin/structure/si/si_stake/add",
 *     "edit-form" = "/admin/structure/si/si_stake/{si_stake}/edit",
 *     "delete-form" = "/admin/structure/si/si_stake/{si_stake}/delete",
 *     "collection" = "/admin/structure/si/si_stake",
 *   },
 *   field_ui_base_route = "si_stake.settings"
 * )
 */
class si_stake extends ContentEntityBase implements si_stakeInterface {

  public function label() {
    return $this->get('party')->entity->label() . ' (' .$this->get('share')->value . '% ' . $this->get('project')->entity->label() . ')';

  }

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
      ->setDescription(t('The ID of the Stake'))
      ->setReadOnly(TRUE);

    $fields['project'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Project'))
      ->setDescription(t('The Project associated with the Stake'))
      ->setSetting('target_type', 'si_project')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size'           => 60,
          'placeholder'    => ''
        ),
        'weight'   => 1
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['party'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Party'))
      ->setDescription(t('The Party associated with the Stake'))
      ->setSetting('target_type', 'si_party')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size'           => 60,
          'placeholder'    => ''
        ),
        'weight'   => 1
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['share'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Share'))
      ->setDescription(t('The Share of the Stake'))
      ->setSettings(array(
        'precision' => 5,
        'scale' => 2,
        'min' => 0,
        'max' => 100
      ))
      ->setDefaultValue('0')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'decimal',
        'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Description'))
      ->setDescription(t('The Description of the Stake'))
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
