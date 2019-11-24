<?php

namespace fall\beans\factory\support;

use fall\beans\factory\config\BeanDefinitionInterface;
use fall\beans\factory\config\ConfigurableListableBeanFactoryInterface;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class DefaultListableBeanFactory extends AbstractBeanFactory implements ConfigurableListableBeanFactoryInterface
{

  private $beanDefinitions = [];

  public function containsBeanDefinition(string $beanName): bool
  {
    return array_key_exists($beanName, $this->beanDefinitions);
  }

  public function getBeanNamesForType(string $type): array
  {
    $beanNames = [];

    foreach ($this->beanDefinitions as $beanName => $beanDefinition) {
      if ($beanDefinition->getBeanClassName() === $type) {
        $beanNames[] = $beanName;
      }
    }

    return $beanNames;
  }

  public function getBeanDefinition(string $beanName): BeanDefinitionInterface
  {
    if (!array_key_exists($beanName, $this->beanDefinitions)) {
      return null;
    }
    return $this->beanDefinitions[$beanName];
  }

  public function registerBeanDefinition(string $beanName, BeanDefinitionInterface $beanDefinition)
  {
    $this->beanDefinitions[$beanName] = $beanDefinition;
  }
}
