<?php

namespace Drupal\Tests\section_purge\FunctionalJavascript;

use Drupal\section_purge\Form\SectionPurgeForm;

/**
 * Tests \Drupal\section_purge\Form\SectionPurgerForm.
 *
 * @group section_purge
 */
class SectionPurgeFormTest extends SectionPurgeFormTestBase {

  /**
   * {@inheritdoc}
   */
  protected $pluginId = 'section';

  /**
   * {@inheritdoc}
   */
  protected $formClass = SectionPurgeForm::class;

  /**
   * The token group names the form is supposed to display.
   *
   * @var string[]
   *
   * @see purge_tokens_token_info()
   */
  protected $tokenGroups = ['invalidation'];

}
