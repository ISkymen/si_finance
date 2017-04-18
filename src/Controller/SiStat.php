<?php
namespace Drupal\si\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity;
use Drupal\si;

/**
 * Provides route responses for the Example module.
 */
class SiStat extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */

  public function statPage($date) {

    $time_start = microtime(TRUE);

    $service = \Drupal::service('si.sidb');

    if ($date == 'current') {
      $date = date('Y-m', strtotime('last month'));
    }

    $data = $service->getProjectProfit($date);
    $project_profit = $service->idToName('si_project', $data['by_project']);
    $owner_profit = $service->idToName('si_party', $data['by_owner']);
    $owner_diff = $service->idToName('si_party', $data['diff_by_owner']);

    $project_profit_table = $service->renderTable($project_profit);
    $owner_profit_table = $service->renderTable($owner_profit);
    $owner_diff_table = $service->renderTable($owner_diff);

    $time_end = microtime(TRUE);
    $execution_time = ($time_end - $time_start);

    $output[] = array('#markup' => '<h1>Финансовая отчетность за ' . $data['date'] . '</h1>');
    $output[] = array('#markup' => '<h2>Общая прибыль по проектам</h2>');
    $output[] = $project_profit_table;
    $output[] = array('#markup' => '<h2>Общая прибыль по владельцам</h2>');
    $output[] = $owner_profit_table;
    $output[] = array('#markup' => '<h2>К выплате с учетом полученных и потраченных средств</h2>');
    $output[] = $owner_diff_table;
    $output[] = array('#markup' => '<h4><a href="/transactions?date=' . $date . '">Детали</a></h4>');
    $output[] = array('#markup' => '<h6>Проверка: ' . $data['check'] . '</h6>');
    $output[] = array('#markup' => '<h6>Выполнено за ' . $execution_time . '</h6>');

    return $output;
  }

}