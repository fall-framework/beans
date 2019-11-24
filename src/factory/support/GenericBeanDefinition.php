<?php

namespace fall\beans\factory\support;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class GenericBeanDefinition extends AbstractBeanDefinition
{
  public function cloneBeanDefinition(): AbstractBeanDefinition
  {
    return clone $this;
  }

  public function getBeanDefinition(string $beanName): BeanDefinitionInterface
  {
    return $this->beanFactory->getBeanDefinition($beanName);
  }
}
