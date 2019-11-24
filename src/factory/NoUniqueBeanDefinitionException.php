<?php

namespace fall\beans\factory;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class NoUniqueBeanDefinitionException extends NoSuchBeanDefinitionException
{
  public function __construct(string $message)
  {
    parent::__construct($message);
  }
}
