<?php

namespace fall\beans\factory\support;

use fall\context\annotation\Autowired;
use fall\context\annotation\Scope;
use fall\core\lang\reflection\ExtendedReflectionClass;
use fall\core\lang\reflection\ExtendedReflector;
use fall\core\utils\ReflectionUtils;
use fall\core\utils\SupplierInterface;
use fall\beans\factory\config\BeanDefinitionInterface;
use fall\beans\factory\annotation\Qualifier;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
abstract class AbstractBeanDefinition implements BeanDefinitionInterface
{
  private $beanClassName = '';
  private $abstract;
  private $singleton;
  private $dependsOn = [];
  private $autowireCandidate = true;
  private $instance;

  public function __construct(ExtendedReflector $extendedReflector)
  {
    $this->setBeanClassName(ReflectionUtils::getReflectorClassName($extendedReflector));
    $this->abstract = $extendedReflector->isAbstract();

    if ($extendedReflector->isAnnotationPresent(Scope::class)) {
      switch (strtolower($extendedReflector->getAnnotation(Scope::class)->value())) {
        case 'singleton':
          $this->singleton = true;
          break;
      }
    }

    if ($extendedReflector instanceof ExtendedReflectionClass) {
      $autowiredProperties = $extendedReflector->getPropertiesAnnotatedWith(Autowired::class);
      foreach ($autowiredProperties as $autowiredProperty) {
        $dependOn = new \stdClass();
        $dependOn->target = $autowiredProperty;
        $dependOn->name = $autowiredProperty->getName();
        if ($autowiredProperty->isAnnotationPresent(Qualifier::class)) {
          $qualifierAnnotation = $autowiredProperty->getAnnotation(Qualifier::class);

          $dependOn->name = $qualifierAnnotation->value();
          $dependOn->type = $qualifierAnnotation->type();
        }

        $this->dependsOn[] = $dependOn;
      }
    }
  }

  public function getBeanClassName(): string
  {
    return $this->beanClassName;
  }

  public function setBeanClassName(string $beanClassName): void
  {
    $this->beanClassName = $beanClassName;
  }

  public function getDependsOn(): array
  {
    return $this->dependsOn;
  }

  public function setDependsOn(array $dependsOn): void
  {
    $this->dependsOn = $dependsOn;
  }

  public function isAbstract(): bool
  {
    return $this->abstract;
  }

  public function isSingleton(): bool
  {
    return $this->singleton !== null;
  }

  public function isAutowireCandidate(): bool
  {
    return $this->autowireCandidate;
  }

  public function setAutowireCandidate(bool $autowireCandidate): void
  {
    $this->autowireCandidate = $autowireCandidate;
  }

  public function getInstanceSupplier(): SupplierInterface
  {
    $instance = null;
    if ($this->isSingleton()) {
      if ($this->instance == null) {
        $this->instance = $this->createInstance();
      }
      $instance = $this->instance;
    } else {
      $instance = $this->createInstance();
    }

    return new class ($instance) implements SupplierInterface
    {
      public function __construct($instance)
      {
        $this->instance = $instance;
      }
      public function get()
      {
        return $this->instance;
      }
    };
  }

  private function createInstance(): object
  {
    return (new \ReflectionClass($this->beanClassName))->newInstance();
  }
}
