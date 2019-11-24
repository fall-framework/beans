<?php

namespace fall\beans\factory\support;

use fall\beans\factory\config\BeanDefinitionInterface;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface BeanDefinitionRegistryInterface
{
  function containsBeanDefinition(string $beanName): bool;
  function getBeanDefinition(string $beanName): BeanDefinitionInterface;
  function registerBeanDefinition(string $beanName, BeanDefinitionInterface $beanDefinition);
}
