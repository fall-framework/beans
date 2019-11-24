<?php

namespace fall\beans\factory\annotation;

use fall\beans\factory\config\BeanDefinitionInterface;

interface AnnotatedBeanDefinitionInterface extends BeanDefinitionInterface
{
  function getMetadata(): array;
}
