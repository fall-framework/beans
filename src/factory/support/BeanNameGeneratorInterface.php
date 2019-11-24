<?php

namespace fall\beans\factory\support;

use fall\beans\factory\config\BeanDefinitionInterface;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface BeanNameGeneratorInterface
{
  function generateBeanName(BeanDefinitionInterface $beanDefinition, BeanDefinitionRegistryInterface $beanDefinitionRegistry);
}
