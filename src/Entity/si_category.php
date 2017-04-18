<?php

/**
 * @file
 * Contains \Drupal\si\Entity\si_category.
 */

namespace Drupal\si\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\si\si_categoryInterface;

/**
 * Defines the Si_category entity.
 *
 * @ingroup si
 *
 * @ContentEntityType(
 *   id = "si_category",
 *   label = @Translation("Si_category"),
 *   income = "Income",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\si\si_categoryListBuilder",
 *     "views_data" = "Drupal\si\Entity\si_categoryViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\si\Form\si_categoryForm",
 *       "add" = "Drupal\si\Form\si_categoryForm",
 *       "edit" = "Drupal\si\Form\si_categoryForm",
 *       "delete" = "Drupal\si\Form\si_categoryDeleteForm",
 *     },
 *     "access" = "Drupal\si\si_categoryAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\si\si_categoryHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "si_category",
 *   admin_permission = "administer si_category entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "income" = "income",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/si/si_category/{si_category}",
 *     "add-form" = "/admin/structure/si/si_category/add",
 *     "edit-form" = "/admin/structure/si/si_category/{si_category}/edit",
 *     "delete-form" = "/admin/structure/si/si_category/{si_category}/delete",
 *     "collection" = "/admin/structure/si/si_category",
 *   },
 *   field_ui_base_route = "si_category.settings"
 * )
 */
class si_category extends ContentEntityBase implements si_categoryInterface {

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
      ->setDescription(t('The ID of the Category'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The Name of the Category'))
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
      ->setDescription(t('The Description of the Category'))
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


    $fields['type'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('The Type of the Category'))
      ->setDescription(t('Publish the contest winners on the site.'))
      // ->setSetting('size', 'small') Не работает
      ->setSetting('allowed_values', array(0 => t('Common Income'), 1 => t('Common Expense'), 2 => t('Personal Salary'), 3 => t('Personal Profit')))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array('type' => 'options_buttons', 'weight' => -60));

    return $fields;
  }

}
