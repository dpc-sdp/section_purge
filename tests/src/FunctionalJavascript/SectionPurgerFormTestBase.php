<?php

namespace Drupal\Tests\section_purge\FunctionalJavascript;

use Drupal\Tests\purge_ui\FunctionalJavascript\Form\Config\PurgerConfigFormTestBase;

/**
 * Testbase for testing \Drupal\section_purger\Form\SectionPurgerFormBase.
 */
abstract class SectionPurgeFormTestBase extends PurgerConfigFormTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['section_purger', 'purge_ui'];

  /**
   * Verify that form shows up
   */
  public function testSaveConfigurationSubmit(): void {
    $this->drupalLogin($this->adminUser);
    $this->drupalGet($this->getPath());
    $this->assertSession()->fieldExists('edit-sitename');
  }

  /**
   * Verify that the form contains all fields we require.
   */
  public function testFieldExistence() {
    $this->drupalLogin($this->adminUser);
    $this->drupalGet($this->getPath());
    $fields = [
      'edit-name' => '',
      'edit-sitename' => '',
      'edit-varnishname' => 'varnish',
      'edit-account' => 1,
      'edit-application' => 100,
      'edit-username' => 'username',
      'edit-environmentname' => 'Production',
    ];
    foreach ($fields as $field => $default_value) {
      $this->assertSession()->fieldValueEquals($field, $default_value);
    }
  }

  /**
   * Test validating the data.
   *
   *
   */
  public function testFormValidation() {
    $this->markTestSkipped(
      'Unsure what this test is doing, so skipping it until sorted'
    );

    // Assert that valid timeout values don't cause validation errors.
    $this->drupalLogin($this->adminUser);
    $this->drupalGet($this->getPath());
    $form_state = $this->getFormStateInstance();
    $form_state->addBuildInfo('args', [$this->formArgs]);
    $form_state->setValues(
      [
        'connect_timeout' => 0.3,
        'timeout' => 0.1,
        'name' => 'foobar',
      ]
    );
    $form = $this->getFormInstance();
    $this->formBuilder->submitForm($form, $form_state);
    $this->assertEquals(0, count($form_state->getErrors()));
    $form_state = $this->getFormStateInstance();
    $form_state->addBuildInfo('args', [$this->formArgs]);
    $form_state->setValues(
      [
        'connect_timeout' => 2.3,
        'timeout' => 7.7,
        'name' => 'foobar',
      ]
    );
    $form = $this->getFormInstance();
    $this->formBuilder->submitForm($form, $form_state);
    $this->assertEquals(0, count($form_state->getErrors()));
    // Submit timeout values that are too low and confirm the validation error.
    $form_state = $this->getFormStateInstance();
    $form_state->addBuildInfo('args', [$this->formArgs]);
    $form_state->setValues(
      [
        'connect_timeout' => 0.0,
        'timeout' => 0.0,
        'name' => 'foobar',
      ]
    );
    $form = $this->getFormInstance();
    $this->formBuilder->submitForm($form, $form_state);
    $errors = $form_state->getErrors();
    $this->assertEquals(2, count($errors));
    $this->assertTrue(isset($errors['timeout']));
    $this->assertTrue(isset($errors['connect_timeout']));
    // Submit timeout values that are too high and confirm the validation error.
    $form_state = $this->getFormStateInstance();
    $form_state->addBuildInfo('args', [$this->formArgs]);
    $form_state->setValues(
      [
        'connect_timeout' => 2.4,
        'timeout' => 7.7,
        'name' => 'foobar',
      ]
    );
    $form = $this->getFormInstance();
    $this->formBuilder->submitForm($form, $form_state);
    $errors = $form_state->getErrors();
    $this->assertEquals(2, count($errors));
    $this->assertTrue(isset($errors['timeout']));
    $this->assertTrue(isset($errors['connect_timeout']));
  }

  /**
   * Test posting data to the HTTP Purger settings form.
   */
  public function testFormSubmit() {
    // Assert that all (simple) fields submit as intended.
    $this->drupalLogin($this->adminUser);
    $edit = [
      'edit-sitename' => 'world',
      'edit-varnishname' => 'varnish',
      'edit-account' => 1,
      'edit-application' => 100,
      'edit-username' => 'username',
      'edit-environmentname' => 'Production',
    ];;
    $this->drupalGet($this->getPath());
    $this->submitForm($edit, t('Save configuration'));
    foreach ($edit as $field => $value) {
      $this->assertSession()
        ->fieldValueEquals($field, $value);
    }
  }
}
