<?php

namespace Drupal\section_purge\Form;

/**
 * Configuration form for the HTTP Bundled Purger.
 */
class SectionPurgeForm extends SectionPurgeFormBase {

  /**
   * The token group names this purger supports replacing tokens for.
   *
   * @var string[]
   *
   * @see purge_tokens_token_info()
   */
  protected $tokenGroups = ['invalidation'];

}
