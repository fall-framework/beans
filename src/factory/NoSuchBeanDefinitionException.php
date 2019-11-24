<?php

namespace fall\beans\factory;

use fall\beans\BeansException;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class NoSuchBeanDefinitionException extends BeansException
{
  public function __construct(string $message)
  {
    parent::__construct($message);
  }
}
