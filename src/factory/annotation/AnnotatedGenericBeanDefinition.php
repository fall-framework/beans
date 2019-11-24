<?php

namespace fall\beans\factory\annotation;

use fall\beans\factory\support\GenericBeanDefinition;
use fall\core\lang\reflection\ExtendedReflector;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class AnnotatedGenericBeanDefinition extends GenericBeanDefinition implements AnnotatedBeanDefinitionInterface
{
  private $annotationMetadata;

  public function __construct(ExtendedReflector $extendedReflector)
  {
    parent::__construct($extendedReflector);
    $this->annotationMetadata = $extendedReflector->getAnnotationsMetadata();
  }

  public function getMetadata(): array
  {
    return $this->annotationMetadata;
  }
}
