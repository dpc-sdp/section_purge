<?php

namespace Drupal\Tests\section_purger\FunctionalJavascript;

use Drupal\section_purger\Form\SectionPurgerForm;

/**
 * Tests \Drupal\section_purger\Form\SectionPurgerForm.
 *
 * @group section_purger
 */
class SectionPurgerFormTest extends SectionPurgerFormTestBase {

  /**
   * {@inheritdoc}
   */
  protected $pluginId = 'section';

  /**
   * {@inheritdoc}
   */
  protected $formClass = SectionPurgerForm::class;

  /**
   * The token group names the form is supposed to display.
   *
   * @var string[]
   *
   * @see purge_tokens_token_info()
   */
  protected $tokenGroups = ['invalidation'];

}
