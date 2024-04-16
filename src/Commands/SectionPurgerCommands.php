<?php

namespace Drupal\section_purge\Commands;

use Drush\Commands\DrushCommands;

class SectionPurgerCommands extends DrushCommands {

  /**
   * Install the sensor.
   *
   * @command section_purger:install_sensor
   * @aliases sp-install-sensor´
   *
   * @usage section_purger:install_sensor
   */
  public function installSensor() {
    if (\Drupal::service('module_handler')->moduleExists('monitoring')) {
      $sensor = \Drupal\monitoring\Entity\SensorConfig::create([
        'id' => 'section_purger',
        'label' => 'Section Purger',
        'description' => 'Connectivity Status of the Section API',
        'plugin_id' => 'section_purger',
        'value_label' => 'Section Purger',
        'category' => 'Baywatch',
        'status' => TRUE,
        'caching_time' => 300,
      ]);
      try {
        $sensor->save();
      }
      catch (EntityStorageException $e) {
        \Drupal::messenger()->addMessage("section_purger sensor already configured.");
      }
    } else {
      \Drupal::messenger()->addMessage("The 'monitoring' module is not enabled.");
    }
  }
}
