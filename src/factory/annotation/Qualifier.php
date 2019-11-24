<?php

namespace fall\beans\factory\annotation;

use fall\core\lang\Annotation;
use fall\core\lang\annotation\DefaultValue;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface Qualifier extends Annotation
{
  public function value();

  /**
   * @DefaultValue("%target.class.short.name")
   */
  public function type();
}
