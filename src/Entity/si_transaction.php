<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_transaction.
 */

namespace Drupal\si\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\si\si_transactionInterface;

/**
 * Defines the Si_transaction entity.
 *
 * @ingroup si
 *
 * @ContentEntityType(
 *   id = "si_transaction",
 *   label = @Translation("Si_transaction"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\si\si_transactionListBuilder",
 *     "views_data" = "Drupal\si\Entity\si_transactionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\si\Form\si_transactionForm",
 *       "add" = "Drupal\si\Form\si_transactionForm",
 *       "edit" = "Drupal\si\Form\si_transactionForm",
 *       "delete" = "Drupal\si\Form\si_transactionDeleteForm",
 *     },
 *     "access" = "Drupal\si\si_transactionAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\si\si_transactionHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "si_transaction",
 *   admin_permission = "administer si_transaction entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/si/si_transaction/{si_transaction}",
 *     "add-form" = "/admin/structure/si/si_transaction/add",
 *     "edit-form" = "/admin/structure/si/si_transaction/{si_transaction}/edit",
 *     "delete-form" = "/admin/structure/si/si_transaction/{si_transaction}/delete",
 *     "collection" = "/admin/structure/si/si_transaction",
 *   },
 *   field_ui_base_route = "si_transaction.settings"
 * )
 */
class si_transaction extends ContentEntityBase implements si_transactionInterface {


  public function label() {
    return $this->get('source_party')->entity->label() . ' → ' . $this->get('destination_party')->entity->label() . ' (' . $this->get('amount')->value . ' грн.)';

  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Transaction'))
      ->setReadOnly(TRUE);

    $fields['project'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Project'))
      ->setDescription(t('The Project of the Transaction'))
      ->setSetting('target_type', 'si_project')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'options_select',
        'weight'   => 1
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['category'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Category'))
      ->setDescription(t('The Category of the Transaction'))
      ->setSetting('target_type', 'si_category')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'options_select',
        'weight'   => 2
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['source_party'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Source Party'))
      ->setDescription(t('The Source Party of the Transaction'))
      ->setSetting('target_type', 'si_party')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'options_select',
        'weight'   => 3
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['destination_party'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Destination Party'))
      ->setDescription(t('The Destination Party of the Transaction'))
      ->setSetting('target_type', 'si_party')

      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'options_select',
        'weight'   => 4
      ))
      ->setRequired(TRUE)

      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date'))
      ->setDescription(t('Date'))
      ->setSetting('datetime_type', 'date')
      ->setDisplayOptions('view', array(
        'type' => 'datetime_default',
        'label' => 'hidden',
        'weight' => -4,
      ))
      ->setDefaultValue(array(0 => array(
        'default_date_type' => 'now',
        'default_date' => 'now',
      )))

      ->setDisplayOptions('form', array(
        'type' => 'datetime_default',
        'weight' => 5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['amount'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Amount'))
      ->setSettings(array(
        'size' => 'medium',
      ))
      ->setDefaultValue('0')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'integer',
        'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['description'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Description'))
      ->setDescription(t('The description of the Transaction.'))
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
        'weight' => 7,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['file'] = BaseFieldDefinition::create('file')
      ->setLabel(t('File'))
      ->setSetting('file_extensions', 'jpg jpeg txt png pdf')
      ->setDescription(t('The File associated with Transaction'))
      ->setDefaultValue('')
//      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'file',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'file',
        'weight' => 8,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
