<?php

namespace fall\beans\factory\support;

use fall\beans\factory\config\BeanDefinitionInterface;
use fall\beans\factory\config\ConfigurableBeanFactoryInterface;
use fall\core\utils\ReflectionUtils;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
abstract class AbstractBeanFactory implements ConfigurableBeanFactoryInterface
{

  private $beans = [];

  public function containsBean($beanName): bool
  {
    return isset($this->beans[$beanName]);
  }

  public function getBeanByName(string $beanName)
  {
    if ($this->containsBean($beanName)) {
      return $this->beans[$beanName];
    }

    return $this->createBean($beanName, $this->getBeanDefinition($beanName));
  }

  public function getBeanByType(string $beanType)
  {
    foreach ($this->beans as $bean) {
      if (get_class($bean) === $beanType) {
        return $bean;
      }
    }

    return null;
  }

  protected function createBean(string $beanName, BeanDefinitionInterface $beanDefinition)
  {
    // TODO
    $instance = $beanDefinition->getInstanceSupplier()->get();
    foreach ($beanDefinition->getDependsOn() as $dependOn) {
      $value = null;
      if ($dependOn->name !== null) {
        $value = $this->getBeanByName($dependOn->name);
      } else if ($dependOn->type !== null) {
        $value = $this->getBeanByType($dependOn->type);
      }

      ReflectionUtils::setReflectorFieldValue($dependOn->target, $instance, $value);
    }

    return $instance;
  }

  protected abstract function getBeanDefinition(string $beanName): BeanDefinitionInterface;
}
