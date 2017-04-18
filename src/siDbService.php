<?php

namespace Drupal\si;

use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Database;
use Symfony\Component\Validator\Constraints\Null;

class siDbService {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */

  protected $database;

  /**
   * Constructs a MyPageDbLogic object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */

  public function __construct(Connection $database) {
   $this->database = $database;
 }

 public function getProjectProfit($date) {

   $date_start = new DrupalDateTime('first day of ' . $date);
   $date_end = new DrupalDateTime('last day of ' . $date);
// $date->setTimezone(new \DateTimezone(DATETIME_STORAGE_TIMEZONE));
   $formatted_date_start = $date_start->format(DATETIME_DATETIME_STORAGE_FORMAT);
   $formatted_date_end = $date_end->format(DATETIME_DATETIME_STORAGE_FORMAT);

   $query = $this->database->select('si_transaction', 'tr');
   $query->join('si_category', 'cat', '(cat.id = tr.category)');
   $query
     ->fields('tr', array())
     ->fields('cat', array('type'))
     ->condition('date', array($formatted_date_start, $formatted_date_end), 'BETWEEN');

   $selection = $query->execute();
   $profit = array();

   while ($row = $selection->fetch()) {

     if ($row->type == 0) {
       $profit['by_project'][$row->project] += $row->amount;
     }
     else {
       $profit['by_project'][$row->project] -= $row->amount;
     }

     if ($row->type == 1 OR $row->type == 2) {
       $profit['received'][$row->source_party] -= $row->amount;
     }
     elseif ($row->type == 0) {
       $profit['received'][$row->destination_party] += $row->amount;
       $profit['received'][$row->source_party] += $row->amount;
     }

     else {
       $profit['received'][$row->destination_party] += $row->amount;
       $profit['received'][$row->source_party] -= $row->amount;
     }

   }

   $query_owner = $this->database->select('si_stake', 'st');
   $query_owner->fields('st', array());

   $selection_owner = $query_owner->execute();

   while ($row = $selection_owner->fetch()) {
     $profit['by_owner'][$row->party] += ($profit['by_project'][$row->project]*$row->share)/100;
   }

   foreach ($profit['by_owner'] as $key => $value) {
     $profit['diff_by_owner'][$key] = $value - $profit['received'][$key];
   }

   $profit['check'] = array_sum($profit['diff_by_owner']);

   $profit['date'] = $this->rusMonth($date_start);

// $profit = $query->execute()->fetchAll();
// $profit = $query->execute()->fetchAll(\PDO::FETCH_COLUMN);
   $profit = (count($profit)) ? $profit : FALSE;
   return $profit;
 }

 public function idToName($entity_type, $entity_array_id) {
   $entity_array = array();
   $entities_id = array_keys($entity_array_id);
   $entities = \Drupal::entityTypeManager()->getStorage($entity_type)->loadMultiple($entities_id);
   foreach($entity_array_id as $key => $value){
     $entity_array[$entities[$key]->label()] = round($value);
   }
   return $entity_array;
 }

 public function renderTable($array) {
   $output = array(
     '#theme' => 'table',
     '#header' => array_keys($array),
     '#rows' => array($array),
     '#suffix' => '<p></p>'
   );
   return $output;
 }

 public function rusMonth($date) {
   $month = array("1"=>"Январь", "2"=>"Февраль", "3"=>"Март", "4"=>"Апрель", "5"=>"Май", "6"=>"Июнь", "7"=>"Июль", "8"=>"Август", "9"=>"Сентябрь", "10"=>"Октябрь", "11"=>"Ноябрь", "12"=>"Декабрь");
   $rusDate='';
   $curMonth = $date->format('n');
   foreach($month as $key => $val) {
     if ($key == $curMonth){
       $rusDate = $val;
       return $rusDate . $date->format(' Y') ;
     }
   }
 }

}